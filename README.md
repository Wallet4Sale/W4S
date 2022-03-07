# Wallet4Sales v1 SDK Quickstart
**Quickstart for Wallet4Sales v1 [platform](https://www.wallet4sales.com/)**


## Overview

This quickstart guide is designed for developers to run rapidly within the Wallet4Sales v1 environment using PHP. For further information please feel free to create a request or write to us at: support@wallet4sales.com.


##  Authentication
Our system uses an authentication process for each user account. You need to create your account before requesting your API_KEY. Please click here to [create your account](https://www.wallet4sales.com/)

#### Get Your API Keys
Log to your account, go to your user profile and click the button to request your API_KEY. An email will be sent to the account you confirmed with your credentials.
In case you cannot find a way to request your API_KEY, you can write to us at admin@wallet4sales.com to request your credential and connect to our service.

### Composer
The Wallet4Sales SDK uses composer to manage dependencies. Visit the composer documentation to learn how to install composer.

Go to the root of the project
```shell
cd [route]/Wallet4Sales
```

then install it through composer:
```
composer install
```

This SDK and its dependencies will be installed under `./vendor`.


# Create a new Template
To create a new Template, you will need your API_KEY to make a request to our system. This will be attached to the `Authorization header: Bearer {API_KEY}`.

```php

require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$data['BackgroundColor'] = "rgb(255,255,255)";
$data['ForegroundColor'] = "rgb(0, 0, 0)";
$data['LabelColor'] = "rgb(0, 0, 0)";
$data['OrganizationName'] = "Test";
$data['PassTypeIdentifier'] = "Change this";
$data['TeamIdentifier'] = "Change this";
$data['PassType'] = {PASS_TYPE_ID};
$data['CertificateID'] = {CERTIFICATE_ID};
$data['TemplateName'] = "{TEMPLATE_NAME}";
$data['Description'] = "A little description";
$data['Content'] = array(
  "Items" => array(
    "bodyHeader" => array(
      array(
        "label" => "String",
        "value" => "String",
        "LabelIsDinamic" => bool,
        "ValueIsDinamic" => bool,
        "ChangeMessage" => "string",
        "TextAlign" => "string"
      )
    )
  )
);

$data['IconImage'] = "IconCode or Url";

$API_KEY = '{Your API_KEY}';

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);
$Template = $w4s->CreateTemplate($data);
print_r($Template);

```

This template will be created in your administrator panel with a code useful for your next requests such as creating a campaign for your marketing action.


## Table of contents for a Template

| Key name | Type | Descripción |
| --- | --- | --- |
| BackgroundColor | color, as a string | Required. Background color of the pass, specified as an CSS-style RGB triple. For example, rgb(23, 187, 82).|
| ForegroundColor | color, as a string | Required. Foreground color of the pass, specified as a CSS-style RGB triple. For example, rgb(100, 10, 110).|
| LabelColor | color, as a string | Required. Color of the label text, specified as a CSS-style RGB triple. For example, rgb(255, 255, 255).|
| OrganizationName | string | Required. Display name of the organization that originated and signed the pass.|
| PassTypeIdentifier | string | Required. Pass type identifier, as issued by Apple. The value must correspond with your signing certificate.|
| TeamIdentifier | string | Required. Team identifier of the organization that originated and signed the pass, as issued by Apple.|
| PassType | integer | Required. EL ID del tipo de pase que se creará. Por ejemplo 2.|
| CertificateID | integer | Required. EL ID del Certificado que ha subido o del propio sistema.|
| TemplateName | string | Required. Nombre del template que se va a crear.|
| Description | localizable string | Required. Brief description of the pass, used by the iOS accessibility technologies. Don’t try to include all of the data on the pass in its description, just include enough detail to distinguish passes of the same type.|
| Content | array | Required. Pass content due to theWallet4Sales documentation.|
| Items | array | Required. Items del pass due to Wallet4Sales documentation It can encompass the following values: `bodyHeader`, `bodyBack`, `bodyPrimary`, `bodySecondary`, `bodyAuxiliary`, `bodyBack`|

# Up Load a Certificate

To upload a certificate, you must download a CSR on our platform or request one following the instruction:

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$CSR = $w4s->CreateCSR();
print_r($CSR);
```

The request send you back a signature request which must be uploaded to your [Apple Developer](https://developer.apple.com/) account to issue your certificate.

### Upload your Certificate (CER)

Once your certificate has been issued in your Apple Developers account, you can upload it to our system and it will return the CertificateID you need to create your `Template`.

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$cer = 'Certificates/pass.cer';
$json = array(
  "certificate" => base64_encode(file_get_contents($cer))
);

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$Certificate = json_decode($w4s->LoadCertificate($json),true);
print_r($Certificate);
```


# Create Campaign

A marketing campaign helps us distribute passes. It allows us create your taylor made marketing action towards your clients.

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$data['Name'] = '{CAMPAIGN_NAME}';
$data['TemplateCode'] = '{TEMPLATE_CODE}';
$data['Description'] = '{DESCRIPTION}';

$Campaign = $w4s->CreateCampaign($data);
print_r($Campaign);
```

It will send you back the `CampaignCode` you need to create and distribute passes.


# Create Pass

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$Pass = $w4s->CreatePass('{CAMPAIGN_CODE}');
print_r($Pass);
```
