<?php
use Yandex\Speller\SpellerClient;
use GuzzleHttp\Client;

class YandexSpellerClient extends SpellerClient
{
	protected $clientOptions = [];

	public function __construct(array $settings = [])
	{
		foreach ($settings as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function setClientOptions(array $clientOptions)
    {
        $this->clientOptions = $clientOptions;

        return $this;
    }

    public function getClientOptions()
    {
        return $this->clientOptions;
    }

	protected function getClient()
    {
        if (is_null($this->client)) {
            $defaultOptions = array_merge([
                'base_uri' => $this->getServiceUrl(),
                'headers' => [
                    'Authorization' => 'OAuth ' . $this->getAccessToken(),
                    'Host' => $this->getServiceDomain(),
                    'User-Agent' => $this->getUserAgent(),
                    'Accept' => '*/*'
                ],
            ], $this->getClientOptions());
            $this->client = new Client($defaultOptions);
        }

        return $this->client;
    }
}
