<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Preference as MercadoPagoPreference;
use OscarRey\MercadoPago\Traits\EntityTrait;


class Preference extends MercadoPagoPreference
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