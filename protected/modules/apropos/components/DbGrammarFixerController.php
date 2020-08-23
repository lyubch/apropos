<?php
/**
 * DbGrammarFixerController
 */

class DbGrammarFixerController extends DbController
{
	public function actionRun()
    {
		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath() . '/src';
		if (is_dir($dstPath)) {
			CFileHelper::removeDirectory($dstPath);
		}
		mkdir($dstPath, 0777, true);

		$readmy  = [];
		$folders = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath = $srcPath . '/' . $folder;
			$dstFolderPath = $dstPath . '/' . $folder;
			if (is_file($srcFolderPath)) {
				if (!copy($srcFolderPath, $dstFolderPath)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFolderPath,
					]));
				}
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				CFileHelper::copyDirectory($srcFolderPath, $dstFolderPath);
				continue;
			} else {
				mkdir($dstFolderPath);
			}

			$files = scandir($srcFolderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$srcFilePath = $srcFolderPath . '/' . $file;
				$dstFilePath = $dstFolderPath . '/' . $file;
				$srcFileText = file_get_contents($srcFilePath);
				$srcFileJson = json_decode($srcFileText, true);
				$dstFileJson = GrammarFixer::fixJson($srcFileJson);
				// remove all english lines (only for russians db)
				if ($this->language === 'ru') {
					$dstFileJson = GrammarFixer::removeForeignLanguageLines($dstFileJson);
				}
				$dstFileText = json_encode($dstFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				if ($srcFileText !== $dstFileText) {
					$readmy []= $file;
					file_put_contents($dstFilePath, $dstFileText);
				} elseif (!copy($srcFilePath, $dstFilePath)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFilePath,
					]));
				}
			}
		}

		$this->generateReadmy($readmy);
		dump('OK', $readmy);
    }

	protected function generateReadmy($readmyFiles)
    {
		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath();
		if (!is_dir($dstPath)) {
			mkdir($dstPath);
		}

		$readmyText = <<<EOD
----------------------------------------------------------------------
Файлы с исправленными пунктуационными ошибками(Общее количество: {n}).
----------------------------------------------------------------------
Описание: в основном это пунктуационные ошибки - не закрытые брэкеты
дэскрипторов/пробелы между названием дэскриптора и скобкой(из за чего
они просто не работали и слова не отображались корректно), лишние
пробелы/недостающие пробелы, табуляции заменены на пробелы, теперь
все предложения всегда начинаются с большой буквы, теперь в конце
строки всегда стоит точка если там не было никакого знака пунктуации,
две точки заменены на три точки. Также кое-где удалены не переведенные
предложения на английском языке.
----------------------------------------------------------------------
Список:
EOD;
		$readmyText   = strtr($readmyText, [
			'{n}' => count($readmyFiles),
		]) . PHP_EOL;
		$readmyText  .= implode(PHP_EOL, $readmyFiles);
		file_put_contents($dstPath . '/' . $this->readmyFile, $readmyText);
    }

	protected function getSrcPath()
	{
		throw new Exception('Src path must be set.');
	}

	protected function getDstPath()
	{
		throw new Exception('Dst path must be set.');
	}
}
