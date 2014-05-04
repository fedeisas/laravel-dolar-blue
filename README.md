Laravel Dolar Blue
==================

[![Travis Badge](https://secure.travis-ci.org/fedeisas/laravel-dolar-blue.png)](http://travis-ci.org/fedeisas/laravel-dolar-blue)
[![Coverage Status](https://coveralls.io/repos/fedeisas/laravel-dolar-blue/badge.png)](https://coveralls.io/r/fedeisas/laravel-dolar-blue)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/fedeisas/laravel-dolar-blue/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Latest Stable Version](https://poser.pugx.org/fedeisas/laravel-dolar-blue/v/stable.png)](https://packagist.org/packages/fedeisas/laravel-dolar-blue)
[![Latest Unstable Version](https://poser.pugx.org/fedeisas/laravel-dolar-blue/v/unstable.png)](https://packagist.org/packages/fedeisas/laravel-dolar-blue)
[![Total Downloads](https://poser.pugx.org/fedeisas/laravel-dolar-blue/downloads.png)](https://packagist.org/packages/fedeisas/laravel-dolar-blue)
[![License](https://poser.pugx.org/fedeisas/laravel-dolar-blue/license.png)](https://packagist.org/packages/fedeisas/laravel-dolar-blue)

## Why?
Because Argentina has a black market for currency exchange. And this makes it easy to retrieve the current USD conversion rate from different sources. And also because I needed something small to talk about Package Development and testing on [this meetup](http://www.meetup.com/Laravel-Buenos-Aires/events/174574162/).

## Requirements
- Laravel 4
- PHP >= 5.4

## Installation
Begin by installing this package through Composer. Edit your project's `composer.json` file to require `fedeisas/laravel-dolar-blue.

```json
{
  "require": {
        "laravel/framework": "4.0.*",
        "fedeisas/laravel-dolar-blue": "dev-master"
    },
    "minimum-stability" : "dev"
}
```

Next, update Composer from the Terminal:
```bash
$ composer update
```

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'providers' => array(
    ...
    'Fedeisas\LaravelDolarBlue\LaravelDolarBlueServiceProvider',
)
```

Optionally you can also add the Facade to the aliases array on `app/config/app.php`:
```php
'aliases' => array(
    ...
    'DolarBlue' => 'Fedeisas\LaravelDolarBlue\Facade\LaravelDolarBlue',
)
```

## Usage
Currenly it only supports 3 providers (more to come):

+ LaNacion
+ DolarBlue
+ BlueLytics

```php
use Fedeisas\LaravelDolarBlue\LaravelDolarBlue;

$service = new LaravelDolarBlue;
$result = $service->get('DolarBlue');
// returns
// array(
//   'buy' => '10.15',
//   'sell' => '10.55',
//   'timestamp' => 1399080004
// )
```

Or you an use the facade:
```php
$result = DolarBlue::get('LaNacion');

// or using some __call magic
$result = DolarBlue::LaNacion();
$result = DolarBlue::DolarBlue();
$result = DolarBlue::BlueLytics();
```

## Contributing
```bash
$ composer install --dev
$ ./vendor/bin/phpunit
```
In addition to a full test suite, there is Travis integration.

## Found a bug?
Please, let me know! Send a pull request or a patch. Questions? Ask! I will respond to all filed issues.

## Inspiration
I needed an idea for a small library, and I borrowed it from a friend who has done something similar for NodeJS. You should check it out: https://github.com/matiu/dolar-blue

## License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)