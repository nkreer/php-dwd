# php-dwd

This is a simple library for getting the Wetterwarnungen provided by deutscher Wetterdienst (DWD) through a simple interface.
It's licensed under the [MIT License](LICENSE).

## Installation

Add this library to your project using composer:

`composer require nkreer/php-dwd`

To initialise, add the following to the top of your script

```php
<?php
include_once("vendor/autoload.php");
use DWD\DWD;
```

## Method overview

If you need examples, check out [example.php](example.php).

### Warnings

To download all current warnings, run

```php
DWD::update();
```

To search for warnings, do the following to get an array of matching warnings:

```php
DWD::getWarning($query);
```

Or if you want to get an array of all available warnings, do

```php
DWD::getWarnings();
```

To make sure that your data is still valid, run

```php
DWD::isValid();
```

### Images

If you need a link to the germany map (visualisation of the warnings), call

```php
DWD::getGermanyMap();
```