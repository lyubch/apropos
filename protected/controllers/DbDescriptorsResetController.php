<?php
/**
 * DbDescriptorsResetController
 */
class DbDescriptorsResetController extends DbController
{
	public function actionRun()
    {
		$srcPath     = $this->getSrcPath();
		$dstPath     = $this->getDstPath() . '/src';
		if (is_dir($dstPath)) {
			CFileHelper::removeDirectory($dstPath);
		}
		mkdir($dstPath, 0777, true);

		$descriptors          = Apropos::descriptors(null);
		$findDescriptors      = $this->findDescriptors($srcPath);
		$undefinedDescriptors = array_diff_key($findDescriptors, $descriptors);
		if (!empty($undefinedDescriptors)) {
			dump('ERROR ON UNDEFINED DESCRIPTORS', $undefinedDescriptors);
		}

		$descriptorsParams = array_merge(
			Apropos::descriptors(null, true),
			$this->descriptorsParams
		);
		$folders = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath  = $srcPath . '/' . $folder;
			if (is_file($srcFolderPath)) {
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				continue;
			}

			$files = scandir($srcFolderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$srcFilePath = $srcFolderPath . '/' . $file;
				$srcFileJson = json_decode(file_get_contents($srcFilePath), true);
				foreach ($srcFileJson as $person => $lines) {
					foreach ($lines as $line) {
						$line = strtr($line, $descriptorsParams);
					}
				}
				file_put_contents($dstFilePath, json_encode($srcFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}

		$readmyFiles = array_map(function($findDescriptor) {
			return $findDescriptor['length'];
		}, $findDescriptors);
		$this->generateReadmy($readmyFiles);

		dump('OK');
    }

	protected function generateReadmy($readmyFiles)
    {
		$dstPath = $this->getDstPath();
		if (!is_dir($dstPath)) {
			mkdir($dstPath);
		}

		$readmyText = <<<EOD
----------------------------------------------------------------------
Удалённые дескрипторы(Общее количество: {n}).
----------------------------------------------------------------------
Описание: все дэскрипторы были полностью удалены.
----------------------------------------------------------------------
Список:
EOD;
		$readmyText   = strtr($readmyText, [
			'{n}' => array_sum($readmyFiles),
		]) . PHP_EOL;
		foreach ($readmyFiles as $descriptor => $length) {
			$readmyText .= $descriptor . '(Количество: ' . $length . ').' . PHP_EOL;
		}
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
