<?php
namespace OscarRey\MercadoPago\Entity;

use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;
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