<?php
require_once "autoloader.php";
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
class SMS
{

	protected $config;
	protected $apiClient;
	protected $messageclient;

	public function __construct()
	{
		$this->config = Configuration::getDefaultConfiguration();
		$this->config->setApiKey("Authorization",'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0ODkzNDU0MSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY3NTAyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.IHX4JF0M73tM3utT_T2H5angLdVyWkm_IZt9PdJ2--M');
		$this->apiClient = new ApiClient($this->config);
		$this->messageclient = new MessageApi($this->apiClient);
	}


	public function sendSMS(array $details)
	{
		extract($details);
		$sendSMS = new SendMessageRequest([
			'phoneNumber'=>$number,
			'message'=>$message,
			'deviceId'=>108945
		]);

		$sendNow = $this->messageclient->sendMessages([
			$sendSMS
		]);
		if($sendNow)
		{
			return true;
			
		} else {
			return false;
		}
	}

}