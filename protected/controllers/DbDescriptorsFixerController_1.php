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
		$directoryList     = $this->directoryList($srcPath);
		foreach ($directoryList as $folder => $files) {
			$dstFolderPath = $dstPath . '/' . $folder;
			mkdir($dstFolderPath);
			foreach ($files as $file => $srcFilePath) {
				$dstFilePath = $dstFolderPath . '/' . $file;
				$srcFileJson = json_decode(file_get_contents($srcFilePath), true);
				foreach ($srcFileJson as $personID => &$lines) {
					foreach ($lines as $lineID => &$line) {
						$line = strtr($line, $descriptorsParams);
					}
				}
				file_put_contents($dstFilePath, json_encode($srcFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}

		dump('OK');
    }

	/**
	 * попк
	 * бедер
	 * довесок
	 * хоботок
	 * кол
	 */
	public function actionGenerateDescriptorsVariants($path = null)
	{
		if ($path === null) {
			$path = $this->getSrcPath();
		}
		$descriptors          = Apropos::descriptors(null);
		$findDescriptors      = $this->findDescriptors($path);
		$undefinedDescriptors = array_diff_key($findDescriptors, $descriptors);
		if (!empty($undefinedDescriptors)) {
			dump('ERROR ON UNDEFINED DESCRIPTORS', $undefinedDescriptors, DD10);
		}

		$descriptorsVariants = [];
		foreach ($findDescriptors as $descriptor => $options) {
			if (empty($options['suffix'])) {
				continue;
			}

			foreach ($descriptors[$descriptor] as $prefix) {
				if (!isset($descriptorsVariants[$descriptor])) {
					$descriptorsVariants[$descriptor] = [
						'list' => [],
						'variants' => [],
					];
				}

				foreach (array_keys($options['suffix']) as $suffix) {
					$text = $prefix . $suffix;
					if (!in_array($suffix, $descriptorsVariants[$descriptor]['list'])) {
						$descriptorsVariants[$descriptor]['list'] []= $suffix;
					}
					$descriptorsVariants[$descriptor]['variants'][$suffix] []= $text;
				}
			}
		}

		dump('OK', $descriptorsVariants, DD10);
	}

	protected function generateReadmy($readmyFiles)
    {

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
