<?php
use LanguageDetection\Language;

class LanguageDetector
{
	public static function detect($text)
	{
		static $detector;
		if ($detector === null) {
			$detector = new Language(['ru', 'en']);
		}

		// remove persons definitions
		$text = preg_replace('/1st Person|2nd Person|3rd Person/', '', $text);
		// remove descriptors definitions
		$text = preg_replace('/\{[A-Z]+\}?/', '', $text);
		$text = preg_replace('/\{?[A-Z]+\}/', '', $text);

		// detect language
		$language = $detector->detect($text);

		return (string)$language;
	}
}
