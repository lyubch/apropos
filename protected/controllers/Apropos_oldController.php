<?php

use Yandex\Speller\SpellerClient;
use Yandex\Dictionary\DictionaryClient;
use \Dejurin\GoogleTranslateForFree;
use \Statickidz\GoogleTranslate;



//'alternatePrefixes' => [
//			'{COCK}' => [
//				'suffix' => null,
//				'prefix' => [
//					'хуй',
//				],
//			],
//		],
//'{SLOPPY}' => [
//				'ого',
//				'ое',
//				'ый',
//				'ыми',
//]
		// @TODO
		// check lower case prefix
		// preg match `i` modifier
//'{SLOPPY2}' => [
//				'empty' => false,
//				'allow' => [
//					'ая',
//					'ую',
//					'ей',
//				],
//			],
//			"{SLOPPY2}": [
//				"горяч"
//			],
//			
		// remove 
//		$directoryList = $this->directoryList($srcPath);
//		foreach ($directoryList as $folder => &$files) {
//			foreach ($files as $file => &$srcFilePath) {
//				$srcFileJson = json_decode(file_get_contents($srcFilePath), true);
//				foreach ($srcFileJson as $personID => &$lines) {
//					foreach ($lines as $lineID => &$line) {
//						foreach ($this->excludeLines as $excludeLine) {
//							if (mb_strpos($line, $excludeLine) !== false) {
//								unset($srcFileJson[$personID][$lineID]);
//								continue;
//							}
//						}
//					}
//				}
//
//				$srcFilePath = $srcFileJson;
//			}
//		}
//
//		dump($directoryList['FemaleActor']['FemaleActor_Masturbation.txt']);

//many {COCK}
//						'ов' => 'ых',
//						'ах' => 'ых',
//						'ами' => 'ыми',

class Apropos_oldController extends Controller
{
	public function actionTestGoogleTranslate2()
	{
		$source = 'en';
		$target = 'ru';
		$text = 'That was so good, and I don\'t know how many times I came! I wonder if she can go again?';

		$trans = new GoogleTranslate();
		$result = $trans->translateGhost($source, $target, $text);

		dump($result);
	}
	
	public function actionTestRapid()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => http_build_query([
				'source' => 'en',
				'target' => 'ru',
				'q'      => 'Hello world!',
			]),
			CURLOPT_HTTPHEADER => array(
				"accept-encoding: application/gzip",
				"content-type: application/x-www-form-urlencoded",
				"x-rapidapi-host: google-translate1.p.rapidapi.com",
				"x-rapidapi-key: 17dd992929mshd96b9a00469b13fp1ddbdajsnc9affcf4cde6"
			),
		));

		$response = curl_exec($curl);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (false === $result || 200 !== $httpcode) {
			
		}
		
		
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
	
	
	public function actionTestYandexTranslate()
	{
//		dictionary.yandex.net
//		api/v1/dicservice.json/lookup
//        api/v1/dicservice.json/getLangs
		
		
//		curl --proxy 'http://37.120.168.223:8888' -d "{\"yandexPassportOauthToken\":\"AgAAAABEndXEAATuwduyvocMHUWLg5FJR2rC3uY\"}" "https://iam.api.cloud.yandex.net/iam/v1/tokens"
		
		$keys = [
			'9c79af3d-0223-931e-b7252d6762e1',
		];
		$translator = new DictionaryClient($keys[0]);
		$translator->setProxy('http://51.68.71.95:3128');

		dump($translator->getLanguages());
	}

	public function actionTestCurl()
	{
		$proxyList = [
			'http://95.217.120.170:8888' => 0.11879,
			'http://173.212.202.65:80' => 0.323347,
			'http://51.89.32.83:3128' => 0.287213,
			'http://5.189.133.231:80' => 0.232951,
			'http://51.68.71.95:3128' => 0.377895,
			'http://37.120.168.223:8888' => 1.289359,
			'http://145.239.121.218:3129' => 1.405205,
		];
		
		$url = 'http://speller.yandex.net/services/spellservice.json/checkText';
		$url = 'https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=uk-RU&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e';

		// curl --request GET --proxy 'http://173.212.202.65:80' --url 'http://www.google.com/finance?q=EURUSD' -H 'Proxy-Connection:' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' -H 'Accept-Encoding: gzip, deflate, br' -H 'Accept-Language: en-US,en;q=0.5' -H 'Cache-Control: max-age=0' -H 'Connection: keep-alive' -H 'Upgrade-Insecure-Requests: 1' -H 'User-Agent: Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0' -v
		
		
		
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_PROXY          => 'http://37.120.168.223:8888',
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_VERBOSE        => true,
			CURLOPT_STDERR         => $verbose=fopen('php://temp', 'w+'),
		]);
		$response = curl_exec($ch);

		// https://curl.haxx.se/libcurl/c/libcurl-errors.html
		if ($error_code=curl_errno($ch)) {
			$error_msg  = curl_error($ch);
			$error_desc = curl_strerror($error_code);
			dumpp('ERROR', $error_code, $error_msg, $error_desc);
		}

		rewind($verbose);
		$verboseLog = stream_get_contents($verbose);
		
		// https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D0%BA%D0%BE%D0%B4%D0%BE%D0%B2_%D0%BE%D1%82%D0%B2%D0%B5%D1%82%D0%BE%D0%B2_FTP
		$version = curl_version();
		extract(curl_getinfo($ch));
		$metrics = <<<EOD
			URL....: $url
			Code...: $http_code ($redirect_count redirect(s) in $redirect_time secs)
			Content: $content_type Size: $download_content_length (Own: $size_download) Filetime: $filetime
			Time...: $total_time Start @ $starttransfer_time (DNS: $namelookup_time Connect: $connect_time Request: $pretransfer_time)
			Speed..: Down: $speed_download (avg.) Up: $speed_upload (avg.)
			Curl...: v{$version['version']}
