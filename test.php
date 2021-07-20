<?php 

require 'vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$json['authenticationToken'] = 'AUTH_TOKEN';
$json['backgroundColor']    = 'rgb(255,255,255)';
$json['barcode'] = array("format" => "PKBarcodeFormatQR", "message" => "https://www.optimacrm.ai/Asistencia1/II3FZK/15302069", "messageEncoding" => "UTF-8", "altText" => "");

$json['coupon']['headerFields'] = [
	array("key" => "h1", "label" => "Fecha Cita", "value" => "06/05/2021 08:25")
];

$json['coupon']['auxiliaryFields'] = [
	array("key" => "a1", "label" => "Concesionario", "value" => "MAZDA GRUPO MARCOS")
];

$json['coupon']['backFields'] = [
	array("key" => "b1", "label" => "Nombre Cliente", "value" => "Gean Pearre"),
	array("key" => "b2", "label" => "Concesionario", "value" => "MAZDA GRUPO MARCOS"),
	array("key" => "b3", "label" => "Dirección", "value" => "Carr. d Ocaña, 25 03007 (ALICANTE) ALICANTE"),
	array("key" => "b4", "label" => "Marca(s)", "value" => "Mazda"),
	array("key" => "b5", "label" => "Teléfono del Evento", "value" => " "),
	array("key" => "b6", "label" => "Fecha de Emisión", "value" => date("Y/m/d H:i:s")),
	array("key" => "b7", "label" => "Fecha de Validez", "value" => "Este pase es válido sólo el día 06/05/2021 08:25"),
	array("key" => "b8", "label" => "Condiciones", "value" => "Sigue nuestras políticas desde el siguiente link:\nhttps://www.specialdays.es/PoliticaDePrivacidadInfoWallet/MazdaGrupoMarcos"),
	array("key" => "b9", "label" => "Actualización", "value" => " ", "changeMessage" => "%@")
];

$json['description']        = 'Pase exclusivo para los eventos de Special Days';
$json['foregroundColor']    = 'rgb(0, 0, 0)';
$json['labelColor']         = 'rgb(0, 0, 0)';
$json['maxDistance']        = 500;
$json['suppressStripShine'] = true;
$json['formatVersion']      = 1;
$json['locations'] 					= [
	array("latitude" => 40.0574881, "longitude" => 0.0847931, "relevantText" => "Lugar de Preferecia 1")
];
$json['organizationName']   = 'Special Days';
$json['passTypeIdentifier'] = 'pass.com.optimawallet.crm';
$json['serialNumber']       = "SERIAL_NUMBER"; #'123458'; # el id no puede ser muy extenso
$json['teamIdentifier']     = 'FWUBB34JGY';
$json['webServiceURL'] 			= 'https://www.optimacrm.ai/WebHooks';

// $json = array("Nombre"=>"Gean");
$access_token = 'Hola Mundo';

$cer = 'OptimaPassDev.cer';
$string = 'MIIF8DCCBNigAwIBAgIIQhyY8UtSqscwDQYJKoZIhvcNAQEFBQAwgZYxCzAJBgNVBAYTAlVTMRMwEQYDVQQKDApBcHBsZSBJbmMuMSwwKgYDVQQLDCNBcHBsZSBXb3JsZHdpZGUgRGV2ZW';


if ((bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string) === false) {
  echo "NO 1";
  exit;
}
$decoded = base64_decode($string, true);
if ($decoded === false) {
    echo "NO 2";
    exit;
}
// $encoding = mb_detect_encoding($decoded);
// var_dump($encoding);
// if (! in_array($encoding, ['UTF-8', 'ASCII'], true)) {
//     echo "NO 3";
//     exit;
// }
if ($decoded !== false && base64_encode($decoded) === $string) {
	echo "SI \n";
}else{
	echo "NO 4 \n";
}
// var_dump($decoded,base64_encode($decoded));
// exit;


// var_dump(base64_decode($string,true));
exit;
if (!base64_decode($string,true)) {
	echo "es un base 64";
}else{
	echo "no es un base 64";
}
exit;
$jsonCer = array("certificate"=>base64_encode(file_get_contents($cer)));
var_dump($jsonCer);
exit;

// $w4s = new Wallet4Sales();
// $w4s->setAccesToken($access_token);
// $retorno = $w4s->LoadCertificate($jsonCer);

// $certif = openssl_x509_read( file_get_contents($cer));

