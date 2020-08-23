<?php

class GrammarFixer
{
	private static $bracketsCounter = [
		'{' => 0,
		'}' => 0,
		'(' => 0,
		')' => 0,
		'[' => 0,
		']' => 0,
	];

	public static function removeForeignLanguageLines($json)
	{
		foreach ($json as $personID => $lines) {
			foreach ($lines as $lineID => $line) {
				$language = LanguageDetector::detect($line);
				if ($language === 'en') {
					unset($json[$personID][$lineID]);
				}
			}
		}

		return $json;
	}

    public static function fixJson($json)
    {
		foreach ($json as $personID => &$lines) {
			foreach ($lines as $lineID => &$line) {
				// fix invalid brackets for descriptors
				$line = preg_replace('/[\s|\[|\(]([A-Z]+)\}/', ' {$1}', $line);
				$line = preg_replace('/\{([A-Z]+)[\s|\]|\)]/', '{$1} ', $line);
				$line = preg_replace('/\{([A-Z]+)([\.|\,|\!|\?])/', '{$1}$2', $line);
				// fix invalid square brackets for ACTIVE|PRIMARY (invalid bracket)
				$line = preg_replace('/^[\[|\{]\{(ACTIVE|PRIMARY)\}\)/', '({$1})', $line);
				$line = preg_replace('/^\(\{(ACTIVE|PRIMARY)\}[\]|\}]/', '({$1})', $line);
				// replace trailing spaces and tabs by one space
				$line = trim(preg_replace('/[\t\s]+/', ' ', $line));
				// remove spaces between open|closed brackets
				$line = preg_replace('/\(\s\{/', '({', $line);
				$line = preg_replace('/\}\s\)/', '})', $line);
				// fix invalid square brackets for ACTIVE|PRIMARY (bracket missing)
				$line = preg_replace('/^\{(ACTIVE|PRIMARY)\}\)/', '({$1})', $line);
				$line = preg_replace('/^\(\{(ACTIVE|PRIMARY)\}\s/', '({$1}) ', $line);
				// add space between punctuation mark and word
				$line = preg_replace('/([\,|\.|\!|\?|\:|\;])(\p{L})/u', '$1 $2', $line);
				// add space between word and open bracket
				$line = preg_replace('/(\p{L})([\{])/u', '$1 $2', $line);
				// remove spaces between word and punctuation mark
				$line = preg_replace('/(\p{L})\s([\,|\.|\!|\?|\:|\;])/u', '$1$2', $line);
				// remove spaces before the punctuation mark
				$line = preg_replace('/\s+([\.|\!|\?])/', '$1', $line);
				// removed spaces into descriptors definitions
				$line = preg_replace('/\{\s?([^\}\s]+)\s?\}/', '{$1}', $line);
				// line always starts from upper case char
				$line = preg_replace_callback('/^(\p{L}{1})/u', function($matches) {
					return mb_strtoupper($matches[0]);
				}, $line);
				// sentence always starts from upper case char
				$line = preg_replace_callback('/[\.|\!|\?|\;]\s(\p{L}{1})/u', function($matches) {
					return mb_strtoupper($matches[0]);
				}, $line);
				// at the end of line add dot (if no symbol exists)
				$line = preg_replace('/(\p{L}|\}|\)|\]|\>)$/u', '$1.', $line);
				// replace 2 dots by 3 dots
				$line = preg_replace('/\.{2,}/', '...', $line);
				// count all brackets into line for debug purposes
				foreach (self::$bracketsCounter as $bracket => &$count) {
					$count = 0;
					if (preg_match_all(strtr('/(\{bracket})/', [
						'{bracket}' => $bracket,
					]), $line, $matches)) {
						$count = count($matches[1]);
					}
				}
				foreach ([
					'{' => '}',
					'(' => ')',
					'[' => ']',
				] as $open => $close) {
					if (self::$bracketsCounter[$open] !== self::$bracketsCounter[$close]) {
						dumpp('Syntax error of brackets count.', $line);
					}
				}
			}
		}

		return $json;
    }
}
