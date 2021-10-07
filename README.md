# Wallet4Sales v1 SDK Quickstart
**This quckstart is for the Wallet4Sales v1 [platform](https://www.wallet4sales.com/)**


## Overview

Esta guía de inicio está diseñada para que los desarrolladores se pongan en marcha rápidamente dentro del entorno de Wallet4Sales v1 mediante PHP.
Si cree que hay algunas otras mejores formas en que podemos mejorar nuestra documentación, no dude en crear una solicitud o escribirnos a nuestro correo: support@wallet4sales.com.


##  Autenticación
Nuestro sistema usa una autenticación por cada cuenta de usuario que se crear, por lo tanto, antes de solicitar su API_KEY deberá crearse una cuenta dentro de nuestra [platforma](https://www.wallet4sales.com/)

#### Get Your API Keys
Dentro de su cuenta, tiene que ir a su perfil de usuario y encontrará un botón con una solicitud a su API_KEY. Al darle click, se le enviará un correo a la cuenta que ha confirmado
con esta creadencial.


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


# Creando un Template
Para crear un nuevo Template dentro de su plataforma, tiene que ya tener su API_KEY para cualquier solicitud a nuestro sistema.
Este se adjunta con el encabezado `Authorization: Bearer {API_KEY}`.

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

Este template se creará en su panel de administrador con un código el cuál lo usará para las siguientes solicitudes tales como crear una campaña para su acción de marketing.


## Tabla de contenidos para un Template

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
| Content | array | Required. Contenido del pase según la documentación de Wallet4Sales.|
| Items | array | Required. Items del pase según la documentación de Wallet4Sales. Puede abarcar los siguientes valores: `bodyHeader`, `bodyBack`, `bodyPrimary`, `bodySecondary`, `bodyAuxiliary`, `bodyBack`|

# Load Certificate

Para subir un certificado, debe descargar un CSR en nuestra plataforma o solicitándolo con el siguiente método:

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$CSR = $w4s->CreateCSR();
print_r($CSR);
```

La solicitud retorna una solicitud de firma la cual se tiene que subir a su cuenta [Apple Developer](https://developer.apple.com/) para emitir su certificado.

### Cargando su certificado (CER)

Una vez emitido su certificado en su cuenta Apple Developers, podrá subirlo a nuestro sistema y este le devolverá un `CertificateID` que lo usará para crear su `Template`.

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

Te retornará un `CampaignCode` con lo cuál se podrá crear los pases a distribuir.


# Create Pass

```php
require __DIR__.'/vendor/autoload.php';

use Wallet4SalesPHP\Wallet4Sales;

$w4s = new Wallet4Sales();
$w4s->setAccesToken($API_KEY);

$Pass = $w4s->CreatePass('{CAMPAIGN_CODE}');
print_r($Pass);
```
