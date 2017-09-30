![TrustSpot](http://s3.amazonaws.com/trustspot-blog-images/blog/wp-content/uploads/2016/01/04185419/TS_Logo_Alternative_ForWhiteBG.png)

# TrustSpot API client wrapper for Laravel #
Laravel-TrustSpot incorporates the [TrustSpot API](https://www.trustspot.io/) into your [Laravel](https://laravel.com/) or [Lumen](https://lumen.laravel.com/) project.

## Installation
Add Laravel-TrustSpot to your composer file via the `composer require` command:

```bash
$ composer require gonzaloner/laravel-trustspot
```

Laravel 5.5+ will use the auto-discovery function.

In Laravel 5.4 (or if you are not using auto-discovery) register the service provider by adding it to the `providers` key in `config/app.php`. Also register the facade by adding it to the `aliases` key in `config/app.php`.

```php
'providers' => [
    ...
    TrustSpot\Laravel\TrustSpotServiceProvider::class,
],

'aliases' => [
    ...
    'TrustSpot' => TrustSpot\Laravel\Facades\TrustSpot::class,
]
```

## License ##
[MIT License](https://opensource.org/licenses/MIT)
Copyright (c) 2017
