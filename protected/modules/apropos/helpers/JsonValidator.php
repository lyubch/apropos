<?php

class JsonValidator
{
    public static function validateJsonRecursive($path)
    {
		$results = [];
		if (is_file($path)) {
			if (pathinfo($path, PATHINFO_EXTENSION) === 'txt') {
				return static::validateFile($path);
			}
		} else {
			$files = scandir($path);
			foreach ($files as $file) {
				$filePath = $path . '/' . $file;
				if ($file === '.' || $file === '..') {
					continue;
				} elseif (is_file($filePath)) {
					if (pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
						if (!static::validateFile($filePath)) {
							$results[] = $file;
						}
					}
				} else {
					$results[$file] = static::validateJsonRecursive($filePath);
				}
			}
		}

		return array_filter($results, function($result) {
			return $result !== [];
		});
    }

	public static function validateFile($filePath)
	{
		if (!is_file($filePath)) {
			throw new Exception('Only files accepted.');
		}

		$fileText = file_get_contents($filePath);
		return json_decode($fileText, true) !== null;
	}
}
