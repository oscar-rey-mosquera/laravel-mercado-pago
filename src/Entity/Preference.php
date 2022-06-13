<?php
namespace LaravelMercadoPago\Entity;

use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;
use MercadoPago\Preference as MercadoPagoPreference;


class Preference extends MercadoPagoPreference implements ClassToJson
{
   use EntityTrait;

  /**
   * Crear un pago por walletPurchase
   * @return Preference
   */
  public function wallet()
  {
    $this->purpose = 'wallet_purchase';

    return $this;
  }
  
}