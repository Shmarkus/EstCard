# Usage
Initialise service
```php
<?php
$pathToPrivateKey = '/testkeys/private.key';
$pathToPublicKey = '/testkeys/public.key';
$postBack = 'https://'.$_SERVER['HTTP_HOST'] . '/payment';
$estCardId = '318DC77DC8';
$estCardUrl = 'https://pos.estcard.ee/test-pos/iPayServlet';
$estCard = new \CodeHouse\EstCard\EstCardImpl($pathToPrivateKey, $pathToPublicKey, $postBack, $estCardId, $estCardUrl);
```
When the service is initialised, create hidden HTML form to submit to service provider
```php
<?php 
/**
 * @var \CodeHouse\EstCard\EstCard $service
 **/ 
$amountInCents = 10000;
$service->getHtmlForm($amountInCents);
``` 
The form has ID **estcard**, to send the form to Nets, use jQuery ```$('#estcard').submit()```
The response can be validated using the following snippet
```php
<?php 
/**
 * @var \CodeHouse\EstCard\EstCard $service
 **/ 
$result = $service->validateResponse($_REQUEST);
if ($result == \CodeHouse\EstCard\EstCard::VALIDATE_OK && $response['respcode'] == \CodeHouse\EstCard\EstCard::PAYMENT_OK) {
        // success
}
// signature failed, or payment was not processed
``` 

# Info
More info in https://www.nets.eu/etee/Pages/Test-keskkond.aspx
