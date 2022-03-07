<?php

namespace Wallet4SalesPHP;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Class Wallet4Sales Optima
 .
*/
class Wallet4Sales
{

	private $EndPoint = 'https://w4s.ai/wallet4sales/apiwallet4sales/';

	private $access_token;

	/**
	 * W4S constructor.
	 */
	function __construct($access_token = false){
		if ($this->access_token != false) {
			$this->setAccesToken($access_token);
		}
	}

	private function doQueryDev($path, $data = null, $Method = 'GET') {
		// Prepare URL
		$path = str_replace(" ", "%20", $path);
		$url = $this->EndPoint. '/' . $path;
		$headers = array(
			"Content-Type: application/json",
			"Authorization: Bearer $this->access_token"
		);

		// initiate curl
		$ch = curl_init($url);
	
		$dataString = '';
		if($data != null) {
			$Method = "POST";
			uksort($data, 'strcmp');
			$post = array();
			
			// Loop through every data entry - only do this for non image method
			foreach($data as $key => $value) {
				// if (strpos($value, '@') === 0 ) {
				// 	$value = "\0".$value;
				// }
				$post[$key] = $value;
				// $dataString .= rawurlencode($key) . '=' . rawurlencode($value) . "&";
			}
			
			// var_dump(json_encode($post));
			// $dataString = substr($dataString, 0, -1);
			// Set cURL post options
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $Method);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($post));
		}
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_ENCODING, '');
		curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch,CURLOPT_TIMEOUT, 0);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);
		#descomentar esto cuando todas las respuestas del servidos sean un json al final
		// $result = ($response ? json_decode($response, true) : false);
		// array_unique($result);
		// var_dump($response);
		
		return $response;
	}

	public function setAccesToken($access_token) {
		$this->access_token = $access_token;
	}

	public function CreatePass($ActivityID, $data = null, $Method = 'POST') {
		return $this->doQueryDev("{$ActivityID}/Pass/New", $data, $Method);
	}

	public function UpdatePass($ActivityID, $data) {
		return $this->doQueryDev("{$ActivityID}/Pass/Update", $data);
	}

	public function LoadCertificate($Cerb64) {
		return $this->doQueryDev("LoadCertificate", $Cerb64);
	}

	public function CreateCSR() {
		return $this->doQueryDev("CreateCSR");
	}

	public function CreateTemplate($data) {
		return $this->doQueryDev("Template/New", $data);
	}

	public function CreateCampaign($data) {
		return $this->doQueryDev("Campaign/New", $data);
	}

	public function UploadImage($ImageType,$data){
		return $this->doQueryDev("{$ImageType}/UploadImg", $data);
	}

	public function GetKeysCard($CardCode){
		return $this->doQueryDev("GetKeysCard/{$CardCode}");
	}
}