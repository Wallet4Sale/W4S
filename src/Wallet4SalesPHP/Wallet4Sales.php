<?php

namespace Wallet4SalesPHP;

require __DIR__ . '/../../vendor/autoload.php';

// use ZipArchive;

/**
 * Class PKPass.
 */
class Wallet4Sales
{
	/**
	 * Holds the path to the certificate
	 * Variable: string.
	 */
	protected $certPath;

	/**
	 * Name of the downloaded file.
	 */
	protected $name;

	/**
	 * Holds the files to include in the .pkpass
	 * Variable: array.
	 */
	protected $files = [];

	/**
	 * Holds the remote file urls to include in the .pkpass
	 * Variable: array.
	 */
	protected $remote_file_urls = [];

	/**
	 * Holds the json
	 * Variable: class.
	 */
	protected $json;

	/**
	 * Holds the SHAs of the $files array
	 * Variable: array.
	 */
	protected $shas;

	/**
	 * Holds the password to the certificate
	 * Variable: string.
	 */
	protected $certPass = '';

	/**
	 * Holds the path to the WWDR Intermediate certificate
	 * Variable: string.
	 */
	protected $wwdrCertPath = '';

	/**
	 * Holds the path to a temporary folder with trailing slash.
	 */
	protected $tempPath;

	/**
	 * Holds error info if an error occurred.
	 */
	private $sError = '';

	/**
	 * Holds a auto-generated uniqid to prevent overwriting other processes pass
	 * files.
	 */
	private $uniqid = null;

	/**
	 * Holds array of localization details
	 * Variable: array.
	 */
	protected $locales = [];


	private $EndPoint = 'https://www.optimacrm.ai/OptimaWalletDev';

	private $access_token;
	protected $TempPathCertificates;

	/**
	 * PKPass constructor.
	 *
	 * @param string|bool $certPath
	 * @param string|bool $certPass
	 * @param string|bool $JSON
	 */
	// function __construct($certPath = false, $certPass = false, $JSON = false){
	function __construct($access_token = false){
			// var_dump($this->access_token);
			// exit;
			// $this->tempPath = sys_get_temp_dir() . '/';  // Must end with slash!
			// $this->wwdrCertPath = __DIR__ . '/Certificate/AppleWWDRCA.pem';

			// if($certPath != false) {
			//     $this->setCertificate($certPath);
			// }
			// if($certPass != false) {
			//     $this->setCertificatePassword($certPass);
			// }
			// if($JSON != false) {
			//     $this->setData($JSON);
			// }
		if ($this->access_token != false) {
			$this->setAccesToken($access_token);
		}
	}

	private function doQueryDev($path, $data = null) {
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
			$method = 'GET';
			if($data != null) {
				$method = "POST";
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
				
				// $dataString = substr($dataString, 0, -1);
				// Set cURL post options
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($post));
			}

			// curl_setopt($curl,CURLOPT_URL, $url);
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
			
			return $response;
	}

	public function CreatePass($data) {
		return $this->doQueryDev("CreatePassDev", $data);
	}

	public function LoadCertificate($Cerb64) {
		return $this->doQueryDev("LoadCertificate", $Cerb64);
	}

	public function CreateCSR() {
		return $this->doQueryDev("CreateCSR");
	}

	public function setAccesToken($access_token){
		$this->access_token = $access_token;
	}
}