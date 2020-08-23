<?php
/**
	 * 188.133.173.20:8080
	 * 188.165.16.230:3129
	 * 
	 * 1.255.48.197:8080
	 * 169.57.1.84:25
	 * 119.81.71.27:25
	 * 169.57.1.84:8123
	 * 159.8.114.37:25
	 * 185.107.80.227:5836
	 * 54.38.218.210:6582
	 * 124.107.185.3:8080
	 * 169.57.1.85:8123
	 * 169.57.1.84:80
	 * 169.57.1.85:25
	 * 173.192.128.238:25
	 * 119.81.71.27:8123
	 * 173.192.128.238:9999
	 * 119.81.71.27:80
	 */
class SiteController extends Controller
{
	/**
	 * https://deepumi.wordpress.com/2010/05/20/google-spell-checker-api-asp-net-c/
	 */
	public function actionTestXml()
	{
	
		//Store your XML Request in a variable
		$input_xml = '<?xml version=”1.0” encoding=”utf-8” ?>
<spellrequest textalreadyclipped=”0” ignoredups=”0” ignoredigits=”1” ignoreallcaps=”1“>
<text>Hotal</text>
</spellrequest>';

    $url = "https://www.google.com/tbproxy/spell?lang=en";

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		// Following line is compulsary to add as it is:
		curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "xmlRequest=" . $input_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        //convert the XML result into array
//        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);

		dump($data);
	}
	
	/**
	 * 1.1.1.112:80
	 * 103.216.82.22:6667
	 * 174.76.48.252	4145
	 */
	public function actionTestCurl()
	{
		$url = 'http://speller.yandex.net/services/spellservice.json/checkText';
//		$url = 'http://kharkovforum.com';

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_PROXY          => '188.165.16.230:3129',
			CURLOPT_TIMEOUT        => 3,
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

	/**
	 * http://www.breadsalt.ru
	 * 159.89.49.60:31264
	 */
	public function actionTestProxy()
	{
//		$client = new Client([
//			'base_uri' => 'http://www.google.com/finance?q=EURUSD',
//			'proxy'    => '1.1.1.112:80',
//			'headers' => [
//				'User-Agent'      => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2) Gecko/20100115 Firefox/3.6',
//				'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
//				'Accept-Language' => 'ru,en-us;q=0.7,en;q=0.3',
//				'Accept-Encoding' => 'deflate',
//				'Accept-Charset'  => 'windows-1251;q=0.7,*;q=0.7',
//			],
//        ]);
////		try {
//			$rs = $client->request('GET');
////		} catch (Exception $e) {
//////			dump($client, DD10);
////		}
//
//		dump($rs);
		
		
		$headers = array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2) Gecko/20100115 Firefox/3.6',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
'Accept-Encoding: deflate',
'Accept-Charset: windows-1251;q=0.7,*;q=0.7');
		$url = 'http://www.breadsalt.ru';
		$proxy = '1.1.1.112:80';
		$c = curl_init($url);

		curl_setopt($c, CURLOPT_PROXY, $proxy);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($c, CURLOPT_MAXREDIRS, 2);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers); // Передаем массив с HTTP-заголовками.
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); // Это для того, что бы cURL возвращал текст сраницы, а не выводил его на экран.
		curl_setopt($c, CURLOPT_TIMEOUT, 30); //The maximum number of seconds to allow cURL functions to execute.
		curl_setopt($c, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
		curl_setopt($c, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
		$page = curl_exec($c); // Запускаем сам процесс и записываем скачанную страницу в $page;
		curl_close($c); // Освобождаем задействованные ресурсы, т.к. мы все сделали, cURL нам больше не нужен.
		dump($page);
		
		
		$headers = array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2) Gecko/20100115 Firefox/3.6',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
'Accept-Encoding: deflate',
'Accept-Charset: windows-1251;q=0.7,*;q=0.7');
		$url = 'http://www.google.com/finance?q=EURUSD';
		$proxy = '1.1.1.112:80';
		$c = curl_init($url);

		curl_setopt($c, CURLOPT_PROXY, $proxy);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers); // Передаем массив с HTTP-заголовками.
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); // Это для того, что бы cURL возвращал текст сраницы, а не выводил его на экран.
		$page = curl_exec($c); // Запускаем сам процесс и записываем скачанную страницу в $page;
		curl_close($c); // Освобождаем задействованные ресурсы, т.к. мы все сделали, cURL нам больше не нужен.
		dump($page);
		
		$client = new Client([
			'base_uri'        => 'http://google.com',
			'timeout'         => 30,
			'proxy'           => '1.1.1.112:80',
        ]);

		dump($client->request('GET'));
		
		
		//curl_setopt($ch, CURLOPT_HEADER, 1); // return with headers
		//curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password');
	}

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
		$pspell_link = pspell_new('ru_RU', null, null, 'utf-8');

		$word = 'приветт';
		if (!pspell_check($pspell_link, $word)) {
			$suggestions = pspell_suggest($pspell_link, $word);
			dump($suggestions);
		}
		dump('CORRECT');
		
		$pspell_link = pspell_config_create('ru');
		dump($this->orthograph('привет'));
		
		$tag    = 'ru_RU';
		$broker = enchant_broker_init();

		if (enchant_broker_dict_exists($broker, $tag)) {
			$dictionary = enchant_broker_request_dict($broker, $tag);
			$result     = enchant_dict_quick_check($dictionary, 'привет мир', $suggestions);
			dump($result, $suggestions);
		}

		dump('DONE!');
		
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }
}