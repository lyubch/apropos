<?php

class DbController extends CController
{
	public $version  = 2;
	public $language = 'ru';

	public function init()
	{
		parent::init();

		if (!in_array($this->version, [1, 2])) {
			throw new Exception('Only `1` or `2` versions available.');
		}

		$srcPath = $this->getSrcPath();
		if ($this->version == 1) {
			$srcPath .= '/bdsm';
		}
		Apropos::setSrcPath($srcPath);
	}

	protected function loadYandexErrors($text)
	{
		static $speller;
		if ($speller === null) {
			$speller = new YandexSpellerClient([
				'clientOptions' => [
					'curl' => [
						// The proxy of tor browser.
						// Tor browser must be installed in the system.
						CURLOPT_PROXY     => '127.0.0.1:9050',
						CURLOPT_PROXYTYPE => CURLPROXY_SOCKS5_HOSTNAME,
					],
				],
			]);
		}

		return $speller->checkText($text);
	}

	protected function findDescriptors($path)
	{
		$folders = scandir($path);

		$findDescriptors = [];
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$folderPath = $path . '/' . $folder;
			if (is_file($folderPath)) {
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				continue;
			}

			$files = scandir($folderPath);
			foreach ($files as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$filePath = $folderPath . '/' . $file;
				$fileJson = json_decode(file_get_contents($filePath), true);
				foreach ($fileJson as $person => $lines) {
					foreach ($lines as $line) {
						if (preg_match_all('/(\{[^\}]+\})([\p{L}]*)/u', $line, $matches)) {
							foreach ($matches[1] as $matchID => $descriptorID) {
								if (!isset($findDescriptors[$descriptorID])) {
									$findDescriptors[$descriptorID] = [
										'length' => 0,
										'suffix' => [],
									];
								}
								$findDescriptors[$descriptorID]['length'] += 1;
								if (!empty($matches[2][$matchID])) {
									$suffix = $matches[2][$matchID];
									if (!isset($findDescriptors[$descriptorID]['suffix'][$suffix])) {
										$findDescriptors[$descriptorID]['suffix'][$suffix] = [
											'length' => 0,
										];
									}
									$findDescriptors[$descriptorID]['suffix'][$suffix]['length'] += 1;
									$findDescriptors[$descriptorID]['suffix'][$suffix]['line']    = $line;
								}
							}
						}
					}
				}
			}
		}
		ksort($findDescriptors);

		return $findDescriptors;
	}

	public function directoryList($path, $absoluteUrl = true)
	{
		$fileList = [];
		foreach (scandir($path) as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$folderPath = $path . '/' . $folder;
			if (is_file($folderPath)) {
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				continue;
			}

			foreach (scandir($folderPath) as $file) {
				if ($file === '.' || $file === '..') {
					continue;
				}

				$fileList[$folder][$file] = $absoluteUrl ? $folderPath . '/' . $file : $file;
			}
		}

		return $fileList;
	}

	public function fileList($path, $absoluteUrl = true)
	{
		return call_user_func_array('array_merge', $this->directoryList($path, $absoluteUrl));
	}

	protected function getUtilsPath()
	{
		return Yii::getPathOfAlias('webroot') . '/uploads/_db-utils';
	}
}
