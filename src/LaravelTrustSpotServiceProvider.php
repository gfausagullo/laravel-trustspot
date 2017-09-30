<?php

namespace Gonzaloner\LaravelTrustSpot;

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Gonzaloner\LaravelTrustSpot\Wrappers\TrustSpotApiWrapper;
use Gonzaloner\TrustSpotApiClient\TrustSpotApiClient;

class LaravelTrustSpotServiceProvider extends ServiceProvider
{

  public function boot()
  {
    $this->setupConfig();
  }

  public function register()
  {
    $this->registerApiClient();
    $this->registerApiAdapter();
    $this->registerManager();
  }

  protected function setupConfig()
  {
    $source = realpath(__DIR__ . '/../config/laraveltrustspot.php');

    if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
      $this->publishes([$source => config_path('laraveltrustspot.php')]);
    } elseif ($this->app instanceof LumenApplication) {
      $this->app->configure('laraveltrustspot');
    }

    $this->mergeConfigFrom($source, 'laraveltrustspot');
  }

  protected function registerApiClient()
  {
    $this->app->singleton('laraveltrustspot.api.client', function () {
      return new TrustSpotApiClient();
    });
    $this->app->alias('laraveltrustspot.api.client', TrustSpotApiClient::class);
  }

  protected function registerApiAdapter()
  {
    $this->app->singleton('laraveltrustspot.api', function (Container $app) {
      $config = $app['config'];
      return new TrustSpotApiWrapper($config, $app['laraveltrustspot.api.client']);
    });
    $this->app->alias('laraveltrustspot.api', TrustSpotApiWrapper::class);
  }

  public function registerManager()
  {
    $this->app->singleton('laraveltrustspot', function (Container $app) {
      return new LaravelTrustSpotManager($app);
    });
    $this->app->alias('laraveltrustspot', LaravelTrustSpotManager::class);
  }

  public function provides()
  {
    return [
      'laraveltrustspot',
      'laraveltrustspot.api',
      'laraveltrustspot.api.client',
    ];
  }

}
