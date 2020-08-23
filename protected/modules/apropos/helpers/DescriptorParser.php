<?php

class DescriptorParser
{
	public static $options = [
		'suffixes' => [
			'{FAROUSAL}' => [
				'empty' => false,
				'allow' => [
					'ую',
					'ый',
					'а',
					'ой',
					'ыми',
					'ая',
					'ых',
					'ым',
					'ого',
					'ом',
					'ые',
				],
			],
			'{MAROUSAL}' => [
				'empty' => false,
				'allow' => [
					'ым',
					'ый',
					'ого',
				],
			],
			'{WTANAL}' => [
				'empty' => false,
				'allow' => [
					'ую',
					'ая',
					'ой',
					'ого',
					'ое',
					'ый',
					'ые',
				],
			],
			'{WTORAL}' => [
				'empty' => false,
				'allow' => [
					'ый',
				],
			],
			'{WTVAGINAL}' => [
				'empty' => false,
				'allow' => [
					'ую',
					'ая',
					'ой',
					'ые',
					'ых',
					'ое',
					'ый',
				],
			],
			'{PUSSY}' => [
				'empty' => false,
				'allow' => [
					'а',
					'е',
					'у',
					'ой',
				],
			],
			'{PUSSIES}' => [
				'empty' => false,
				'allow' => [
					'ы',
				],
			],
			'{ASS}' => [
				'empty' => false,
				'allow' => [
					'а',
					'е',
					'у',
					'ой',
				],
			],
			'{ASSES}' => [
				'empty' => false,
				'allow' => [
					'ы',
				],
			],
			'{MOUTH}' => [
				'empty' => true,
				'allow' => [],
			],
			'{HEAVING}' => [
				'empty' => false,
				'allow' => [
					'ые',
					'ым',
					'ыми',
					'ых',
				],
			],
			'{BOOBS}' => [
				'empty' => false,
				'allow' => [
					'ки',
					'кам',
					'ками',
					'ках',
				],
			],
			'{SLOPPY}' => [
				'empty' => false,
				'allow' => [
					'ая',
					'ую',
					'ой',
				],
			],
			'{CUM}' => [
				'empty' => false,
				'allow' => [
					'а',
					'у',
					'ой',
					'е',
				],
			],
			'{CUMS}' => [
				'empty' => false,
				'allow' => [
					'ы',
				],
			],
			'{SALTY}' => [
				'empty' => false,
				'allow' => [
					'ом',
					'ого',
					'ому',
					'ый',
					'ые',
					'ых',
					'ым',
					'ыми',
				],
			],
			'{HUGE}' => [
				'empty' => false,
				'allow' => [
					'ом',
					'ого',
					'ому',
					'ый',
					'ые',
					'ых',
					'ым',
					'ыми',
				],
			],
			'{HUGELOAD}' => [
				'empty' => false,
				'allow' => [
					'ом',
					'ого',
					'ому',
					'ый',
					'ые',
					'ых',
					'ым',
					'ыми',
				],
			],
			'{COCK}' => [
				'empty' => true,
				'allow' => [
					'а',
					'е',
					'у',
					'ом',
					'ов',
					'ах',
					'ами',
					'ы',
				],
			],
			'{BUGCOCK}' => [
				'empty' => true,
				'allow' => [
					'а',
					'е',
					'у',
					'ом',
					'ов',
					'ах',
					'ами',
				],
			],
			'{BUGCOCKS}' => [
				'empty' => false,
				'allow' => [
					'ы',
				],
			],
			'{FUCK1}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK2}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK3}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK4}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK5}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK6}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK7}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK8}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK9}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK10}' => [
				'empty' => true,
				'allow' => [],
			],
			'{FUCK11}' => [
				'empty' => true,
				'allow' => [],
			],
		],
		'prevs' => [
			'{PUSSY}' => [
				'{WTVAGINAL}',
				'{FAROUSAL}',
			],
			'{PUSSIES}' => [
				'{WTVAGINAL}',
				'{FAROUSAL}',
			],
			'{ASS}' => [
				'{WTANAL}',
				'{FAROUSAL}',
			],
			'{ASSES}' => [
				'{WTANAL}',
				'{FAROUSAL}',
			],
			'{MOUTH}' => [
				'{WTORAL}',
				'{FAROUSAL}',
			],
			'{BOOBS}' => [
				'{HEAVING}',
			],
			'{CUM}' => [
				'{SLOPPY}',
			],
			'{CUMS}' => [
				'{SLOPPY}',
			],
			'{COCK}' => [
				'{MAROUSAL}',
				'{SALTY}',
				'{HUGE}',
				'{HUGELOAD}',
			],
			'{BUGCOCK}' => [
				'{MAROUSAL}',
				'{HUGELOAD}',
				'{HUGE}',
				'{SALTY}',
			],
			'{BUGCOCKS}' => [
				'{MAROUSAL}',
				'{HUGELOAD}',
				'{HUGE}',
				'{SALTY}',
			],
		],
		'addictives' => [
			'{PUSSY}' => [
				'моя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'мою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'твоя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'твою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'ваша' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'вашу' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
				'её' => [
					'suffix'  => [
						'у'  => 'ую',
						'а'  => 'ая',
						'е'  => 'ой',
						'ой' => 'ой',
					],
					'addicts' => [
						'{WTVAGINAL}',
						'{FAROUSAL}',
					],
				],
			],
			'{ASS}' => [
				'моя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'мою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'твоя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'твою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'ваша' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'вашу' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
				'её' => [
					'suffix'  => [
						'у'  => 'ую',
						'а'  => 'ая',
						'е'  => 'ой',
						'ой' => 'ой',
					],
					'addicts' => [
						'{WTANAL}',
						'{FAROUSAL}',
					],
				],
			],
			'{MOUTH}' => [
				'мой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{WTORAL}',
						'{FAROUSAL}',
					],
				],
				'твой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{WTORAL}',
						'{FAROUSAL}',
					],
				],
				'ваш' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{WTORAL}',
						'{FAROUSAL}',
					],
				],
				'её' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{WTORAL}',
						'{FAROUSAL}',
					],
				],
			],
			'{BOOBS}' => [
				'её' => [
					'suffix'  => [
						'ки' => 'ые',
						'кам' => 'ым',
						'ками' => 'ыми',
						'ках' => 'ых',
					],
					'addicts' => [
						'{HEAVING}',
					],
				],
				'мои' => [
					'suffix'  => 'ые',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'моих' => [
					'suffix'  => 'ых',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'моими' => [
					'suffix'  => 'ыми',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'твои' => [
					'suffix'  => 'ые',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'твоих' => [
					'suffix'  => 'ых',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'твоими' => [
					'suffix'  => 'ыми',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'ваши' => [
					'suffix'  => 'ые',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'ваших' => [
					'suffix'  => 'ых',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'вашими' => [
					'suffix'  => 'ыми',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'свои' => [
					'suffix'  => 'ые',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'своих' => [
					'suffix'  => 'ых',
					'addicts' => [
						'{HEAVING}',
					],
				],
				'своими' => [
					'suffix'  => 'ыми',
					'addicts' => [
						'{HEAVING}',
					],
				],
			],
			'{CUM}' => [
				'моя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'мою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'моей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'твоя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'твою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'твоей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'своя' => [
					'suffix'  => 'ая',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'свою' => [
					'suffix'  => 'ую',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'своей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'его' => [
					'suffix'  => [
						'а' => 'ая',
						'у' => 'ую',
						'ой' => 'ой',
						'е' => 'ой',
					],
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'их' => [
					'suffix'  => [
						'а' => 'ая',
						'у' => 'ую',
						'ой' => 'ой',
						'е' => 'ой',
					],
					'addicts' => [
						'{SLOPPY}',
					],
				],
			],
			'{CUMS}' => [
				'моей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'твоей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'своей' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'его' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
				'их' => [
					'suffix'  => 'ой',
					'addicts' => [
						'{SLOPPY}',
					],
				],
			],
			'{COCK}' => [
				'мой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
				'твой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
				'ваш' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
				'свой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
				'своим' => [
					'suffix'  => 'ым',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
				'его' => [
					'suffix'  => [
						''  => 'ый',
						'а' => 'ого',
						'е' => 'ом',
						'у' => 'му',
						'ом' => 'ым',
					],
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGE}',
					],
				],
			],
			'{BUGCOCK}' => [
				'мой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
				'твой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
				'ваш' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
				'свой' => [
					'suffix'  => 'ый',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
				'своим' => [
					'suffix'  => 'ым',
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
				'его' => [
					'suffix'  => [
						''  => 'ый',
						'а' => 'ого',
						'е' => 'ом',
						'у' => 'му',
						'ом' => 'ым',
					],
					'addicts' => [
						'{MAROUSAL}',
						'{SALTY}',
						'{HUGELOAD}',
					],
				],
			],
		],
		'alternates' => [
			'{WTANAL}' => [
				'prefixes' => [
					'туг',
				],
			],
			'{WTVAGINAL}' => [
				'prefixes' => [
					'туг',
				],
			],
			'{FAROUSAL}' => [
				'prefixes' => [
					'туг',
				],
			],
			'{PUSSY}' => [
				'suffixes' => [
					'ке' => 'е',
				],
			],
		],
		'disallows' => [
			'words' => [
				'кончу',
			],
		],
		'_wts' => [
			'Anal'    => '{WTANAL}',
			'Oral'    => '{WTORAL}',
			'Vaginal' => '{WTVAGINAL}',
		],
	];
	public static $counter = 0;

	public static function apply($text, $file)
	{
		// normalize options
		Apropos::setSrcPath(Apropos::getUtilsPath());
		$options = array_merge(static::$options, [
			'descriptors' => Apropos::descriptors(null, false, false),
		]);
		// normalize disallowed wts depends on file name
		$_wt = null;
		if (preg_match(strtr('/\_({wts})(\_|\.)/', [
			'{wts}' => implode('|', array_keys($options['_wts'])),
		]), $file, $matches)) {
			$_wt = $options['_wts'][$matches[1]];
		}
		// normalize allowed prevs (remove disallowed wts)
		foreach ($options['prevs'] as $curr => &$prevs) {
			if (in_array($_wt, $prevs)) {
				$prevs = [$_wt];
			} else {
				$prevs = array_values(array_diff($prevs, $options['_wts']));
			}
		}
		// normalize allowed addictives (remove disallowed wts)
		foreach ($options['addictives'] as $curr => &$prevs) {
			foreach ($prevs as $prev => &$opts) {
				if (in_array($_wt, $opts['addicts'])) {
					$opts['addicts'] = [$_wt];
				} else {
					$opts['addicts'] = array_values(array_diff($opts['addicts'], $options['_wts']));
				}
			}
		}

		$handles = array_intersect_key($options['descriptors'], array_flip([
			'{PUSSY}',
			'{PUSSIES}',
			'{ASS}',
			'{ASSES}',
			'{MOUTH}',
			'{BOOBS}',
			'{CUM}',
			'{CUMS}',
			'{COCK}',
			'{BUGCOCK}',
			'{BUGCOCKS}',
			'{FUCK1}',
			'{FUCK2}',
			'{FUCK3}',
			'{FUCK4}',
			'{FUCK5}',
			'{FUCK6}',
			'{FUCK7}',
			'{FUCK8}',
			'{FUCK9}',
			'{FUCK10}',
			'{FUCK11}',
		]));

		while (static::applyDescriptor($text, $handles, $options) !== false) {}

		return $text;
	}

	/**
	 * 1) Refactor this method for remove dublicated code
	 */
	protected static function applyDescriptor(&$text, $descriptors, $options)
	{
		foreach ($descriptors as $descriptor => $prefixes) {
			if (preg_match_all(strtr('/(\p{L}*\s)?({prefixes})(\p{L}*)/u', [
				'{prefixes}' => static::preparePrefixes($prefixes, $descriptor, $options),
			]), $text, $matches, PREG_OFFSET_CAPTURE)) {
				$suffixes = $matches[3];

				foreach ($suffixes as $i => $suffix) {
					if (in_array($suffix[0], $options['suffixes'][$descriptor]['allow'])) {
						$suffixV = $suffix[0];
					} elseif (!$suffix[0] && $options['suffixes'][$descriptor]['empty']) {
						$suffixV = $suffix[0];
					} elseif (isset($options['alternates'][$descriptor]['suffixes'][$suffix[0]])) {
						$suffixV = $options['alternates'][$descriptor]['suffixes'][$suffix[0]];
					} else {
						continue;
					}
					$previous = $matches[1][$i];
					$prefix   = $matches[2][$i];
					$prefixV  = $prefix[0];
					// disallow some words
					if (in_array($prefixV.$suffixV, $options['disallows']['words'])) {
						continue;
					}

					// normalize previous
					$previousV = trim($previous[0]);
					$previousV = $previousV ?: null;
					// fix php PREG_OFFSET_CAPTURE bug for UTF-8
					// https://bugs.php.net/bug.php?id=37391
					$previous[1] = mb_strlen(substr($text, 0, $previous[1]));
					$prefix[1]   = mb_strlen(substr($text, 0, $prefix[1]));
					$suffix[1]   = mb_strlen(substr($text, 0, $suffix[1]));

					$prevT = mb_substr($text, 0, $prefix[1]);
					$nextT = mb_substr($text, $suffix[1] + mb_strlen($suffix[0]));

					if ($previousV) {
						if (isset($options['addictives'][$descriptor][mb_strtolower($previousV)])) {
							$addict   = $options['addictives'][$descriptor][mb_strtolower($previousV)];
							// calculate addict's suffix
							$_sufixAV = $addict['suffix'];
							if (is_array($_sufixAV)) {
								if (isset($_sufixAV[$suffix[0]])) {
									$_sufixAV = $_sufixAV[$suffix[0]];
								} else {
									goto applyFinish;
								}
							}

							$_prevT = mb_substr($prevT, 0, $previous[1]);
							$_nextT = mb_substr($prevT, $previous[1] + mb_strlen($previousV));
							$prevT  = strtr('{prevT}{previousV} {prefix}{suffix}{nextT}', [
								'{prevT}'     => $_prevT,
								'{previousV}' => $previousV,
								'{prefix}'    => $addict['addicts'][rand(0, count($addict['addicts'])-1)],
								'{suffix}'    => $_sufixAV,
								'{nextT}'     => $_nextT,
							]);
							static::$counter += 1;
						} elseif (isset($options['prevs'][$descriptor])) {
							foreach ($options['prevs'][$descriptor] as $_descriptor) {
								$_prefixes = $options['descriptors'][$_descriptor];

								if (preg_match(strtr('/({prefixes})(\p{L}*)\s$/u', [
									'{prefixes}' => static::preparePrefixes($_prefixes, $_descriptor, $options),
								]), $prevT, $_matches, PREG_OFFSET_CAPTURE)) {
									$_suffix = $_matches[2];

									if (in_array($_suffix[0], $options['suffixes'][$_descriptor]['allow'])) {
										$_suffixV = $_suffix[0];
									} elseif (isset($options['alternates'][$_descriptor]['suffixes'][$_suffix[0]])) {
										$_suffixV = $options['alternates'][$_descriptor]['suffixes'][$_suffix[0]];
									} else {
										continue;
									}

									$_prefix = $_matches[1];
									// fix php PREG_OFFSET_CAPTURE bug for UTF-8
									// https://bugs.php.net/bug.php?id=37391
									$_prefix[1] = mb_strlen(substr($prevT, 0, $_prefix[1]));
									$_suffix[1] = mb_strlen(substr($prevT, 0, $_suffix[1]));

									$_prevT = mb_substr($prevT, 0, $_prefix[1]);
									$_nextT = mb_substr($prevT, $_suffix[1] + mb_strlen($_suffix[0]));
									$prevT  = strtr('{prevT}{prefix}{suffix}{nextT}', [
										'{prevT}'  => $_prevT,
										'{prefix}' => $_descriptor,
										'{suffix}' => $_suffixV,
										'{nextT}'  => $_nextT,
									]);
									static::$counter += 1;
									break;
								}
							}
						}
					}

					// function label for goto operator
					applyFinish:

					$text = strtr('{prevT}{prefix}{suffix}{nextT}', [
						'{prevT}'  => $prevT,
						'{prefix}' => $descriptor,
						'{suffix}' => $suffixV,
						'{nextT}'  => $nextT,
					]);
					static::$counter += 1;

					return true;
				}
			}
		}

		return false;
	}

	protected static function preparePrefixes($prefixes, $descriptor, $options)
	{
		// find by alternative prefixes also
		if (isset($options['alternates'][$descriptor]['prefixes'])) {
			$prefixes = array_merge(
				$prefixes,
				$options['alternates'][$descriptor]['prefixes']
			);
		}
		// prepare prefixes order before regular expression
		// most longer prefixes will parsed firstly
		usort($prefixes, function($a, $b) {
			$a = mb_strlen($a);
			$b = mb_strlen($b);
			if ($a == $b) {
				return 0;
			}
			return ($a > $b) ? -1 : 1;
		});

		return implode('|', $prefixes);
	}

	// @TODO for debug only
	public static function findPrefixes($path)
	{
		Apropos::setSrcPath(Apropos::getUtilsPath());
		$descriptors  = Apropos::descriptors(null, false, false);
		$findPrefixes = array_combine(
			array_keys($descriptors),
			array_fill(0, count($descriptors), [])
		);

//		dump('DESCRIPTORS', $descriptors, DD10);
		
		$folders = scandir($path);
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
						foreach ($descriptors as $descriptor => $prefixes) {
							if (preg_match_all(strtr('/\s({prefixes})([\p{L}]*)/u', [
								'{prefixes}' => implode('|', $prefixes),
							]), $line, $matches, PREG_OFFSET_CAPTURE)) {
								if (!isset($findPrefixes[$descriptor]['suffixes'])) {
									$findPrefixes[$descriptor] = [
										'suffixes' => [],
										'prefixes' => [],
									];
								}

								foreach ($matches[1] as $i => $prefix) {
									if (!isset($findPrefixes[$descriptor]['prefixes'][$prefix[0]])) {
										$findPrefixes[$descriptor]['prefixes'][$prefix[0]] = [
											'length'   => 0,
											'suffixes' => [],
										];
									}
									$findPrefixes[$descriptor]['prefixes'][$prefix[0]]['length'] += 1;

									$suffix = $matches[2][$i][0];
									if (empty($suffix)) {
										continue;
									}
									if (!isset($findPrefixes[$descriptor]['prefixes'][$prefix[0]]['suffixes'][$suffix])) {
										$findPrefixes[$descriptor]['prefixes'][$prefix[0]]['suffixes'][$suffix] = 0;
									}
									$findPrefixes[$descriptor]['prefixes'][$prefix[0]]['suffixes'][$suffix] += 1;

									if (!isset($findPrefixes[$descriptor]['suffixes'][$suffix])) {
										$findPrefixes[$descriptor]['suffixes'][$suffix] = 0;
									}
									$findPrefixes[$descriptor]['suffixes'][$suffix] += 1;
								}
							}
						}
					}
				}
			}
		}

		$undefinedSuffixes = [];
		foreach ($findPrefixes as $descriptorID => $options) {
			if (!isset(static::$suffixes[$descriptorID])) {
				$undefinedSuffixes[$descriptorID] = $options['suffixes'];
			} else {
				$undefinedSuffixes[$descriptorID] = array_diff_key(
					$options['suffixes'],
					array_flip(static::$suffixes[$descriptorID])
				);
			}
		}

//		dump('UNDEFINED SUFFIXES', $undefinedSuffixes, DD10);
		
		dump('PREFIXES', $findPrefixes, DD10);
		
		return $findPrefixes;
	}
}