EOD;

		curl_close($ch);

		dump('RESPONSE', $verboseLog, $metrics, $response);
	}

	public function actionTestGoogleTranslate()
	{
		$source = 'en';
		$target = 'ru';
		$attempts = 5;
		$text = 'Fireworks go off in your head as your fingertips go straight to your erect little clitoris.';
		
		$translator = new GoogleTranslateForFree();
		
		$result = $translator->translate($source, $target, $text, $attempts);
		
		dump($result);
	}
	
	public function actionFixV0CommonBugs()
	{
						// fix syntax errors for descriptors
						$line = str_replace([
							'{PENIS]',
							' PUSSY}',
							' MOUTH}',
							' PRIMARY}',
							'(ACTIVE})',
							'{PRIMARY ',
							'{COCK]',
							'{BOOBS]',
							'{спермы!',
							'{PRIMARY}бьется',
							'{PRIMARY}смотрит',
							'{PRIMARY}стонет',
							'{PRIMARY}широко',
							'{PRIMARY}сильно',
							'{PRIMARY}потеряла',
							'{PRIMARY}протягивает',
							'{PRIMARY}постанывает',
							'{PRIMARY}начинает',
							'{PRIMARY}раскрывает',
							'{PRIMARY}сжимается',
						], [
							'{PENIS}',
							' {PUSSY}',
							' {MOUTH}',
							' {PRIMARY}',
							'({ACTIVE})',
							'{PRIMARY} ',
							'{COCK}',
							'{BOOBS}',
							'{спермы}!',
							'{PRIMARY} бьется',
							'{PRIMARY} смотрит',
							'{PRIMARY} стонет',
							'{PRIMARY} широко',
							'{PRIMARY} сильно',
							'{PRIMARY} потеряла',
							'{PRIMARY} протягивает',
							'{PRIMARY} постанывает',
							'{PRIMARY} начинает',
							'{PRIMARY} раскрывает',
							'{PRIMARY} сжимается',
						], $line);
						// replace v1 descriptors for v2
						$line = str_replace([
							'{AASS}',
							'{PUSSYY}',
							'{PUSSYE}',
							'{SALTYY}го',
							'{SALTYY}м',
							'{SALTYY}му',
							'{SALTYY} {COCK}а',
							'{CUUM}',
							'{АСС}',
							'{BOOOBS}',
							'{PUSS}',
							'{AS}ами',
							'{AS}',
							'{ACCEPTS}',
							'{спермы}',
							'{FUUCK}',
							'{RAPED}а',
							'{RAPED}ы',
							'{RAPED}',
							'{RAPE}',
						], [
							'{ASS}',
							'{PUSSY}а',
							'{PUSSY}е',
							'{HUGE}ого',
							'{HUGE}ом',
							'{HUGE}ому',
							'{HUGE}ого {COCK}а',
							'{CUM}а',
							'{ASS}',
							'{BOOBS}ами',
							'{PUSSY}',
							'бёдрами',
							'булок',
							'ощущает',
							'{CUM}ы',
							'{FUCK}',
							'разъёбана',
							'{SODOMIZE}',
							'{SODOMIZED}',
							'{FUCKS}',
						], $line);
						// Check for invalid brackets definition
						$bracketsOpenCount  = 0;
						$bracketsCloseCount = 0;
						if (preg_match_all('/(\{)/', $line, $matches)) {
							$bracketsOpenCount += count($matches[1]);
						}
						if (preg_match_all('/(\})/', $line, $matches)) {
							$bracketsCloseCount += count($matches[1]);
						}
						if ($bracketsOpenCount !== $bracketsCloseCount) {
							throw new Exception('Syntax error of descriptor.');
						}
	}

	/**
	 * закачивает
	 * пошликать
	 */
	public function actionGenerateSpellingJson()
	{
		// set max time of execution to 60min
		// before script automatically stops
		set_time_limit(60*60);

		$v1Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-1-origin-fixed';
		$v2Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbFixedPath0  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized';
		$dbFixedPath1  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized-fix-configs';
		$jsonCashPath  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-yandex-spelling-cash.json';

		$pspellerOptions = [
			'max'    => 999999999,
			'length' => 0,
		];
		$jsonCash        = json_decode(file_get_contents($jsonCashPath), true);
		$params          = $this->descriptors(null, true);
		$folders         = scandir($dbFixedPath0);

		// process scanning folders
		foreach ($folders as $folder) {
			$folderPath = $dbFixedPath0 . '/' . $folder;
			if ($folder === '.' || $folder === '..' || !is_dir($folderPath)) {
				continue;
			}

			$files = scandir($folderPath);
			foreach ($files as $file) {
				$filePath = $folderPath . '/' . $file;
				if ($file === '.' || $file === '..') {
					continue;
				}

				$fileJson = json_decode(file_get_contents($filePath), true);
				foreach ($fileJson as $person => &$lines) {
					foreach ($lines as &$line) {
						// fix common grammar mistakes
						$line = trim(preg_replace('/[\t\s]+/', ' ', $line));
						$line = preg_replace('/([\,|\.|\!|\?|\:|\;|\'|\"])(\p{L})/u', '$1 $2', $line);
						$line = preg_replace('/(\p{L})([\{])/u', '$1 $2', $line);
						$line = preg_replace('/(\p{L})\s([\,|\.|\!|\?|\:|\;])/u', '$1$2', $line);
						$line = preg_replace('/\s+([\.|\!|\?])/', '$1', $line);
						$line = preg_replace('/\{\s?([^\}\s]+)\s?\}/', '{$1}', $line);
						$line = preg_replace_callback('/^(\p{L}{1})/u', function($matches) {
							return mb_strtoupper($matches[0]);
						}, $line);
						$line = preg_replace_callback('/[\.|\!|\?|\;]\s(\p{L}{1})/u', function($matches) {
							return mb_strtoupper($matches[0]);
						}, $line);
						$line = preg_replace('/(\p{L}|\}|\)|\]|\>)$/u', '$1.', $line);
						$line = preg_replace('/\.{2,}/', '...', $line);

						// debug lines counter
						$pspellerOptions['length'] += 1;
						// debug syntax errors
						if (!isset($jsonCash[$line])) {
							if ($pspellerOptions['length'] <= $pspellerOptions['max']) {
								$jsonCash[$line] = false;
								$text            = strtr($line, $params);
								$errors = $this->checkYandexSpelling($text);
								if (!empty($errors)) {
									$suggests = [];
									foreach ($errors as $error) {
										$suggests[$error['word']] = $error['s'][0];
									}
									$jsonCash[$line] = [
										'text'     => $text,
										'suggests' => $suggests,
										'errors'   => $errors,
									];
								}
								file_put_contents($jsonCashPath, json_encode($jsonCash, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
							}
						}
					}
				}
			}
		}
		if ($pspellerOptions['length']) {
			dump('The texts has errors!', $jsonCash, DD10);
		}

		dump('END!');
	}

	public function actionFixConfigs()
	{
		$v1Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-1-origin-fixed';
		$v2Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbFixedPath0  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized';
		$dbFixedPath1  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized-fix-configs';

		// normalize folders
		if (!is_dir($dbFixedPath1)) {
			mkdir($dbFixedPath1);
		}
		if (!is_dir($dbFixedPath1 . '/bdsm')) {
			mkdir($dbFixedPath1 . '/bdsm');
		}

		// fix and copy UniqueAnimations config file
		if (!file_exists($dbFixedPath1 . '/UniqueAnimations.txt')) {
			$existingAnimations      = $this->get_animations_from_path([$v1Path, $v2Path]);
			$v1UniqueAnimations      = $this->get_animations_from_file($v1Path . '/UniqueAnimations.txt');
			$v2UniqueAnimations      = $this->get_animations_from_file($v2Path . '/UniqueAnimations.txt');
			$v1UniqueAnimationsFound = array_intersect_key($v1UniqueAnimations, $existingAnimations);
			$v2UniqueAnimationsFound = array_intersect_key($v2UniqueAnimations, $existingAnimations);
			$uniqueAnimations        = array_merge($v1UniqueAnimationsFound, $v2UniqueAnimationsFound);
			$uniqueAnimations        = array_combine($uniqueAnimations, array_fill(0, count($uniqueAnimations), true));
			ksort($uniqueAnimations);
			if (file_put_contents($dbFixedPath1 . '/UniqueAnimations.txt', json_encode($uniqueAnimations, JSON_PRETTY_PRINT)) === false) {
				throw new Exception(strtr('Unexpected error in process of saving config file `{file}`.', [
					'{file}' => $dbFixedPath1 . '/UniqueAnimations.txt',
				]));
			}
		}

		// fix and copy AnimationPatchups config file
		if (!file_exists($dbFixedPath1 . '/AnimationPatchups.txt')) {
			$v1AnimationPatchups = json_decode(file_get_contents($v1Path . '/AnimationPatchups.txt'), true);
			$v2AnimationPatchups = json_decode(file_get_contents($v2Path . '/AnimationPatchups.txt'), true);
			$animationPatchups   = array_merge($v1AnimationPatchups, $v2AnimationPatchups);
			ksort($animationPatchups);
			if (file_put_contents($dbFixedPath1 . '/AnimationPatchups.txt', json_encode($animationPatchups, JSON_PRETTY_PRINT)) === false) {
				throw new Exception(strtr('Unexpected error in process of saving config file `{file}`.', [
					'{file}' => $dbFixedPath1 . '/AnimationPatchups.txt',
				]));
			}
		}

		// copy Arousal_Descriptors config file
		if (!file_exists($dbFixedPath1 . '/bdsm/Arousal_Descriptors.txt')) {
			if (!copy($v2Path . '/Arousal_Descriptors.txt', $dbFixedPath1 . '/bdsm/Arousal_Descriptors.txt')) {
				throw new Exception(strtr('Unexpected error in process of saving config file `{file}`.', [
					'{file}' => $dbFixedPath1 . '/Arousal_Descriptors.txt',
				]));
			}
		}

		// copy WearAndTear_Descriptors config file
		if (!file_exists($dbFixedPath1 . '/bdsm/WearAndTear_Descriptors.txt')) {
			if (!copy($v2Path . '/WearAndTear_Descriptors.txt', $dbFixedPath1 . '/bdsm/WearAndTear_Descriptors.txt')) {
				throw new Exception(strtr('Unexpected error in process of saving config file `{file}`.', [
					'{file}' => $dbFixedPath1 . '/WearAndTear_Descriptors.txt',
				]));
			}
		}

		// fix and copy Synonyms config file
		if (!file_exists($dbFixedPath1 . '/bdsm/Synonyms.txt')) {
			$synonyms = json_decode(file_get_contents($v2Path . '/Synonyms.txt'), true);
			$synonyms = array_intersect_key($synonyms, array_flip([
				'{ACCEPT}',
				'{ASS}',
				'{BEASTCOCK}',
				'{BEAST}',
				'{BITCH}',
				'{BOOBS}',
				'{BUGCOCK}',
				'{COCK}',
				'{CREAM}',
				'{CUMMING}',
				'{CUMMING1}',
				'{CUMMING2}',
				'{CUMS}',
				'{CUM}',
				'{DEAD}',
				'{FEAR}',
				'{FOREIGN}',
				'{FUCKED}',
				'{FUCKING}',
				'{FUCKS}',
				'{FUCK}',
				'{GENWT}',
				'{HEAVING}',
				'{HOLES}',
				'{HORNY}',
				'{HUGELOAD}',
				'{HUGE}',
				'{INSERT}',
				'{INSERTS}',
				'{JUICY}',
				'{LARGELOAD}',
				'{LOUDLY}',
				'{MACHINESLIME}',
				'{MACHINESLIMY}',
				'{MACHINE}',
				'{METAL}',
				'{MOANING}',
				'{MOANS}',
				'{MOAN}',
				'{MOUTH}',
				'{OPENING}',
				'{PENIS}',
				'{PROBE}',
				'{PUSSY}',
				'{QUIVERING}',
				'{SALTY}',
				'{SCREAMS}',
				'{SLIME}',
				'{SLIMY}',
				'{SLOPPY}',
				'{SLUTTY}',
				'{SODOMIZED}',
				'{SODOMIZES}',
				'{SODOMIZE}',
				'{SODOMIZING}',
				'{SOLID}',
				'{STRAPON}',
				'{SWEARING}',
				'{TASTY}',
				'{THICK}',
				'{UNTHINKING}',
				'{VILE}',
				'{WHORE}',
			]));
			foreach ($synonyms as $descriptorID => &$descriptorValues) {
				$descriptorValues = array_values(array_unique($descriptorValues));
			}
			if (file_put_contents($dbFixedPath1 . '/bdsm/Synonyms.txt', json_encode($synonyms, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) === false) {
				throw new Exception(strtr('Unexpected error in process of saving config file `{file}`.', [
					'{file}' => $dbFixedPath1 . '/bdsm/Synonyms.txt',
				]));
			}
		}

		dump('DONE!');
	}
	
	public function actionFixSpellingOld()
	{
		$v1Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-1-origin-fixed';
		$v2Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbFixedPath0  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized';
		$dbFixedPath1  = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized-fix-configs';

		$pspell        = pspell_new('ru_RU', null, null, 'utf-8');
		$pspellOptions = [
			'max'    => 500,
			'length' => 0,
			'debug'  => [],
		];
		$params        = $this->descriptors(null, true);
		$folders       = scandir($dbFixedPath0);
		$descriptors   = [];
		// process scanning folders
		foreach ($folders as $folder) {
			$folderPath = $dbFixedPath0 . '/' . $folder;
			if ($folder === '.' || $folder === '..' || !is_dir($folderPath)) {
				continue;
			}

			$files = scandir($folderPath);
			foreach ($files as $file) {
				$filePath = $folderPath . '/' . $file;
				if ($file === '.' || $file === '..') {
					continue;
				}

				$fileJson = json_decode(file_get_contents($filePath), true);
				foreach ($fileJson as $person => &$lines) {
					foreach ($lines as &$line) {
						if (preg_match_all('/(\{[^\}]+\})([\p{L}]*)/u', $line, $matches)) {
							foreach ($matches[1] as $matchID => $descriptorID) {
								if (!isset($descriptors[$descriptorID])) {
									$descriptors[$descriptorID] = [
										'length'  => 0,
										'endings' => [
											'length'  => 0,
											'letters' => [],
										],
									];
								}
								$descriptors[$descriptorID]['length'] += 1;
								if (!empty($matches[2][$matchID]) &&
									!in_array(
										$matches[2][$matchID],
										$descriptors[$descriptorID]['endings']['letters']
									)
								) {
									$descriptors[$descriptorID]['endings']['length'] += 1;
									$descriptors[$descriptorID]['endings']['letters'] []= $matches[2][$matchID];
									$descriptors[$descriptorID]['test1'] = $this->descriptors($descriptorID);
									$descriptors[$descriptorID]['test2'][$matches[2][$matchID]] = $line;
								}

							}
						}

						// fix syntax errors of text
						$_replace = [
							'{WTVAGINAL}ую {PUSSY} ' => '{WTVAGINAL}ую {PUSSY}у ',
							'{LARGELOAD} ую' => '{LARGELOAD}ую',
							'Шликать' => 'Трогать себя',
							'пошликать' => 'потрогать себя',
							'{FAROUSAL}а...' => '{FAROUSAL}ая...',
							'Оначувствует' => 'Она чувствует',
							'слышиться' => 'слышится',
							'загнаная' => 'загнанная',
							'{PUSSY}и' => '{PUSSY}ы',
							'проминаю' => 'надрачиваю',
							'проминаешь' => 'надрачиваеш',
							'проминает' => 'надрачивает',
							'анальныс' => 'анальный',
							'впечатлени¤' => 'впечатления',
							'ног.Это' => 'ног. Это',
							'останавливаетс¤' => 'останавливается',
							'{SLOPPY}ая {CUM} ' => '{SLOPPY}ая {CUM}а ',
							'моя  {PUSSY} ' => 'моя {PUSSY}а ',
							'твоя {PUSSY} ' => 'твоя {PUSSY}а ',
							'Онасовсем' => 'Она совсем',
							'Каджется' => 'Кажется',
							'Вкус сперм ' => 'Вкус спермы ',
							'{WTANAL} {ASS}а' => '{WTANAL}ая {ASS}а',
							'раздалбывать в задницу ее' => 'раздалбывать ее в задницу',
							'долбить в анал ее' => 'долбить ее в анал',
							'окрыжающие' => 'окружающие',
							'буцдет' => 'будет',
							'извнурительного' => 'изнурительного',
							'поерхность' => 'поверхность',
							' кользит ' => ' скользит ',
							'Моя {PUSSY} ' => 'Моя {PUSSY}а ',
							'смокнутыми' => 'сомкнутыми',
							'Онаполностью' => 'Она полностью',
							' дивот' => ' живот',
							'трахуть' => 'трахнуть',
							'силньо' => 'сильно',
							'сильно,как' => 'сильно, как',
							'Твоя {PUSSY} ' => 'Твоя {PUSSY}а ',
							'{THICK}ый' => '{THICK}ой',
							'ее {PUSSY} ' => 'ее {PUSSY}а ',
							'ее плотную вагину будет' => 'её плотная вагина будет',
							'возуждается' => 'возбуждается',
							'тем,что' => 'тем, что',
							'интенсиным' => 'интенсивным',
							'Яхочу' => 'Я хочу',
							'Онглубокими' => 'Он глубокими',
							'не так ли, {BITCH}?' => 'не так ли, {BITCH}а?',
							'сворепый' => 'свирепый',
							'{FUCKED}нной' => '{FUCKED}ой',
							'{FUCKED}ной' => '{FUCKED}ой',
							'{FUCKED}на' => '{FUCKED}а',
							'{FUCKED}ная' => '{FUCKED}ая',
							'как {WTVAGINAL}ая {PUSSY}а' => 'как ее {WTVAGINAL}ая {PUSSY}а',
							'ее {PUSSY}.' => 'ее {PUSSY}у.',
							'боьшой' => 'большой',
							'в оту' => 'в поту',
							'титьккам' => 'титькам',
							'но хочет поглаживания отнюдь не эго...' => 'но хочет чтобы я погладила отнюдь не его эго...',
							'опускаеюся' => 'опускаюсь',
							'Выпусклость' => 'Выпуклость',
							'Онсмотрит, как Онкончает' => 'Он смотрит, как Она кончает',
							'твыоими' => 'твоими',
							'дожна' => 'должна',
							'представляя, как ее {WTVAGINAL}ая {PUSSY}а {FUCKED}а у всех на виду' => 'представляя, как ее {WTVAGINAL}ая {PUSSY}а будет {FUCKED}а у всех на виду',
							'{BOOBS}кам' => '{BOOBS}ам',
							'Надееюсь' => 'Надеюсь',
							'Убедивишись' => 'Убедившись',
							'наблюдаешью' => 'наблюдаешь',
							'конь приближается, привлеченная' => 'конь приближается, привлеченный',
							'{WTVAGINAL}ую {PUSSY}у будет' => '{WTVAGINAL}ая {PUSSY}а будет',
							'заебаннной' => 'заебанной',
							'заебанна' => 'заебана',
							'Ее {PUSSY} ' => 'Ее {PUSSY}а ',
							'природа Скайрим ' => 'природа Скайрима ',
							'прижимешься' => 'прижимаешься',
							'Я держу его пенис между титечек.' => 'Я держу его пенис между своими {BOOBS}ами.',
							'Она держит его пенис между сисечек.' => 'Она держит его пенис между своими {BOOBS}ами.',
							'темп...Ее' => 'темп... Ее',
							'косается' => 'касается',
							'брызже ' => 'брызжет ',
							'твим' => 'твоим',
							'? было' => '? Было',
							'UA1 ' => '',
							'and' => 'и',
							'{COCK}и' => '{COCK}ы',
							'текушщие' => 'текущие',
							'Она {FUCKED}ая так жестко' => 'Она {FUCKED}а так жестко',
							'сжимаюются' => 'сжимаются',
							'{VILE}их' => '{HUGE}ых',
							'вводят {COCK}в' => 'вводят {COCK}ы в',
							'беспомощо' => 'беспомощно',
							'Слишко ' => 'Слишком ',
							'UA3 ' => '',
							'{COCK}ами {COCK}s' => '{COCK}ами',
							'UA5 ' => '',
							'UA7 ' => '',
							'моя {PUSSY} ' => 'моя {PUSSY}а ',
							'Он покорна' => 'Она покорна',
							'{PUSSY}а {FUCKED}ая таким' => '{PUSSY}а {FUCKED}а таким',
							'реально!В' => 'реально! В',
							'спариться' => 'спарится',
							'распространила себя' => 'покорно легла',
							'чувствую,как' => 'чувствую, как',
							'.Его' => '. Его',
							',что делает легче зверю' => ', чтоб зверю было легче',
							'краивую' => 'красивую',
							'медвежей' => 'медвежьей',
							'натруженой' => 'натруженной',
							'нехочу' => 'не хочу',
							'пристраеваться' => 'пристраиваться',
							'дется' => 'деться',
							'нихочешь' => 'не хочешь',
							'остовляет' => 'оставляет',
							'к воей' => 'к твоей',
							'улитит' => 'улетит',
							'крит' => 'кричит',
							'нихочет' => 'не хочет',
							'съеденой' => 'съеденной',
							'чувствуюешь' => 'чувствуешь',
							'твоеё' => 'твоей',
							'придеться' => 'придётся',
							'содрагается' => 'содрогается',
							'льються' => 'льются',
							'безъисходности' => 'безысходности',
							'компаньёна' => 'компаньона',
							'не утомимо' => 'неутомимо',
							'безсовестно' => 'бессовестно',
							'С моей письке' => 'С моей письки',
							'порнядочная' => 'порядочная',
							'почуствовала' => 'почувствовала',
							'отдатся' => 'отдаться',
							'раздолбаная' => 'раздолбанная',
							'Плмлгите' => 'Помогите',
							'Ёе' => 'Её',
							'собираеться' => 'собирается',
						];
						$line = str_replace(array_keys($_replace), array_values($_replace), $line);

						// debug syntax errors
						if ($pspellOptions['length'] <= $pspellOptions['max']) {
							$text1 = strtr($line, $params);
							$text2 = preg_replace('/[^\p{L}\s\-]/u', '', $text1);
							$words = preg_split('/[\s,]+/', $text2, null, PREG_SPLIT_NO_EMPTY);
							foreach ($words as $word) {
								if (!pspell_check($pspell, $word)) {
									if (in_array(mb_strtolower($word, 'utf-8'), [
										'извращенка',
										'ялде',
										'злокрыс',
										'какая-то',
										'ааай',
										'оох',
										'письки',
										'скайриме',
										'пиздёнки',
										'развращеная',
										'даа',
										'аааххх',
										'попользованные',
										'попользованных',
										'раздроченных',
										'раздроченных',
										'отъебана',
										'отъебаной',
										'раздроченные',
										'причендал',
										'монстрочлен',
										'хуй',
										'заебаной',
										'пользует',
										'аааа',
										'ахх',
										'талос',
										'ялдой',
										'тамриэля',
										'аай',
										'аааггхх',
										'оооххх',
										'ааагхх',
										'ебущем',
										'раздалбывают',
										'сисечкам',
										'умф',
										'а-ах',
										'да-а',
										'хуям',
										'ух-х-х',
										'охрененно',
										'отдолбаная',
										'отдолбаной',
										'риклинг',
										'попользованая',
										'попользованой',
										'спермососку',
										'спермососки',
										'херами',
										'херы',
										'спермоглоткой',
										'спермоглотку',
										'спермоглотки',
										'оттраханой',
										'хренами',
										'хрены',
										'обкончаной',
										'эякулируют',
										'риклинга',
										'спарится',
										'навождение',
										'чресле',
										'ялду',
										'предэякулята',
										'титечек',
										'м-м',
										'ах-х',
										'подрочить',
										'раздолбанные',
										'раздолбанных',
										'попользованный',
										'вафлершу',
										'вафлерши',
										'эякулируя',
										'затраханая',
										'затрахана',
										'затраханой',
										'херов',
										'выебать',
										'oпустошишь',
										'трахаюший',
										'обкончана',
										'хренах',
										'обкончанной',
										'насаживаюсь',
										'насаживаетесь',
										'подрачиваю',
										'подрачиваете',
										'подрачивает',
										'вкачивает',
										'заебана',
										'давалки',
										'да-а-а',
										'скайрима',
										'предэякулят',
										'вафлерша',
										'вафлершой',
										'отъебанная',
										'оттраханной',
										'оттрахана',
										'оттраханная',
										'отдолбанной',
										'отдолбана',
										'ебля',
										'а-а-ах',
										'раздалбывающий',
										'херах',
										'эго',
										'поглаживания',
										'oпустошу',
										'спермососке',
										'растраханная',
										'растраханной',
										'раздолбанной',
										'попользованную',
										'манды',
										'попользованной',
										'заебанная',
										'траху',
										'спермососка',
										'спермосоской',
										'эякулирует',
										'попользованна',
										'попользованнной',
										'затраханная',
										'затраханнной',
										'затрахана',
										'давалку',
										'пользуют',
										'трахом',
										'гхм',
										'попользовать',
										'вафлерше',
										'давалке',
										'давалка',
										'давалкой',
										'пиздой',
										'бля',
										'дагон',
										'вагин',
										'отдолбанная',
										'перепихону',
										'перепихона',
										'отдолбанна',
										'отдолбаннной',
										'какого-нибудь',
										'какую-нибудь',
										'м-м-м',
										'пол-пути',
										'разъебанной',
										'ебущий',
										'обкончаннной',
										'обкончанна',
										'а-а-а',
										'мандой',
										'растраханную',
										'мммм',
										'анал',
										'выебана',
										'накончал',
										'попользовали',
										'сглатываю',
										'сглатываешь',
										'сглатывает',
										'сглатывая',
										'охх',
										'разъебанная',
										'раздолбана',
										'когда-либо',
										'обкончали',
										'попользованная',
										'когда-нибудь',
										'вагиной',
										'как-нибудь',
										'следуюший',
										'камшота',
										'обкончанная',
										'оххх',
										'из-за',
										'пользовать',
										'манду',
										'хотя-бы',
										'чтож',
										'что-ж',
										'что-бы',
										'манда',
										'манде',
										'плавишься',
										'кто-то',
										'выебет',
										'раздолбанную',
										'пизду',
										'разъебанную',
										'плавлюсь',
										'ммм',
										'м-м-м-м',
										'хотела-бы',
										'облапанной',
										'выебанной',
										'если-бы',
										'ебли',
										'ебать',
										'вагину',
										'раздолбанный',
										'вагина',
										'пизда',
										'пизде',
										'пизды',
										'конча',
										'кто-нибудь',
										'теку',
										'течешь',
										'растраханный',
										'аххх',
										'трахнулась-бы',
										'алдуином',
										'вот-вот',
										'ааа',
										'алдуин',
										'трахе',
										'вагине',
										'вагины',
										'раздолбанная',
										'аналом',
										'присунули',
										'балгруф',
										'надрачиваю',
										'надрачиваеш',
										'надрачивает',
										'миньет',
										'оп-па',
										'аааагхх',
										'оттрахали',
										'какое-то',
										'секс-игрушке',
										'чего-то',
										'фистинг',
										'секс-игрушка',
										'что-то',
										'попользована',
										'разъебанный',
										'пользовали',
										'траха',
										'сисечки',
										'стервочкой',
										'секс-игрушкой',
										'спермоглотке',
										'спермоглотка',
										'раздалбывать',
										'разъебанная',
									])) {
										continue;
									}
									$suggest = pspell_suggest($pspell, $word);;
									$pspellOptions['length'] += 1;
									$pspellOptions['debug'][$word] = [$line, $text1, current($suggest), $word];
								}
							}
						}
					}
				}
			}
		}
		if ($pspellOptions['length']) {
			dump('The texts has errors!', $pspellOptions['debug']);
		}
		dump('END!');

		$_descriptors = $this->descriptors();
		dump($this->descriptors('{ASS}'), array_diff_key($descriptors, $_descriptors), DD10);
	}
	
	private function descriptors($descriptorID = null, $randomValue = false)
	{
		$path   = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized-fix-configs';
		$system = [
			'{PRIMARY}' => ['Бестия'],
			'{ACTIVE}'  => ['Балгруф Старший'],
			'{ACTIVE2}' => ['Ульфрик Буревестник'],
		];
		static $arousalDescriptors;
		static $wearAndTearDescriptors;
		static $synonyms;
		if ($arousalDescriptors === null) {
			$arousalDescriptors  = [];
			$_arousalDescriptors = json_decode(file_get_contents($path . '/bdsm/Arousal_Descriptors.txt'), true);
			foreach ($_arousalDescriptors as $_descriptorID => $_descriptorValues) {
				$arousalDescriptors[$_descriptorID] = array_values(array_unique(call_user_func_array('array_merge', $_descriptorValues)));
			}
		}
		if ($wearAndTearDescriptors === null) {
			$wearAndTearDescriptors  = [
				'{WTANAL}'    => [],
				'{WTORAL}'    => [],
				'{WTVAGINAL}' => [],
			];
			$_wearAndTearDescriptors = json_decode(file_get_contents($path . '/bdsm/WearAndTear_Descriptors.txt'), true);
			foreach (array_keys($wearAndTearDescriptors) as $_descriptorID) {
				foreach ($_wearAndTearDescriptors['descriptors'] as $_descriptorValues) {
					$wearAndTearDescriptors[$_descriptorID] = array_values(array_unique(array_merge($wearAndTearDescriptors[$_descriptorID], $_descriptorValues)));
				}
			}
		}
		if ($synonyms === null) {
			$synonyms = json_decode(file_get_contents($path . '/bdsm/Synonyms.txt'), true);
		}

		if ($descriptorID === null) {
			$descriptors = array_merge(
				$system,
				$arousalDescriptors,
				$wearAndTearDescriptors,
				$synonyms
			);
			if ($randomValue) {
				foreach ($descriptors as $descriptorID => &$descriptorValue) {
					$k = rand(0, count($descriptorValue)-1);
					!isset($descriptorValue[$k])&&dump('ERROR', $descriptorID, $descriptorValue, $k, DD10);
					$descriptorValue = $descriptorValue[$k];
				}
			}
			return $descriptors;
		}

		if (array_key_exists($descriptorID, $system)) {
			$systemDescriptor = $system[$descriptorID];
			if ($randomValue) {
				return $systemDescriptor[rand(0, count($systemDescriptor)-1)];
			}
			return $systemDescriptor;
		}

		if (array_key_exists($descriptorID, $arousalDescriptors)) {
			$arousalDescriptor = $arousalDescriptors[$descriptorID];
			if ($randomValue) {
				return $arousalDescriptor[rand(0, count($arousalDescriptor)-1)];
			}
			return $arousalDescriptor;
		}

		if (array_key_exists($descriptorID, $wearAndTearDescriptors)) {
			$wearAndTearDescriptor = $wearAndTearDescriptors[$descriptorID];
			if ($randomValue) {
				return $wearAndTearDescriptor[rand(0, count($wearAndTearDescriptor)-1)];
			}
			return $wearAndTearDescriptor;
		}

		if (array_key_exists($descriptorID, $synonyms)) {
			if ($randomValue) {
				return $synonyms[$descriptorID][rand(0, count($synonyms[$descriptorID])-1)];
			}
			return $synonyms[$descriptorID];
		}

		return null;
	}

	const TYPE_BEGIN   = 'begin';
	const TYPE_STAGE   = 'stage';
	const TYPE_ORGASM  = 'orgasm';
	const TYPE_COMBINE = 'combine';

    public function actionIndex()
    {
		$dbPath        = Yii::getPathOfAlias('webroot') . '/uploads/db-src/db-2-myname';
		$dbFixedPath   = Yii::getPathOfAlias('webroot') . '/uploads/db-fixed';
		$dbErroredPath = Yii::getPathOfAlias('webroot') . '/uploads/db-errored';
		$dbFolders     = scandir($dbPath);
		$_dbFolders    = [];
		$_errors       = [];
		
		// normalize folders
		if (is_dir($dbErroredPath)) {
			CFileHelper::removeDirectory($dbErroredPath);
		}
		if (!is_dir($dbFixedPath)) {
			mkdir($dbFixedPath);
		}

		// process scanning folders
		foreach ($dbFolders as $dbFolder) {
			if ($dbFolder === '.' || $dbFolder === '..') {
				continue;
			}
			
			$dbFolderPath  = $dbPath . '/' . $dbFolder;
			if (!is_dir($dbFolderPath)) {
				if (!copy($dbFolderPath, $dbFixedPath . '/' . $dbFolder)) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $dbFolderPath,
					]));
				}
				continue;
			}
			
			$dbFolderFiles = scandir($dbFolderPath);
			foreach ($dbFolderFiles as $dbFolderFile) {
				if ($dbFolderFile === '.' || $dbFolderFile === '..') {
					continue;
				}
				$dbFileFixed        = false;
				$dbFilePath         = $dbFolderPath . '/' . $dbFolderFile;
				$dbFileText         = file_get_contents($dbFilePath);
				$dbFileLines        = array_values(array_filter(file($dbFilePath), function($line) {
					// remove all empty lines
					if (trim($line) === '') {
						return false;
					}
					return true;
				}));
				$dbFileLinesCount   = count($dbFileLines);
				// fix if file is not valid JSON
				if (json_decode($dbFileText) === null) {
					$dbFileFixed = true;
					for ($x=0; $x<$dbFileLinesCount; $x++) {
						// fix json commas not valid for JSON format
						$lineCurr                = rtrim($dbFileLines[$x]);
						$lineCurrLen             = mb_strlen($lineCurr);
						$lineCurrLastSymb        = mb_substr($lineCurr, $lineCurrLen-1);
						$lineCurrIsOpenSymb      = in_array($lineCurrLastSymb, ['{','[',':']);
						$lineCurrIsCloseSymb     = in_array(rtrim(trim($lineCurr), ','), [']','}']);
						$lineCurrIsJsonVar       = !$lineCurrIsOpenSymb && !$lineCurrIsCloseSymb;
						$lineCurrLastSymbIsComma = $lineCurrLastSymb === ',';
						$lineNextExists          = isset($dbFileLines[$x+1]);
						$lineNext                = $lineNextExists ? rtrim($dbFileLines[$x+1]) : null;
						$lineNextIsCloseSymb     = $lineNextExists ? in_array(rtrim(trim($lineNext), ','), [']','}']) : null;
						
//						$testCond = $x === 1 && $dbFolderFile === 'FemaleActor_Giant_Anal_Stage1.txt';
//						if ($testCond) {
//							dumpp($lineCurrIsJsonVar, $lineCurrLastSymbIsComma, $lineNextIsCloseSymb);
//							dumpp($lineCurr);
//						}
						
						if ($lineCurrIsJsonVar && $lineCurrLastSymbIsComma && $lineNextIsCloseSymb) {
							$lineCurr = rtrim($lineCurr, ',');
						} elseif ($lineCurrIsJsonVar && !$lineCurrLastSymbIsComma && !$lineNextIsCloseSymb) {
							$lineCurr = rtrim($lineCurr) . ',';
						}
						$_dbFolders[$dbFolder][$dbFolderFile][$x] = $lineCurr;
						
//						if ($testCond) {
//							dumpp($lineCurr);
//						}
//						if ($testCond) {
//							dump($_dbFolders[$dbFolder][$dbFolderFile]);
//						}
						
					}
				} else {
					$_dbFolders[$dbFolder][$dbFolderFile] = $dbFileLines;
				}
				// create new dirs for fixed
				if (!is_dir($dbFixedPath . '/' . $dbFolder)) {
					mkdir($dbFixedPath . '/' . $dbFolder, 0777, true);
				}
				// create/update fixed file if now it is valid JSON
				$dbFixedFilePath = $dbFixedPath . '/' . $dbFolder . '/' . $dbFolderFile;
				if ($dbFileFixed || !file_exists($dbFixedFilePath)) {
					// reformat lines to text
					$_dbFolders[$dbFolder][$dbFolderFile] = implode($dbFileFixed ? "\n" : '', $_dbFolders[$dbFolder][$dbFolderFile]);
					// validate fixed file is valid JSON
					if (json_decode($_dbFolders[$dbFolder][$dbFolderFile]) !== null) {
						if (file_put_contents($dbFixedFilePath, $_dbFolders[$dbFolder][$dbFolderFile]) === false) {
							throw new Exception(strtr('Unexpected error in process of updating file `{file}`.', [
								'{file}' => $dbFilePath,
							]));
						}
					} else {
						// create new dirs for errored
						if (!is_dir($dbErroredPath . '/' . $dbFolder)) {
							mkdir($dbErroredPath . '/' . $dbFolder, 0777, true);
						}
						// log error
						$dbErroredFilePath = $dbErroredPath . '/' . $dbFolder . '/' . $dbFolderFile;
						file_put_contents($dbErroredFilePath, $_dbFolders[$dbFolder][$dbFolderFile]);
						$_errors []= $dbFilePath;
					}
				}
			}
		}
		// done
		$_done = 'Done!';
		if (!empty($_errors)) {
			$_done .= ' Files with errors:' . PHP_EOL;
			$_done .= ' - ' . implode(';' . PHP_EOL . ' - ', $_errors) . ';';
		}
		print(nl2br($_done));
    }

	public function actionOnlyRussian()
	{
		require_once Yii::getPathOfAlias('application') . '/../vendor/pear/text_languagedetect/Text/LanguageDetect.php';

		$languageDetect = new Text_LanguageDetect();
		$dbPath         = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-fixed';
		$dbFixedPath    = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbErroredPath  = Yii::getPathOfAlias('webroot') . '/uploads/db-errored';
		$dbFolders      = scandir($dbPath);
		
		// normalize default folders
		if (is_dir($dbErroredPath)) {
			CFileHelper::removeDirectory($dbErroredPath);
		}
		if (!is_dir($dbFixedPath)) {
			mkdir($dbFixedPath);
		}
		
		// process scanning folders
		foreach ($dbFolders as $dbFolder) {
			if ($dbFolder === '.' || $dbFolder === '..') {
				continue;
			}

			$dbFolderPath      = $dbPath . '/' . $dbFolder;
			$dbFixedFolderPath = $dbFixedPath . '/' . $dbFolder;

			// if it's some file just copy it
			if (!is_dir($dbFolderPath)) {
				if (!file_exists($dbFixedFolderPath)) {
					if (!copy($dbFolderPath, $dbFixedFolderPath)) {
						throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
							'{file}' => $dbFolderPath,
						]));
					}
				}
				continue;
			}

			// if dst folder already exists just continue
			if (is_dir($dbFixedFolderPath)) {
				continue;
			}

			$results = [
				'english' => 0,
				'total'   => 0,
			];
			$dbFolderFiles = scandir($dbFolderPath);
			foreach ($dbFolderFiles as $dbFolderFile) {
				if ($dbFolderFile === '.' || $dbFolderFile === '..') {
					continue;
				}
				
				$dbFilePath = $dbFolderPath . '/' . $dbFolderFile;
				$dbFileText = file_get_contents($dbFilePath);
				$dbFileJson = json_decode($dbFileText, true);
				if ($dbFileJson === null) {
					throw new Exception(strtr('Unexpected error in process of coping file `{file}`.', [
						'{file}' => $dbFolderPath,
					]));
				}

				$_dbFileJson = [];
				foreach ($dbFileJson as $data) {
					foreach ($data as $text) {
						$text = trim($text);
						if (empty($text)) {
							continue;
						}
						$_dbFileJson []= $text;
					}
				}

				// continue detecting if file is without any text
				// to detect any language
				if (empty($_dbFileJson)) {
					continue;
				}

				$language = $languageDetect->detectSimple($_dbFileJson[0]);

				$results['total'] += 1;
				if ($language === 'english') {
					$results['english'] += 1;
				}
			}

			// if any results available skip it
			if (!$results['total']) {
				continue;
			}

			// if english < 25% of total attempts copy folder
			if ($results['english'] < ($results['total'] / 4)) {
				if (is_dir($dbFixedFolderPath)) {
					CFileHelper::removeDirectory($dbFixedFolderPath);
				}
				CFileHelper::copyDirectory($dbFolderPath, $dbFixedFolderPath);
			} else {
				// for test purposes
				$dbErroredFolderPath = $dbErroredPath . '/' . $dbFolder;
				CFileHelper::copyDirectory($dbFolderPath, $dbErroredFolderPath);
			}
		}

		// done
		$_done = 'Done!';
		print(nl2br($_done));
	}

	public function actionGenerateCleanedScriptFile()
	{
		// set max time of execution to 5min
		// before script automatically stops
		set_time_limit(500);

		$v1Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-1-origin-fixed';
		$v2Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbFixedPath   = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed-cleaned-script-file.json';
		$dbErroredPath = Yii::getPathOfAlias('webroot') . '/uploads/db-errored-cleaned.json';
		$v1List        = $this->get_stages($v1Path);
		$v2List        = $this->get_stages($v2Path);
		$removedCount  = 0;
		$removedList   = [];

		// normalize default folders
		if (is_dir($dbErroredPath)) {
			CFileHelper::removeDirectory($dbErroredPath);
		}

		// normalize stages v2 to v1 (maximum 6 stages)
		foreach ($v2List as $folder => &$files) {
			if (in_array($folder, [
				'femaleactor_estrus',
				'femaleactor_estrustentacledouble',
				'femaleactor_estrustentacleside',
				'femaleactor_anubs_anub_horse_missionary',
			])) {
				continue;
			}
			foreach ($files as $file => &$v2Stages) {
				$min      = 4;
				$max      = 5;
				$v1Stages = null;
				if (isset($v1List[$folder][$file])) {
					$v1Stages      = $v1List[$folder][$file];
					$v1StagesCount = count($v1Stages);
					$max           = ($v1StagesCount >= $min) ? $v1StagesCount : $max;
				}

				$v2Stages = array_values($v2Stages);
				if (count($v2Stages) <= $max) {
					continue;
				}

				if (($removedKey=$this->removeIdenticalText($v2Stages, 0, 1)) !== false) {
					$removedCount += 1;
					$removedList[$folder][$file][$removedKey] = true;
					$v2Stages = array_values($v2Stages);
					if (count($v2Stages) <= $max) {
						continue;
					}
				}

				$maxAttempts                   = 5;
				$stagesCountBeforeFirstAttempt = count($v2Stages);
				for ($attempt=1; $attempt<=$maxAttempts; $attempt++) {
					// first attempt no result - STOP attempts
					if ($attempt > 1 &&
						$stagesCountBeforeFirstAttempt === count($v2Stages)
					) {
						break;
					}
					for ($key1=1; $key1<(count($v2Stages)-2); $key1++) {
						// stages already normalized - STOP attempts
						if (count($v2Stages) <= $max) {
							break;
						}
						for ($key2=$key1+1; $key2<(count($v2Stages)-1); $key2++) {
							// stages already normalized - STOP attempts
							if (count($v2Stages) <= $max) {
								break;
							}
							if (($removedKey=$this->removeIdenticalText($v2Stages, $key1, $key2)) !== false) {
								$removedCount += 1;
								$removedList[$folder][$file][$removedKey] = true;
								// there are extra stages after removing
								// one - break to next key to check identical
								break;
							}
						}
					}
				}

				if (count($v2Stages) < $max) {
					throw new Exception('Stages < MAX. Error on removing identical text. To many removed...');
				}
			}
		}

		$v2List = $this->stages_fix_ids($v2List);
		file_put_contents($dbFixedPath, json_encode($v2List, JSON_PRETTY_PRINT));

		$removedList = $this->array_intersect_key_recursive($this->get_stages($v2Path), $removedList);
		file_put_contents($dbErroredPath, json_encode($removedList, JSON_PRETTY_PRINT));

		// done
		dump('Total removed: ' . $removedCount, $removedList, DD10);
	}

	public function actionMergeV2toV1()
	{
		$v1Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-1-origin-fixed';
		$v2Path        = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed';
		$dbFixedPath   = Yii::getPathOfAlias('webroot') . '/uploads/db-0-normalized';
		$dbErroredPath = Yii::getPathOfAlias('webroot') . '/uploads/db-0-errored';
		$scriptFile    = Yii::getPathOfAlias('webroot') . '/uploads/db-2-myname-ru-fixed-cleaned-script-file.json';
		$v1List        = $this->get_stages($v1Path);
		$v2List        = json_decode(file_get_contents($scriptFile), true);

		// process fixes v1 bugs
		foreach ($v1List as $folderID => &$v1Files) {
			foreach ($v1Files as $fileID => &$v1Stages) {
				if (in_array($fileID, [
					'femaleactor_giantholding',
					'femaleactor_giantholding_rape',
				])) {
					$this->stages_update($v1Stages, 100, max(array_keys($v1Stages)));
				}
			}
		}

		// process fixes rules merging
		foreach ($v2List as $folderID => &$v2Files) {
			foreach ($v2Files as $fileID => &$v2Stages) {
				// Process Estrus
				if (in_array($folderID, [
					'femaleactor_estrus',
					'femaleactor_estrustentacledouble',
					'femaleactor_estrustentacleside',
				])) {
					if (count($v2Stages) != 12) {
						throw new Exception('Stages not equal 12. Unexpected case! You need to check this case before merging...');
					}
					$this->stages_update($v2Stages, 0, [0,1]);        // 0
					$this->stages_update($v2Stages, 1, 2);            // 1
					$this->stages_update($v2Stages, 2, [3,4]);        // 2
					$this->stages_update($v2Stages, 3, [5,6]);        // 3
					$this->stages_update($v2Stages, 4, [7,8]);        // 4
					$this->stages_update($v2Stages, 100, [9,10,100]); // 100
					continue;
				}
				// Process anub horse missionary
				if (in_array($folderID, [
					'femaleactor_anubs_anub_horse_missionary',
				])) {
					if (count($v2Stages) != 9) {
						throw new Exception('Stages not equal 9. Unexpected case! You need to check this case before merging...');
					}
					                                             // 0
					                                             // 1
					$this->stages_update($v2Stages, 2, [2,3,4]); // 2
					$this->stages_update($v2Stages, 3, [5,6]);   // 3
					$this->stages_update($v2Stages, 4, 7);       // 4
					                                             // 100
					continue;
				}
				// Check unexpected cases
				if (count($v2Stages) > 4 && !isset($v2Stages[0])&&!isset($v2Stages[1])) {
					throw new Exception('Unexpected case!');
				}
			}
		}

		// process automatically rules merging
		foreach ($v2List as $folderID => &$v2Files) {
			foreach ($v2Files as $fileID => &$v2Stages) {
				$min                = 4;
				$max                = 5;
				$v1Stages           = null;
				if (isset($v1List[$folderID][$fileID])) {
					$v1Stages            = $v1List[$folderID][$fileID];
					$v1StagesCount       = count($v1Stages);
					$max                 = ($v1StagesCount >= $min) ? $v1StagesCount : $max;
					$v1HasFreeZeroStage  = !isset($v1Stages[0]) || !isset($v1Stages[1]);
				}
				if (!in_array(100, array_column($v2Stages, 'stage'))) {
					$max -= 1;
				}

				if ($v1Stages === null) {
					// for new unique stages from v2
					if (count($v2Stages) > $max) {
						$this->stages_reset_to_0($v2Stages);
						$max += 1;
					}

					if (count($v2Stages) > $max) {
						$this->stages_combine($max, $v2Stages);
					}

					$this->stages_align($v2Stages, null, $fileID);
				} else {
					// for stages v2 merging to v1
					if (count($v2Stages) > $max && $v1HasFreeZeroStage) {
						$this->stages_reset_to_0($v2Stages);
						$max += 1;
					}

					if (count($v2Stages) > $max) {
						$this->stages_combine($max, $v2Stages, $v1Stages);
					}

					$this->stages_align($v2Stages, $v1Stages, $fileID);
				}
			}
		}

		$mergedList = [];
		// add v1 extra stages to merged list
		// add v1 merged with v2 stages to merged list
		foreach ($v1List as $folderID => &$v1Files) {
			foreach ($v1Files as $fileID => &$v1Stages) {
				$v2Stages = null;
				if (isset($v2List[$folderID][$fileID])) {
					$v2Stages = $v2List[$folderID][$fileID];
				}
				if ($v2Stages === null) {
					$mergedList[$folderID][$fileID] = $v1Stages;
				} else {
					$v1Keys       = array_keys($v1Stages);
					$v2Keys       = array_keys($v2Stages);
					$mergedKeys   = array_intersect($v1Keys, $v2Keys);
					$v1ExtraKeys  = array_diff($v1Keys, $v2Keys);
					$v2ExtraKeys  = array_diff($v2Keys, $v1Keys);
					$mergedStages = [];
					foreach ($mergedKeys as $mergedKey) {
						$mergedStages[901] = $v1Stages[$mergedKey];
						$mergedStages[902] = $v2Stages[$mergedKey];
						$this->stages_update($mergedStages, $mergedKey, [901,902]);
					}
					foreach ($v1ExtraKeys as $v1ExtraKey) {
						$mergedStages[$v1ExtraKey] = $v1Stages[$v1ExtraKey];
					}
					foreach ($v2ExtraKeys as $v2ExtraKey) {
						$mergedStages[$v2ExtraKey] = $v2Stages[$v2ExtraKey];
					}
					ksort($mergedStages);
					$mergedList[$folderID][$fileID] = $mergedStages;
				}
			}
		}
		// add v2 extra stages to merged list
		foreach ($v2List as $folderID => &$v2Files) {
			foreach ($v2Files as $fileID => &$v2Stages) {
				if (!isset($mergedList[$folderID][$fileID])) {
					$mergedList[$folderID][$fileID] = $v2Stages;
				}
			}
		}

		// fix different folders files names
		$mergedListFixed = [];
		$foldersFilesFixed = $this->get_folders_files_fixed([$v1Path, $v2Path]);
		foreach ($mergedList as $folderID => $files) {
			foreach ($files as $fileID => $stages) {
				$mergedListFixed[$foldersFilesFixed[$folderID]['folder']][$foldersFilesFixed[$folderID]['files'][$fileID]] = $stages;
			}
		}

		// normalize folders
		if (is_dir($dbFixedPath)) {
			CFileHelper::removeDirectory($dbFixedPath);
		}
		mkdir($dbFixedPath);
		if (is_dir($dbErroredPath)) {
			CFileHelper::removeDirectory($dbErroredPath);
		}

		foreach ($mergedListFixed as $folder => $files) {
			$mergedFolderPath = $dbFixedPath . '/' . $folder;
			if (!is_dir($mergedFolderPath)) {
				mkdir($mergedFolderPath);
			}
			foreach ($files as $file => $stages) {
				foreach ($stages as $stageID => $stage) {
					$mergedFilePath = $mergedFolderPath . '/' . $file;
					if ($stage['type'] === self::TYPE_COMBINE) {
						$mergedFileJson = array_combine($this->persons, array_fill(0, count($this->persons), []));
						foreach ($stage['file'] as $_file) {
							$fileFixedJson = $this->get_file_fixed($_file['file']);
							foreach ($fileFixedJson as $person => $lines) {
								$mergedFileJson[$person] = array_merge($mergedFileJson[$person], $lines);
							}
						}
					} else {
						$mergedFileJson = $this->get_file_fixed($stage['file']);
					}

					switch ($stage['stage']) {
						case 0:
							break;
						case 100:
							$mergedFilePath .= '_Orgasm';
							break;
						default:
							if ($stage['stage'] > 6) {
								throw new Exception('Unexpected case.');
							}
							$mergedFilePath .= '_Stage' . $stage['stage'];
					}
					$mergedFilePath .= '.txt';

					if (file_put_contents($mergedFilePath, json_encode($mergedFileJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) === false) {
						throw new Exception(strtr('Unexpected error in process of saving merged file `{file}`.', [
							'{file}' => $mergedFilePath,
						]));
					}
				}
			}
		}

		dump('DONE!');
	}

	private function get_animations_from_file($filePath)
	{
		$animationsJson = json_decode(file_get_contents($filePath), true);
		$animations     = [];
		foreach ($animationsJson as $name => $active) {
			if (!$active) {
				continue;
			}
			$animations[strtolower($name)] = $name;
		}
		return $animations;
	}
	
	private function get_animations_from_path($patches)
	{
		$foldersFilesFixed = $this->get_folders_files_fixed((array)$patches);
		$animations        = [];
		foreach ($foldersFilesFixed as $folderID => $folderOptions) {
			$_folderID = $folderID;
			$_folder   = $folderOptions['folder'];
			if (strpos($_folderID, 'femaleactor_', 0) !== false) {
				$_folderID = substr($_folderID, 12);
				$_folder   = substr($_folder, 12);
			} elseif (strpos($_folderID, 'femaleactor') !== false) {
				continue;
			} elseif (strpos($_folderID, 'maleactor_', 0) !== false) {
				$_folderID = substr($_folderID, 10);
				$_folder   = substr($_folder, 10);
			} elseif (strpos($_folderID, 'maleactor') !== false) {
				continue;
			} else {
				throw new Exception('Unexpected case.');
			}
			$animations[$_folderID] = $_folder;
		}

		return $animations;
	}
	
	private $persons = [
		'1st Person',
		'2nd Person',
		'3rd Person',
	];
	private function get_file_fixed($filePath)
	{
		$fileText = file_get_contents($filePath);
		$fileJson = json_decode($fileText, true);
		if (count(array_intersect_key($fileJson, array_flip($this->persons))) !== 3) {
			throw new Exception('Unexpected case.');
		}
		$fileJson = array_map(function($lines) {
			return array_filter($lines, function($line) {
				return !empty(trim($line));
			});
		}, $fileJson);
		// Dublicate firtst person and second person if one of it is empty for v1 and v2
		if (empty($fileJson[$this->persons[0]]) || empty($fileJson[$this->persons[1]])) {
			$_dublicatedLines            = array_merge($fileJson[$this->persons[0]], $fileJson[$this->persons[1]]);
			$fileJson[$this->persons[0]] = $_dublicatedLines;
			$fileJson[$this->persons[1]] = $_dublicatedLines;
		}

		return $fileJson;
	}

	private function stages_align(array &$v2Stages, $v1Stages = null, $fileID)
	{
		// all stages starts from 0 (not 1)
		if (!isset($v2Stages[0]) && isset($v2Stages[1])) {
			$this->stages_update($v2Stages, 0, 1);
		}

		// all stages after 0 (or 1) starts from 2
		$allowableStages = array_diff_key($v2Stages, array_flip([0,1,100]));
		if (!empty($allowableStages)) {
			$resetID = array_combine(range(2, count($allowableStages)+1), array_keys($allowableStages));
			foreach ($resetID as $_resetID => $_stageID) {
				$this->stages_update($v2Stages, $_resetID, $_stageID);
			}
		}
		if ($v1Stages === null) {
			return $v2Stages;
		}

		// all stages identical
		$keys1 = array_keys($v2Stages);
		$keys2 = array_keys($v1Stages);
		if ($keys1 === $keys2) {
			return $v2Stages;
		}

		// all stages v1 identical to v2 (v2 has extra stages)
		// or
		// all stages v1 identical to v2 (v1 has extra stages)
		$v1ExtraStages = array_diff_key($v1Stages, $v2Stages);
		$v2ExtraStages = array_diff_key($v2Stages, $v1Stages);
		if (empty($v1ExtraStages) || empty($v2ExtraStages)) {
			return $v2Stages;
		}

		if (count($v1ExtraStages) === count($v2ExtraStages) &&
			isset($v2ExtraStages[1])
		) {
			$v1AllowableStages = array_diff_key($v1Stages, array_flip([0,100]));
			$v2AllowableStages = array_diff_key($v2Stages, array_flip([0,100]));
			$updateID          = array_combine(array_keys($v2AllowableStages), array_keys($v1AllowableStages));
			$_v2Stages         = [];
			foreach ($v2Stages as $stageID => $v2Stage) {
				if (isset($updateID[$stageID])) {
					$stageID          = $updateID[$stageID];
					$v2Stage['stage'] = $stageID;
				}
				$_v2Stages[$stageID] = $v2Stage;
			}
			return $v2Stages = $_v2Stages;
		}

		throw new Exception('Unexpected case.');
	}

	/**
	 * Updates stage number or updates stage to new combined list
	 * $key1 - new number
	 * $key2 - old number(s)
	 *   - (int)   - means just update stage number
	 *   - (array) - means create combine array from list of keys
	 */
	private function stages_update(array &$stages, $key1, $key2)
	{
		if (is_array($key2)) {
			$_stages = [];
			foreach ($key2 as $key) {
				if ($stages[$key]['type'] === self::TYPE_COMBINE) {
					foreach ($stages[$key]['file'] as $_stage) {
						$_stages []= $_stage;
					}
				} else {
					$_stages []= $stages[$key];
				}
				unset($stages[$key]);
			}
			$stages[$key1] = [
				'type'   => self::TYPE_COMBINE,
				'stage'  => $key1,
				'length' => array_sum(array_column($_stages, 'length')),
				'file'   => $_stages,
			];
		} elseif (is_int($key2)) {
			if ($key1 === $key2) {
				return $stages;
			} elseif (isset($stages[$key1])) {
				throw new Exception('Error case. The new key already exists!');
			}
			$stages[$key1]          = $stages[$key2];
			$stages[$key1]['stage'] = $key1;
			unset($stages[$key2]);
		} else {
			throw new Exception('Invalid key2 parameter. Can be int or array.');
		}
		ksort($stages);
		return $stages;
	}

	private function stages_combine($count, array &$stages, $v1Stages = null)
	{
		if (count($stages) <= $count) {
			return $stages;
		}

		$allowableStages = array_diff_key($stages, array_flip([0,1,100]));
		$resetID         = array_combine(range(0, count($allowableStages)-1), array_keys($allowableStages));
		$diffCount       = count($stages) - $count;

		$this->stages_update($stages, $resetID[0], [$resetID[0],$resetID[1]]);
		if ($diffCount === 1) {
			return $stages;
		}

		$this->stages_update($stages, $resetID[2], [$resetID[2],$resetID[3]]);
		if ($diffCount === 2) {
			return $stages;
		}

		throw new Exception('Unexpected case. Too many stages.');
	}

	/**
	 * Resets one stage to first stage
	 * If first 2 stages are:
	 *   - 3 4                    // any exists - Unexpected error
	 *   - 0 1 -> 0[old0] 1[old1] // all exists - do nothing
	 *   - 0 3 -> 0[old0] 1[old3] // 0 exists   - reset to 1 first stage
	 *   - 1 3 -> 0[old1] 1[old3] // 1 exists   - move 1 to 0, reset to 1 first stage
	 */
	private function stages_reset_to_0(array &$stages)
	{
		if (!isset($stages[0]) &&
			!isset($stages[1])
		) {
			throw new Exception('Unexpected case!');
		}
		if (!isset($stages[0]) ||
			!isset($stages[1])
		) {
			if (isset($stages[1])) {
				$this->stages_update($stages, 0, 1);
			}
			foreach ($stages as $stageID => $stage) {
				if ($stageID > 1) {
					$this->stages_update($stages, !isset($stages[0]) ? 0 : 1, $stageID);
					break;
				}
			}
		}
		return $stages;
	}

	private function stages_fix_ids(array $stages)
	{
		$_stages = [];
		foreach ($stages as $key => $stage) {
			// is stage
			if (isset($stage['stage'])) {
				if (isset($_stages[$stage['stage']])) {
					throw new Exception('UNEXPECTED CASE 1! THE KEY WILL BE LOSTED!');
				}
				$_stages[$stage['stage']] = $stage;
			// is array
			} else {
				if (isset($_stages[$key])) {
					throw new Exception('UNEXPECTED CASE 2! THE KEY WILL BE LOSTED!');
				}
				$_stages[$key] = $this->stages_fix_ids($stage);
			}
		}
		if (!empty($_stages)) {
			return $_stages;
		} else {
			return $stages;
		}
	}

	private function calculateFilesLength($files, $debugMaxLength = null, $debugMinLength = null)
	{
		$fileLength = 0;
		$_debugData = [];
		foreach ((array)$files as $file) {
			$fileData = json_decode(file_get_contents($file), true);
			$fileLength += $length = mb_strlen(str_replace([
				' ',
			], '', $this->implode_recursive('', $fileData)));
			$_debugData []= [
				$file,
				$length,
				$fileData,
			];
		}

		if (($debugMaxLength !== null && $fileLength <= $debugMaxLength) &&
			($debugMinLength === null || $fileLength >= $debugMinLength)
		) {
			dumpp(strtr('Files total debug length is {length} symbols!', [
				'{length}' => $fileLength,
			]), $_debugData, DD10);
		}

		return $fileLength;
	}

	private function implode_recursive($glue, $pieces)
	{
		$string = '';
		foreach ($pieces as $piece) {
			if (is_array($piece)) {
				$string .= $this->implode_recursive($glue, $piece) . $glue;
			} else {
				$string .= $piece . $glue;
			}
		}

		return $string;
	}

	private function removeIdenticalText(&$stages, $key1, $key2, $comparingPercentMin=80)
	{
		$text1 = file_get_contents($stages[$key1]['file']);
		$text2 = file_get_contents($stages[$key2]['file']);
		similar_text($text1, $text2, $percentage);
		$percentage = round($percentage);

		if ($percentage >= $comparingPercentMin) {
			$unsetKey = $key1;
			if ($percentage != 100) {
				$json = json_decode($text1, true);
				foreach ($json['3rd Person'] as $line) {
					if (strpos($line, '{PRIMARY}') !== false ||
						strpos($line, '{ACTIVE}') !== false
					) {
						$unsetKey = $key2;
						break;
					}
				}
			}
			unset($stages[$unsetKey]);
			$stages = array_values($stages);

			return $unsetKey;
		}

		return false;
	}

	private function array_intersect_key_recursive (array $array1, array $array2)
	{
	    $array1 = array_intersect_key($array1, $array2);
	    foreach ($array1 as $key => &$value) {
	        if (is_array($value) && is_array($array2[$key])) {
	            $value = $this->array_intersect_key_recursive($value, $array2[$key]);
	        }
	    }
	    return $array1;
	}

	private function get_stages($path, $excludeFolders = [
		'bdsm',
	])
	{
		// get list of stages
		$results = [];
		$folders = scandir($path);
		foreach ($folders as $folder) {
			$folderPath = $path . '/' . $folder;
			if ($folder === '.' ||
				$folder === '..' ||
				!is_dir($folderPath) ||
				in_array($folder, $excludeFolders)
			) {
				continue;
			}

			$files = scandir($folderPath);
			foreach ($files as $file) {
				$filePath = $folderPath . '/' . $file;
				if ($file === '.' ||
					$file === '..'
				) {
					continue;
				}

				// skip all empty files
				$fileLength = $this->calculateFilesLength($filePath);
				if (!$fileLength) {
					continue;
				}

				$_folder = strtolower($folder);
				$_file   = strtolower(basename($file, '.txt'));
				$type    = self::TYPE_BEGIN;
				$stage   = 0;
				if (($pos=strpos($_file, 'stage')) !== false) {
					$type  = self::TYPE_STAGE;
					$stage = (int)substr($_file, $pos+5);
					$_file = substr($_file, 0, $pos-1);
				}
				if (($pos=strpos($_file, 'orgasm')) !== false) {
					$type  = self::TYPE_ORGASM;
					$stage = '^O^'; // just magick smile
					$_file = substr($_file, 0, $pos-1);
				}
				$results[$_folder][$_file][$stage] = [
					'type'   => $type,
					'stage'  => $stage,
					'length' => $fileLength,
					'file'   => $filePath,
				];
			}
		}

		// sort and reset stages
		// normalize magick smiles (orgasm stage)
		foreach ($results as $folder => &$files) {
			foreach ($files as $file => &$stages) {
				if (isset($stages['^O^'])) {
					$stageOrgasm = $stages['^O^'];
					unset($stages['^O^']);
					$stages[100] = array_merge($stageOrgasm, [
						'stage' => 100,
					]);
				}
				ksort($stages);
			}
		}

		return $results;
	}

	private function get_folders_files($path, $excludeFolders = [
		'bdsm',
	])
	{
		// get list of stages
		$results = [];
		$folders = scandir($path);
		foreach ($folders as $folder) {
			$folderPath = $path . '/' . $folder;
			if ($folder === '.' ||
				$folder === '..' ||
				!is_dir($folderPath) ||
				in_array($folder, $excludeFolders)
			) {
				continue;
			}

			$files = scandir($folderPath);
			foreach ($files as $file) {
				$filePath = $folderPath . '/' . $file;
				if ($file === '.' ||
					$file === '..'
				) {
					continue;
				}

				$_folder  = $folder;
				$_file    = basename($file, '.txt');
				$__folder = strtolower($_folder);
				$__file   = strtolower($_file);
				if (($pos=strpos($__file, 'stage')) !== false) {
					$_file  = substr($_file, 0, $pos-1);
					$__file = strtolower($_file);
				}
				if (($pos=strpos($__file, 'orgasm')) !== false) {
					$_file  = substr($_file, 0, $pos-1);
					$__file = strtolower($_file);
				}

				if (!isset($results[$__folder])) {
					$results[$__folder] = [
						'folder' => [$_folder],
						'files'  => [],
					];
				}
				if (!isset($results[$__folder]['files'][$__file])) {
					$results[$__folder]['files'][$__file] = [];
				}
				$results[$__folder]['files'][$__file] []= $_file;
			}
		}

		return $results;
	}

	private function get_folders_files_fixed(array $pathes, $excludeFolders = [
		'bdsm',
	])
	{
		$foldersFilesMerged = [];
		foreach ($pathes as $path) {
			$foldersFiles = $this->get_folders_files($path);
			foreach ($foldersFiles as $folderID => $folderOptions) {
				if (!isset($foldersFilesMerged[$folderID])) {
					$foldersFilesMerged[$folderID] = [
						'folder' => [],
						'files'  => [],
					];
				}
				$foldersFilesMerged[$folderID]['folder'] = array_unique(array_merge(
					$foldersFilesMerged[$folderID]['folder'],
					$folderOptions['folder']
				));
				foreach ($folderOptions['files'] as $fileID => $files) {
					if (!isset($foldersFilesMerged[$folderID]['files'][$fileID])) {
						$foldersFilesMerged[$folderID]['files'][$fileID] = [];
					}
					$foldersFilesMerged[$folderID]['files'][$fileID] = array_unique(array_merge(
						$foldersFilesMerged[$folderID]['files'][$fileID],
						$files
					));
				}
			}
		}

		foreach ($foldersFilesMerged as $folderID => &$folderOptions) {
			if (count($folderOptions['folder']) > 1) {
				$folderOptions['folder'] = $this->get_preferable_name($folderOptions['folder']);
			} else {
				$folderOptions['folder'] = current($folderOptions['folder']);
			}
			foreach ($folderOptions['files'] as $fileID => &$files) {
				if (count($files) > 1) {
					$files = $this->get_preferable_name($files);
				} else {
					$files = current($files);
				}
			}
		}

		return $foldersFilesMerged;
	}

	private function get_preferable_name(array $names)
	{
		$_names = [];
		foreach ($names as $name) {
			$upperLength = 0;
			foreach (str_split($name) as $chr) {
				if (strtolower($chr) === $chr) {
					continue;
				}
				$upperLength += 1;
			}
			if (isset($_names[$upperLength])) {
				throw new Exception('Unexpected case.');
			}
			$_names[$upperLength] = $name;
		}

		return $_names[max(array_keys($_names))];
	}

	/**
	 * 188.133.173.20:8080
	 * 188.165.16.230:3129
	 * ssl://200.73.129.61:80
	 * http://95.217.120.170:8888
	 */
	public function actionGenerateProxyList($f, $t)
	{
		// normalize list of proxy ip
		$_csvData  = array_map('str_getcsv', file(Yii::getPathOfAlias('webroot').'/hideme_proxy_export.csv')); 
		$proxyList = [];
		foreach ($_csvData as $key => $_csvLines) {
			$_csvText = '';
			foreach ($_csvLines as $_csvLine) {
				$_csvText .= $_csvLine;
			}
			$_csvRows = array_map(function($_csvRow) {
				return trim($_csvRow);
			}, explode(';', $_csvText));
			if (!$key) {
				$_csvTitles = $_csvRows;
			} else {
				$proxyList[$_csvRows[0].':'.$_csvRows[2]] = array_combine($_csvTitles, $_csvRows);
			}
		}
		$proxyList = array_filter($proxyList, function($proxyData) {
			return $proxyData['country_code'] != 'UA';
		});

		usort($proxyList, function($a, $b) {
			if ($a['delay'] == $b['delay']) {
				return 0;
			}
			return ($a['delay'] < $b['delay']) ? -1 : 1;
		});
		$proxyList = array_values($proxyList);

		$proxyPath = Yii::getPathOfAlias('webroot') . '/test-proxy';
		if (!is_dir($proxyPath)) {
			mkdir($proxyPath);
		}

		// return first valid ip
		$results  = [];
		$sum_time = 0;
		foreach ($proxyList as $attempt => $proxyData) {
			if ($attempt <= $f || $attempt > $t) {
				continue;
			}
			
			foreach (['http', 'ssl', 'socks4', 'socks5'] as $_protocol) {
				if ($proxyData[$_protocol]) {
					$protocol = $_protocol;
				}
			}
			$test_proxy_ip = strtr('{protocol}://{ip}:{port}', [
				'{protocol}' => $protocol,
				'{ip}'       => $proxyData['host'],
				'{port}'     => $proxyData['port'],
			]);
			$test          = $this->test_proxy_ip($test_proxy_ip);

			$sum_time += $test[3];
			$log = ($test[0] ? ' +++' : ' ---') . ' (' . $attempt . ') ' . $test_proxy_ip . ' | ' . $test[1] . ' | ' . $test[2] . ' | ' . $test[3] . ' [' . $sum_time . 'sec];' . PHP_EOL;
			file_put_contents($proxyPath . '/log.txt', $log, FILE_APPEND);
		}

		return $results;
	}

	private function test_proxy_ip($proxy, $options = [
		'url'         => 'http://speller.yandex.net/services/spellservice.json/checkText',
		'timeout'     => 5,
		'maxAttempts' => 5,
	]) {
		$all_time = 0;
		for ($attempt = 1; $attempt<$options['maxAttempts']; $attempt++) {
			$ch = curl_init();
			curl_setopt_array($ch, [
				CURLOPT_URL            => $options['url'],
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_PROXY          => $proxy,
				CURLOPT_CONNECTTIMEOUT => $options['timeout'],
				CURLOPT_TIMEOUT        => $options['timeout'],
			]);
			$response = curl_exec($ch);
			extract(curl_getinfo($ch));
			$all_time += $total_time;
			if ($response &&
				$http_code == '200' &&
				mb_strpos($response, 'Доступ на цей ресурс заблоковано') === false
			) {
				return [true, $attempt, $total_time, $all_time];
			}
		}

		return [false, $attempt, $total_time, $all_time];
	}

	private function checkYandexSpelling($text, $timeout = 3, $attempts = 3)
	{
		$proxyList = [
			'http://95.217.120.170:8888' => 0.11879,
			'http://46.20.74.109:3128' => 9.408808,
			'http://37.120.168.223:8888' => 1.289359,
			'http://173.212.202.65:80' => 0.323347,
			'http://51.89.32.83:3128' => 0.287213,
			'http://158.101.198.195:3128' => 8.34451,
			'http://145.239.121.218:3129' => 1.405205,
			'http://109.196.127.35:8888' => 9.005674,
			'http://5.189.133.231:80' => 0.232951,
			'ssl://54.38.219.100:6582' => 14.138614,
			'ssl://51.77.35.134:3128' => 11.134359,
			'http://51.68.71.95:3128' => 0.377895,
		];
		uasort($proxyList, function($a, $b) {
			if ($a == $b) {
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});
		$proxyList = array_keys($proxyList);

		static $speller;
		if ($speller === null) {
			$speller = new SpellerClient();
		}
		foreach ($proxyList as $proxyAttempt => $proxy) {
			$speller->setProxy($proxy);
			for ($attempt=1; $attempt<=$attempts; $attempt++) {
				try {
					return $speller->checkText($text, [], [
						'timeout' => $timeout,
					]);
				} catch (Exception $e) {}
			}
		}

		throw new Exception('The proxy list already is not valid :(');
	}
}
