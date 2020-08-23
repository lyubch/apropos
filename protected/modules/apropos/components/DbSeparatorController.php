<?php
/**
 * DbLanguagesSeparateController
 */
class DbSeparatorController extends DbController
{
	protected $separators = [
		'getDstPathRu',
		'getDstPathEn',
	];

	public function init()
	{
		parent::init();

		if (count($this->getEmptySeparators()) === count($this->separators)) {
			throw new Exception('At least 1 separator must be set. Please declare any of functions: {separators}.', strtr([
				'{separators}' => '`' . implode('`, `', $this->separators) . '`',
			]));
		}
	}

	public function actionRun()
    {
		$srcPath   = $this->getSrcPath();
		$dstPathRu = $this->getDstPathRu() . '/src';
		$dstPathEn = $this->getDstPathEn() . '/src';

		if (is_dir($dstPathRu)) {
			CFileHelper::removeDirectory($dstPathRu);
		}
		if (is_dir($dstPathEn)) {
			CFileHelper::removeDirectory($dstPathEn);
		}
		mkdir($dstPathRu, 0777, true);
		mkdir($dstPathEn, 0777, true);

		$folders = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath   = $srcPath . '/' . $folder;
			$dstFolderPathRu = $dstPathRu . '/' . $folder;
			$dstFolderPathEn = $dstPathEn . '/' . $folder;
			if (is_file($srcFolderPath)) {
				if (!copy($srcFolderPath, $dstFolderPathRu)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFolderPath,
					]));
				}
				if (!copy($srcFolderPath, $dstFolderPathEn)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFolderPath,
					]));
				}
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				CFileHelper::copyDirectory($srcFolderPath, $dstFolderPathRu);
				CFileHelper::copyDirectory($srcFolderPath, $dstFolderPathEn);
				continue;
			}

			$files = scandir($srcFolderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$srcFilePath   = $srcFolderPath . '/' . $file;
				$dstFilePathRu = $dstFolderPathRu . '/' . $file;
				$dstFilePathEn = $dstFolderPathEn . '/' . $file;
				$srcFileText   = file_get_contents($srcFilePath);
				$language      = LanguageDetector::detect($srcFileText);
				if ($language === 'en') {
					if (!is_dir($dstFolderPathEn)) {
						mkdir($dstFolderPathEn, 0777, true);
					}
					if (!copy($srcFilePath, $dstFilePathEn)) {
						throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
							'{file}' => $dstFilePathEn,
						]));
					}
				} else {
					if (!is_dir($dstFolderPathRu)) {
						mkdir($dstFolderPathRu, 0777, true);
					}
					if (!copy($srcFilePath, $dstFilePathRu)) {
						throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
							'{file}' => $dstFilePathRu,
						]));
					}
				}
			}
		}

		if (method_exists($this, 'generateReadmy')) {
			$this->generateReadmy(
				$this->fileList($dstPathRu, false),
				$this->fileList($dstPathEn, false)
			);
		}

		foreach ($this->getEmptySeparators() as $emptySeparator) {
			CFileHelper::removeDirectory($this->{$emptySeparator}());
		}

		dump('OK');
    }

	protected function generateReadmy($readmyFilesRu, $readmyFilesEn)
    {
		$dstPathRu = $this->getDstPathRu();
		if (!is_dir($dstPathRu)) {
			mkdir($dstPathRu);
		}

		$readmyText = <<<EOD
----------------------------------------------------------------------
Удалённые англоязычные файлы(Общее количество: {n}).
----------------------------------------------------------------------
Описание: файлы которые содержали переводы только на английском языке.
----------------------------------------------------------------------
Список:
EOD;
		$readmyText   = strtr($readmyText, [
			'{n}' => count($readmyFilesEn),
		]) . PHP_EOL;
		$readmyText  .= implode(PHP_EOL, $readmyFilesEn);
		file_put_contents($dstPathRu . '/' . $this->readmyFile, $readmyText);
    }

	protected function getEmptySeparators()
	{
		$className = get_called_class();
		$reflector = new ReflectionClass($className);
		$methods   = array_map(function($method) {
			return $method->name;
		}, array_filter($reflector->getMethods(), function($method) use($className) {
			return $method->class === $className;
		}));

		return array_diff($this->separators, $methods);
	}

	protected function getSrcPath()
	{
		throw new Exception('Src path must be set.');
	}

	protected function getDstPathRu()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/tmp-0-1';
	}

	protected function getDstPathEn()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/db-dst/tmp-0-2';
	}
}
