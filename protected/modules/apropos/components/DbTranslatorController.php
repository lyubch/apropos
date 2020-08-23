<?php
/**
 * DbRuTranslateController
 */

use \Statickidz\GoogleTranslate;

class DbTranslatorController extends DbController
{
	protected $translatorDefaultOptions = [
		'source' => 'en',
		'target' => 'ru',
	];

	public function actionRun()
    {
		$srcPath     = $this->getSrcPath();
		$dstPath     = $this->getDstPath() . '/src';
		if (!is_dir($dstPath)) {
			mkdir($dstPath, 0777, true);
		}

		// copy configs
		$folders = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath  = $srcPath . '/' . $folder;
			$dstFolderPath  = $dstPath . '/' . $folder;
			if (is_file($srcFolderPath)) {
				if (!copy($srcFolderPath, $dstFolderPath)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFolderPath,
					]));
				}
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				CFileHelper::copyDirectory($srcFolderPath, $dstFolderPath);
			}
		}

		
		$descriptors = $this->translateDescriptors();
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath  = $srcPath . '/' . $folder;
			$dstFolderPath  = $dstPath . '/' . $folder;
			if (is_file($srcFolderPath)) {
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				continue;
			} elseif (!is_dir($dstFolderPath)) {
				mkdir($dstFolderPath);
			}

			$files = scandir($srcFolderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$srcFilePath = $srcFolderPath . '/' . $file;
				$dstFilePath = $dstFolderPath . '/' . $file;
				if (!file_exists($dstFilePath)) {
					$srcFileJson = json_decode(file_get_contents($srcFilePath), true);
					$dstFileJson = [];
					foreach ($srcFileJson as $person => $lines) {
						foreach ($lines as $line) {
							$dstFileJson[$person] []= $this->translate(strtr($line, $descriptors));
						}
					}
					file_put_contents($dstFilePath, json_encode($dstFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
//					dump(123, $dstFileJson);
				}
			}
		}

		$readmyFiles = $this->getReadmyFiles();
		$this->generateReadmy($readmyFiles);
		dump('OK', $readmyFiles);
    }

	/**
	 * https://github.com/statickidz/php-google-translate-free
	 */
	protected function translate($text, array $options = [])
	{
		static $translator;
		if ($translator === null) {
			$translator = new GoogleTranslate();
		}

		$options = array_merge($this->translatorDefaultOptions, $options);
		$result  = $translator->translateGhost($options['source'], $options['target'], $text);

		if (!$result) {
			dump('ERROR TRANSLATOR DATA', $text, $result, DD10);
		}

		return $result;
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
Файлы переведенные на русский язык(Общее количество: {n}).
----------------------------------------------------------------------
Описание: файлы переводились с помощью переводчика  Google Translate
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

	private function translateDescriptors()
	{
		return json_decode(file_get_contents($this->getDstPath() . '/descriptors.txt'), true);
	}

	private function getReadmyFiles()
	{
		$dstPath = $this->getDstPath() . '/src';

		$readmyFiles = [];
		$folders     = scandir($dstPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$dstFolderPath  = $dstPath . '/' . $folder;
			if (is_file($dstFolderPath)) {
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				continue;
			}

			$files = scandir($dstFolderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$readmyFiles []= $file;
			}
		}

		return $readmyFiles;
	}
}
