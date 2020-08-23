<?php
/**
 * DbSpellingFixerController
 * 
 * @todo check
 * Вы принимаете его пенис в {PUSSYE}.
 * хоботоку Аааххх, он огромный! Я двигаю бедра взад и вперед, стараясь привыкнуть к его {SALTYY}му {BUGCOCK}у.
 */
class DbSpellingFixerController extends DbController
{
	public $excludeError  = [];
	public $replaceError  = [];
	public $replaceBefore = [];
	public $replaceAfter  = [];

	public function init()
	{
		parent::init();

		if (!property_exists($this, 'descriptorsParams')) {
			throw new Exception('The property `descriptorsParams` with list of all predefined static parameters must be set before load Yandex Errors.');
		}
	}

	public function actionTest()
	{
		
//		dump($this->loadErroredList());
		
		$file = 'FemaleActor_WearTearReduced_Vaginal.txt';
		$text = 'Боль в её пилотке уменьшается.';
//		$text = 'Твой ротик наполнен спермой.';
		$r = DescriptorParser::apply($text, $file);
		dump('TEST DONE', $file, $text, $r, DD10);
	}

	/**
	 * This action must be runned only after LoadYandexErrors.
	 */
	public function actionRun()
	{
		$timeStart = microtime(true);
		// set max time of execution to 180min
		// before script automatically stops
		set_time_limit(60 * 60 * 3);

		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath() . '/src';
		if (!file_exists($this->getDstPath() . '/load-yandex-errors.json')) {
			throw new Exception('This action must be runned only after LoadYandexErrors.');
		}

//		dump(DescriptorParser::findPrefixes($dstPath));

		if (is_dir($dstPath)) {
			CFileHelper::removeDirectory($dstPath);
		}
		mkdir($dstPath);

//		dump($fixedList, DD10);

		$folders   = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..'/* || $folder!=='FemaleActor_Male'*/) {
				continue;
			}

