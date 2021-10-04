# Wallet4Sales v1 REST Quickstart
**This quckstart is for the Wallet4Sales v1 [platform](https://www.wallet4sales.com/)**


## Overview

Esta guía de inicio está diseñada para que los desarrolladores se pongan en marcha rápidamente dentro del entorno de Wallet4Sales v1 mediante REST, Curl o PHP.
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


# Accediendo vía Curl
Para acceder vía Curl, se debe ingresar el API_KEY correspondiente a tu usuario
Hay que aclarar que muchos de los parámetros POST que se están enviando no son campos obligatorios, esto depende del tipo de pase que se vaya a crear.
```cmd
curl --location --request POST 'https://www.w4s.ai/apiwallet4sales/Template/New' \
--header 'Content-Type: application/octet-stream' \
--header 'Authorization: Bearer {API_KEY}' \
--data-raw '{
  "BackgroundColor": "rgb(255,255,255)",
  "ForegroundColor": "rgb(0, 0, 0)",
  "LabelColor": "rgb(0, 0, 0)",
  "OrganizationName": "{OrganizationName}",
  "PassTypeIdentifier": "{PassTypeIdentifier}",
  "TeamIdentifier": "{TeamIdentifier}",
  "PassType": 2,
  "CertificateID": {CertificateID},
  "TemplateName": "{TemplateName}",
  "Description": "{Description}",
  "SuppressStripShine": true,
  "LogoText": "",
  "Content": {
    "Items": {
      "bodyHeader": [
        {
          "label": "Header",
          "value": "",
          "LabelIsDinamic": true,
          "ValueIsDinamic": true,
          "ChangeMessage": "",
        }
      ],
      "bodyPrimary": [
        {
            "label": "OFFER",
            "value": "",
            "LabelIsDinamic": true,
            "ValueIsDinamic": true,
            "ChangeMessage": "",
        }
      ],
      "bodyBack": [
        {
          "label": "Email",
          "value": "test@email.com",
          "LabelIsDinamic": true,
          "ValueIsDinamic": true,
          "ChangeMessage": "",
        }
      ]
    }
  },
  "Barcode":{
    "TypeBarcode": "Aztec",
    "BarcodeMessage": "{BarcodeMessage}",
    "BarcodeMessageEncoding": "UTF-8",
    "BarcodeAltText": "{SerialNumber}"
  },
  "IconImage": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQceDA8nEhAB_tnLfBhy9V6imuQFzxkrzYDng&usqp=CAU",
  "RelevantDate": "2021-08-24T15:52+00:00",
  "TransitType" : "Air"
}'
```

Este template se creará en su panel de administrador con un código el cuál lo usará para los siguientes pasos cómo crear una campaña para su acción de marketing.

### Create Campaign

Para crear una campaña y asociarla con el template anterior, debe enviar un Curl similar al siguiente ejemplo:

```cmd
curl --location --request POST 'https://www.w4s.ai/OptimaWalletDev/Campaign/New' \
--header 'Authorization: Bearer {API_KEY}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "Name" : "{Campaign_Name}",
    "TemplateCode" : "{TemplateCode}",
    "Description": "Una descripción corta",
    "InitDay" : "2021-08-24T15:52+00:00",
    "EndDay" : "2021-08-30T15:52+00:00",
    "MaxDistance": "500",
    "Locations": [
    {
      "locationlatitude": "40.0574881",
      "locationlongitude": "0.0847931",
      "locationAlert": "Cerca de la primera instalación",
      "locationAlias" : "Point 1"
    },
    {
      "locationlatitude": "0.0847931",
      "locationlongitude": "40.0574881",
      "locationAlert": "Cerca de la segunda instalación",
      "locationAlias" : "Point 2"
    }
  ]
}'
```
Al igual que con el template, este endPoint nos devuelve un código de campaña para que podemos crear los pases en un futuro.


### Create Pass
Para crear un pase, nos conectaremos al siguiente endPoint:
```cmd
curl --location --request POST 'https://www.w4s.ai/apiwallet4sales/{Campaign_Code}/Pass/New' \
--header 'Authorization: Bearer {API_KEY}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "CardCode" : "{CardCode}"
}'
```
