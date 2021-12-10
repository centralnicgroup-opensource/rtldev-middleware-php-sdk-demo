# php-sdk-demo

PHP SDK Demo App

## Requirements

Having php, php-curl and composer installed globally.

## How to get started

Run our demo app!

Simple Example for HEXONET:

```bash
git clone https://github.com/centralnic-reseller/php-sdk-demo php-sdk-demo-hexonet
cd php-sdk-demo-hexonet
composer update
php app_hexonet.php <your account id> <your password>
```

Simple Example for RRPproxy:

```bash
git clone https://github.com/centralnic-reseller/php-sdk-demo php-sdk-demo-rrpproxy
cd php-sdk-demo-rrpproxy
composer update
php app_rrpproxy.php <your account id> <your password>
```

Check the [source code](https://raw.githubusercontent.com/centralnic-reseller/php-sdk-demo/master/app.php) for details.

## Your project

Just include "centralnic-reseller/php-sdk" with its latest version as dependency in your composer.json.
You'll have then access to all the functionality provided by our SDKs.