			$srcFolderPath = $srcPath . '/' . $folder;
			$dstFolderPath = $dstPath . '/' . $folder;
			if (is_file($srcFolderPath)) {
				if (!copy($srcFolderPath, $dstFolderPath)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $srcFolderPath,
					]));
				}
				continue;
			} elseif (in_array($folder, Apropos::$excludeFolders)) {
				CFileHelper::copyDirectory($srcFolderPath, $dstFolderPath);
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
				$srcFileJson = json_decode(file_get_contents($srcFilePath), true);
				foreach ($srcFileJson as $person => &$lines) {
					foreach ($lines as &$line) {
						$line = $this->loadFixedLine($line, $file);
					}
				}
				file_put_contents($dstFilePath, json_encode($srcFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}

		// copy new configs
		$utilsPath     = $this->getUtilsPath();
		$dstConfigPath = $dstPath;
		if ($this->version === 1) {
			$dstConfigPath .= '/bdsm';
			if (!is_dir($dstConfigPath)) {
				mkdir($dstConfigPath);
			}
		}
		foreach ([
			'Arousal_Descriptors.txt',
			'Synonyms.txt',
			'WearAndTear_Descriptors.txt',
		] as $configFile) {
			$srcConfigFilePath = $utilsPath . '/' . $configFile;
			$dstConfigFilePath = $dstConfigPath . '/' . $configFile;
			if (!copy($srcConfigFilePath, $dstConfigFilePath)) {
				throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
					'{file}' => $srcConfigFilePath,
				]));
			}
		}

		Apropos::setSrcPath($dstConfigPath);
		$this->generateReadmy();
		$timeEnd = microtime(true);

		dump('OK ('.(($timeEnd-$timeStart)/60).'min)', DescriptorParser::$counter);
	}

	/**
	 * This action must be runned first.
	 */
	public function actionLoadYandexErrors()
	{
		// set max time of execution to 120min
		// before script automatically stops
		set_time_limit(60 * 60 * 2);

		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath();
		if (!is_dir($dstPath)) {
			mkdir($dstPath, 0777, true);
		}

		$descriptors             = $this->descriptorsParams;
		$findDescriptors		 = $this->findDescriptors($srcPath);
		$undefinedDescriptors	 = array_diff_key($findDescriptors, $descriptors);
		if (!empty($undefinedDescriptors)) {
			dump('ERROR ON UNDEFINED DESCRIPTORS', $undefinedDescriptors, DD10);
		}

		$dstFilePath = $dstPath . '/load-yandex-errors.json';
		if (!file_exists($dstFilePath)) {
			file_put_contents($dstFilePath, '{}');
		}
		$dstFileJson = json_decode(file_get_contents($dstFilePath), true);

		$folders = scandir($srcPath);
		foreach ($folders as $folder) {
			if ($folder === '.' || $folder === '..') {
				continue;
			}

			$srcFolderPath = $srcPath . '/' . $folder;
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
						if (!isset($dstFileJson[$line])) {
							$dstFileJson[$line]	 = false;
							$text				 = strtr($line, $descriptors);
							$errors				 = $this->loadYandexErrors($text);
							if (!empty($errors)) {
								$suggests = [];
								foreach ($errors as $error) {
									$suggests[$error['word']] = $error['s'][0];
								}
								$dstFileJson[$line] = [
									'text'		 => $text,
									'suggests'	 => $suggests,
									'errors'	 => $errors,
								];
							}
						}
					}
				}

				file_put_contents($dstFilePath, json_encode($dstFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}

		dump('OK');
	}

	protected function loadFixedLine($line, $file)
	{
		$dstPath	     = $this->getDstPath();
		$descriptors     = $this->descriptorsParams;
		$dstYandexErrors = json_decode(file_get_contents($dstPath . '/load-yandex-errors.json'), true);
		if (!isset($dstYandexErrors[$line])) {
			throw new Exception('Something went wrong.');
		}

		$text = strtr($line, $descriptors);
		$opts = $dstYandexErrors[$line];

		if ($opts !== false) {
			if ($text !== $opts['text']) {
				throw new Exception('Something went wrong.');
			}

			$replaceErrors = [];
			foreach ($opts['errors'] as $error) {
				$errored = $error['word'];
				if (in_array($errored, $this->excludeError, true)) {
					continue;
				}

				$suggested = $error['s'][0];
				if (isset($this->replaceError[$errored])) {
					$suggested = $this->replaceError[$errored];
				}

				$replaceErrors[$errored] = $suggested;
			}

			$text = str_replace(
				array_keys($replaceErrors),
				array_values($replaceErrors),
				$text
			);
		}

		$text = str_replace(
			array_keys($this->replaceAfter),
			array_values($this->replaceAfter),
			$text
		);

		$text = DescriptorParser::apply($text, $file);

		return $text;
	}

	protected function loadErroredList()
	{
		$dstPath	     = $this->getDstPath();
		$dstYandexErrors = json_decode(file_get_contents($dstPath . '/load-yandex-errors.json'), true);

		$erroredList = [];
		foreach ($dstYandexErrors as $line => $opts) {
			if ($opts === false) {
				continue;
			}

			foreach ($opts['errors'] as $error) {
				$errored = $error['word'];
				if (in_array($errored, $this->excludeError, true)) {
					continue;
				}

				$suggested = $error['s'][0];
				if (isset($this->replaceError[$errored])) {
					$suggested = $this->replaceError[$errored];
				}

				$prefix  = mb_substr($opts['text'], 0, $error['pos']);
				$postfix = mb_substr($opts['text'], $error['pos'] + $error['len']);
				$text    = strtr('{prefix}>>>{errored}<<<{postfix}', [
					'{prefix}'	=> $prefix,
					'{errored}'	=> mb_strtoupper($errored),
					'{suggest}'	=> mb_strtoupper($suggested),
					'{postfix}' => $postfix,
				]);
				$erroredList[$errored][$suggested] [] = $text;
			}
		}

		return $erroredList;
	}

	protected function generateReadmy()
    {
		$srcPath = $this->getSrcPath();
		$dstPath = $this->getDstPath();
		if (!is_dir($dstPath)) {
			mkdir($dstPath);
		}

		$readmyText = <<<EOD
----------------------------------------------------------------------
Исправленные синтаксические ошибки(Общее количество: {n1}).
Удалённые дескрипторы(Количество: дэскрипторов {n2} / вхождений {n3}).
Добавленные дескрипторы(Количество: дэскрипторов {n4} / вхождений {n5}).
----------------------------------------------------------------------
Описание: все ошибки валидировались с помощью Yandex Spelling API в
автоматическом режиме, далее проверялись вручную и исключались не
корректные варианты, либо заменялись на подходящие. Все
дэскрипторы были полностью удалены ввиду того, что некоторые из них
работали не правильно (имели не правильные окончания). Вручную создан
список новых дэскрипторов и вставлен в автоматическом режиме в подходящие
места (также добавились дэскрипторы износа Wear And Tear - 3 штуки и
и 2 дэскриптора женский и мужской Arousals). Список новых дэскрипторов
в соответствующих файлах:
Arousal_Descriptors.txt
Synonyms.txt
WearAndTear_Descriptors.txt
----------------------------------------------------------------------
Список исправленных синтаксических ошибок:
EOD;

		$n1 = 0;
		foreach ($this->replaceBefore as $errored => $suggested) {
			$n1         += 1;
			$readmyText .= PHP_EOL . strtr('| {errored} >>> {suggested}', [
				'{errored}'   => $errored,
				'{suggested}' => $suggested,
			]);
		}
		foreach ($this->replaceAfter as $errored => $suggested) {
			$n1         += 1;
			$readmyText .= PHP_EOL . strtr('| {errored} >>> {suggested}', [
				'{errored}'   => $errored,
				'{suggested}' => $suggested,
			]);
		}

		$erroredList = $this->loadErroredList();
		foreach ($erroredList as $errored => $suggests) {
			foreach ($suggests as $suggested => $lines) {
				$readmyText .= PHP_EOL . strtr('| {errored} >>> {suggested}', [
					'{errored}'   => $errored,
					'{suggested}' => $suggested,
				]);
				foreach ($lines as $line) {
					$n1         += 1;
					$readmyText .= PHP_EOL . '| | | ' . $line;
				}
			}
		}

		$findDescriptors = $this->findDescriptors($srcPath);
		$descriptors     = Apropos::descriptors(null, false, false);

		$readmyText = strtr($readmyText, [
			'{n1}' => $n1,
			// + 5 (3 wear and tear + 2 arousals)
			'{n2}' => count($findDescriptors) + 5,
			'{n3}' => array_sum(array_column($findDescriptors, 'length')),
			'{n4}' => count($descriptors),
			'{n5}' => DescriptorParser::$counter,
		]);

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
