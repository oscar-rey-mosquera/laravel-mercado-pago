<?php

namespace OscarRey\MercadoPago;

use OscarRey\MercadoPago\MercadoPago;
use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->loadServiceContainer();
    $this->loadConfig();
  }

  public function boot()
  {
    $this->publish();
  }


  /**
   * Carga las clases al service container
   */
  private function loadServiceContainer()
  {

    $this->app->bind('mercado-pago', function ($app) {
      return new MercadoPago();
    });
  }



  /**
   * Carga los archivos de configuración del paquete
   */
  private function loadConfig()
  {

    $this->mergeConfigFrom($this->resolvePath('config/mercado-pago.php'), 'mercado-pago');
  }


  /**
   * publicar configuraciones
   */
  private function publish()
  {
    $this->publishes([
      $this->resolvePath('config/mercado-pago.php') => config_path('mercado-pago.php'),
    ], 'mercado-pago');
  }


  /**
   * genera la posicion del path afuera del src
   * @param string $path
   */
  private function resolvePath($path)
  {

    return __DIR__ . "/../{$path}";
  }
}
