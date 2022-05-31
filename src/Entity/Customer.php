<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\Customer as MercadoPagoCustomer;
use OscarRey\MercadoPago\Traits\EntityTrait;


class Customer extends MercadoPagoCustomer
{
   use EntityTrait;

  /**
   * Buscar cliente por el email
   * @param string $email
   * @return Customer|null
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers_id/get
   */
  public function findByEmail($email)
  {
    $customer = $this->find(['email' => $email]);

    return $customer[0] ?? null;
  }


    /**
   * Crear cliente con solo el email
   * @param string $email email del cliente a registrar
   * @return Customer
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers/post
   */
  public function createWithEmail($email)
  {
    $customer = $this->findByEmail($email);

    if (!$customer) {

      $customer = $this;

      $customer->email = $email;

      $customer->save();
    }

    return $customer;
  }
  
}