$key = openssl_pkey_get_private('-----BEGIN ENCRYPTED PRIVATE KEY-----
MIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQILAF2B8wyb/YCAggA
MAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECIGmIJEI1S3gBIIEyG573mNrtVRv
XiVzGR0DGsAKKpFUnxcm46fbEbNWSMuFQfCIuGpFqEsVkXPGmr2CqLiEDH16ed3K
oggRY6rTE1NcifvWz9BQz/tuqP5vDZ4YyDnhUJ1wUcwiDlbNlNdK4Ho2QST2CxGo
yFclwUXwjBpg02f4WnqicEU+onkfWlGVC8QdsnwvNerFp2yjpqc+v+dfbhcTj/n4
aluASgtEqbebtRO37UVeNT/SGvSBJte4/agb1BZGhM5uAuAdPP/LDb/zR279H/i1
MsZbrxlJGME7jHCSwzrnM6BBRW1H0N+AHCFQq3pjdSWo3unSnAyf3m0VPou+Ei6E
djvkDXKR1HZxqUxAHwTylIBqC3nLKaSvTebFTUCTbcxPKAAZoryPVRNse60ck1Oi
VMMotQax1l89bP/pipjfcV5edaHcua9yefT8GqnheDB3fO72v6d5Y4f/NrUIfmDX
LCEkEuXTo4AsVA/ZkQrS4igJ8XxXAVB4w0v+l2P8gcpqQc7LgFX2gIFV91KLYosb
fWPERE5P6L70/jiJiNS1ZMcJmyd1rKzVLFH8MG09VoDnnFSoAWoJqSZ8kmw4Tve7
0QkDgAhxMk5y8KvYvTNZdetRSHP+ZO4ZHWP7kVsnyMU6o78ggxTZ7UCqhgnq1jLw
fCYV+fdpQJ1aQVE8Jk5PAPbaAeqC3luan8uh4eK54xtlVZyCY0lgzgnzWzU1G4Vh
icGzA8Rpj0FfSuil4foPaKRqp1iqBxc5gO/hzBpp5vvIfa2/FUtnkE+5NfgxuLXq
KUUDPNRAhG22L+N8470MuOz8RH8+IQhWzPG++Ni/X7yFQZXSTYeRN/V56kymkZrh
ZaaVwtWmfAoYIq8BMgQocpUaIZgqJfECsByjw6INDuKwsZuvDiCmP9MftesaA0r0
qfrNWUwIm0XVRQMn9PyOkMKdaJ9TZp+gxlxJFVyYFdPty7y0ihVYSEf2ALGvhWKI
PXtm/tY4f3+LCBNH5PwTU119qnuJWQ19DRNGHim+Nhlhu1axav82BFsZGG5BYAEE
bn539srEhbv5+AHPncaEcDgX3JPQ3nsJl578BAfsPzfCMkqMZEvxab4PuaWdWQEw
jx412tRGhdANzT6LD8Ptn83wf6qwF/DsLANK8NtXAiONXz92ocFcXgIyWsx23XU4
67qGnl2To14ty5o2Q6OrcHdPUFe4zDdI1QfdJ3iqxL/3M3p8lhL9TFrxVGqBGoki
VSC7lh7dJAIk9zgRznCSrK49ZyLsJSRIL2+IMzVb3dkq7rsEBg2U/AJEHrwrAxQK
Fx3pLrpVA8JGUh8lfYr9PM6uN54OPr5cUXNh2Q4Hs9zokUYPKJrXE4rF+oMaMnLX
kkv0eZDpnNoI0MMeMqohe2ic+iqt9/oUTiPK5ihwh1bXOfUBWJPNcCQNze2cGm35
IFcqAYvKM5XmOeYjfOa35tVp5njr7gmrsWdmFEknFVu0dauhMMub4kW7e/awsaSq
gnq/D0bSinSpo3yBOyk8XbzXfkIzJTcwC59xkBe7p8Cj/L/32Sq/kKQq8XuCnIj+
SjaoORpW/noFeFV2w5GEVrlPX2Q/S2591IRWNslSb6+d/n5BCBTqiCtM1pJ/Yb0W
LcOKP4pKSsww4vu0tQlbYA==
-----END ENCRYPTED PRIVATE KEY-----
',"PrivateKey");

$cer = '-----BEGIN CERTIFICATE REQUEST-----
MIIC2TCCAcECAQAwgZMxCzAJBgNVBAYTAkVTMQ8wDQYDVQQIDAZNYWRyaWQxDzAN
BgNVBAcMBk1hZHJpZDEhMB8GA1UECgwYT3B0aW1hIE1hcmtldGluZyBTeXN0ZW1z
MRswGQYDVQQDDBJPcHRpbWEgQ2xpZW50IE4gMTIxIjAgBgkqhkiG9w0BCQEWE2hv
bGFAc3BlY2lhbGRheXMuZXMwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIB
AQDBSb8qpw79TCf/xrvcXADPHIPMWLU34j8OIEenomUCPO9X0+ToMKU8bU9ro0aO
JeIfzLKgjkoHRFdBDm0glgU8Pj+O1f6JOmIvWonHGZgFNhfo2mNMcmED2z14Vcli
573OHQvmyoJVFjeD5dYGLq6zTrEAigaBfiGSaKScW5ZCvYcTUvo+lzRRbsjbWStF
2V5ht0HNA0p1tKn5Lz/u5AoHY8eBuAEPGNAjSoES8i6qV5tkFJ2JXszdfP86bXpV
Q12bYLzQI2IN9MJe3AAQS4aDZYTEnQAslf67drQIzEuxbhLAhJ1uM+sh37zrsjXL
SckxPuQDTNjyThMDnoI4P5S9AgMBAAGgADANBgkqhkiG9w0BAQUFAAOCAQEAEc3C
Fc26gDHESuwzasGvNTXybghsufl9ly7CBmnp006IbQlBIuDkZPQdSrviJ19YdBCP
g8jQq0ktsXvRPrs3CLrfS0CbrK9Geq1Mxw/JiCLtXurCJp6D50ySuHa07YsyHx1Q
YWBKaZP6mPq+jbC5xW67Y7JPWxY8zTgXODwmp/875Mcnfk9/5dotBRc9r7IZefSz
08pg37X7VgSoc6sgDuAyyRj5OwdkEf5vCWty1JftLv8m91UBVhkTEKM6gz7BoqBn
e40So7gML/njl53a2npe4DmQa9t7W7YUf7RiHec9dHyoZvGxHhGk3dNY/hEgzYms
amg9CTq6/de4nicktw==
-----END CERTIFICATE REQUEST-----';

// var_dump($out);
// exit;

$sscert = openssl_csr_sign($cer, null, $key, 365);
openssl_pkcs12_export($sscert,$pkcs,$key,'OptimaWallet',[]);
file_put_contents("Wallet.p12", $pkcs);
var_dump($sscert,$pkcs);

exit;
// $w4s->setAccesToken($access_token);
$w4s->setTempPathCertificates(__DIR__.'/Certificates');

$pem = $w4s->convertCERtoPEM('DeveloperCertificateApple.cer');

// $p12 = $w4s->convertPEMtoP12('DeveloperCertificateApple.cer');
$Content = $w4s->GetContenttoPEM($pem);
// var_dump('AQUI',$Content);
exit;


// $certificateCAcer = 'DeveloperCertificateApple.cer';

// $certificateCAcerContent = file_get_contents($certificateCAcer);

// /* Convert .cer to .pem, cURL uses .pem */
// $certificateCApemContent =  '-----BEGIN CERTIFICATE-----'.PHP_EOL
//     .chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL)
//     .'-----END CERTIFICATE-----'.PHP_EOL;

// $certificateCApem = $certificateCAcer.'.pem';

// file_put_contents($certificateCApem, $certificateCApemContent);
// var_dump($certificateCApemContent);
// exit;


$fp = fopen(dirname(__FILE__) . "/DeveloperCertificateApple.cer.pem","r");

// $fp = fopen("DeveloperCertificateApple.cer", "r");

$cert = fread($fp, 8192);
// var_dump($cert);
// unset($cert[0]);
// var_dump('AQUI',$cert);
// exit;
fclose($fp);
openssl_x509_read( $cert);
$data = openssl_x509_parse($cert);

var_dump($data);
exit;


$CERIFICATE_P12 = base64_encode(file_get_contents('Client1.p12'));

// $CERIFICATE_P12 = file_get_contents('Client1.p12');
openssl_pkcs12_read(base64_decode($CERIFICATE_P12), $info_cert, "OptimaWallet");

$read = openssl_x509_read($info_cert['cert']);
$data = openssl_x509_parse($read);

var_dump($data);
exit;

// var_dump($CERIFICATE_P12);
// exit;

try {
	if (!base64_decode($CERIFICATE_P12, true)){
		throw new Exception('The given data was invalid.');
	}
	if (!openssl_pkcs12_read($certificateBinary = base64_decode($CERIFICATE_P12), $certificate, 'OptimaWallet')) {
		throw new Exception('The certificate could not be read.');
	}
} catch (Exception $e) {
	if (false == ($error = openssl_error_string())) {
		$rsp = [
			'message' => $e->getMessage(),
			'errors' => [
				'certificate' => 'The base64 encoding is not valid.',
			],
		];
	}

	$rsp = [
		'message' => $e->getMessage(),
		'errors' => [
			'certificate' => $error,
			'password' => $error,
		],
	];
	var_dump($rsp);
	exit;
}

$name = 'ClientNewBD';

file_put_contents("$name.p12", $certificateBinary);
var_dump($certificate);
exit;

$access_token = 'Hola Mundo';
$w4s = new Wallet4Sales();
$w4s->setAccesToken($access_token);
$w4s->setCertificate($CERIFICATE_P12);

var_dump($w4s);