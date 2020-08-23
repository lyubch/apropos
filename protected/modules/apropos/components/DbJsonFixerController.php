<?php
/**
 * DbJsonFixerController
 */
use Ahc\Json\Fixer;

class DbJsonFixerController extends DbController
{
	public function actionRun()
    {
		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath() . '/src';
		if (is_dir($dstPath)) {
			CFileHelper::removeDirectory($dstPath);
		}
		mkdir($dstPath, 0777, true);

		$folders = scandir($srcPath);
		$errors  = JsonValidator::validateJsonRecursive($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath  = $srcPath . '/' . $folder;
			$dstFolderPath  = $dstPath . '/' . $folder;
			if (!isset($errors[$folder])) {
				if (is_file($srcFolderPath)) {
					if (!copy($srcFolderPath, $dstFolderPath)) {
						throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
							'{file}' => $srcFolderPath,
						]));
					}
				} else {
					CFileHelper::copyDirectory($srcFolderPath, $dstFolderPath);
				}
				continue;
			} elseif (is_file($srcFolderPath)) {
				$fileText = $this->fixJsonFile($srcFolderPath);
				if (file_put_contents($dstFolderPath, $fileText) === false) {
					throw new Exception(strtr('Unexpected error in process of saving file `{file}`.', [
						'{file}' => $dstFolderPath,
					]));
				}
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
				if (!in_array($file, $errors[$folder])) {
					if (!copy($srcFilePath, $dstFilePath)) {
						throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
							'{file}' => $srcFilePath,
						]));
					}
					continue;
				}

				$fileText = $this->fixJsonFile($srcFilePath);
				if (file_put_contents($dstFilePath, $fileText) === false) {
					throw new Exception(strtr('Unexpected error in process of saving file `{file}`.', [
						'{file}' => $dstFilePath,
					]));
				}
			}
		}

		$this->actionGenerateReadmy();
		$this->actionValidateDst();
    }

	private function fixJsonFile($filePath)
	{
		$fileLines      = array_values(array_filter(file($filePath), function($fileLine) {
			// remove all empty lines
			return !empty(trim($fileLine));
		}));
		$fileLinesCount = count($fileLines);
		// fix json commas not valid for JSON format
		for ($pos=0; $pos<$fileLinesCount; $pos++) {
			$lineCurr                = rtrim($fileLines[$pos]);
			$lineCurrLen             = mb_strlen($lineCurr);
			$lineCurrLastSymb        = mb_substr($lineCurr, $lineCurrLen-1);
			$lineCurrIsOpenSymb      = in_array($lineCurrLastSymb, ['{','[',':']);
			$lineCurrIsCloseSymb     = in_array(rtrim(trim($lineCurr), ','), [']','}']);
			$lineCurrIsJsonVar       = !$lineCurrIsOpenSymb && !$lineCurrIsCloseSymb;
			$lineCurrLastSymbIsComma = $lineCurrLastSymb === ',';
			$lineNextExists          = isset($fileLines[$pos+1]);
			$lineNext                = $lineNextExists ? rtrim($fileLines[$pos+1]) : null;
			$lineNextIsCloseSymb     = $lineNextExists ? in_array(rtrim(trim($lineNext), ','), [']','}']) : null;
			if ($lineCurrIsJsonVar && $lineCurrLastSymbIsComma && $lineNextIsCloseSymb) {
				$lineCurr = rtrim($lineCurr, ',');
			} elseif ($lineCurrIsJsonVar && !$lineCurrLastSymbIsComma && !$lineNextIsCloseSymb) {
				$lineCurr = rtrim($lineCurr) . ',';
			}
			$fileLines[$pos] = $lineCurr;
		}
		$text = implode("\n", $fileLines);

		//@TODO CHECK
		if (json_decode($text, true) === null) {
			static $fixer;
			if ($fixer === null) {
				$fixer = new Fixer();
			}
			$json = $fixer->fix($text);
			if (json_decode($text, true) === null) {
				// comments
				$text = preg_replace('~(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)~', '', $text);
				// trailing commas
				$text = preg_replace('~,\s*([\]}])~mui', '$1', $text);
				// empty cells
				$text = preg_replace('~(.+?:)(\s*)?([\]},])~mui', '$1null$3', $text);
				// codes
				$text = str_replace(["\n","\r","\t","\0"], '', $text);
			}
			dump($filePath, $text);
		}

		return $text;
	}

	public function actionValidateDst()
    {
		$dstPath = $this->getDstPath() . '/src';
		if (!is_dir($dstPath)) {
			throw new Exception('Dst is not created yet.');
		}

		$errors = JsonValidator::validateJsonRecursive($dstPath);
		dump(empty($errors) ? 'OK' : 'ERRORS', $errors);
    }

	public function actionGenerateReadmy()
    {
		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath();
		if (!is_dir($dstPath)) {
			mkdir($dstPath);
		}

		$readmyFiles = call_user_func_array(
			'array_merge',
			JsonValidator::validateJsonRecursive($srcPath)
		);
		$readmyText = <<<EOD
----------------------------------------------------------------------
Файлы с исправленными ошибками формата JSON(Общее количество: {n}).
----------------------------------------------------------------------
Описание: файлы с ошибками JSON не открывались в игре и текст из
них не показывался, вместо этого был пустой экран.
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
