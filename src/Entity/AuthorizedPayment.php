<?php
namespace LaravelMercadoPago\Entity;

use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;
use MercadoPago\AuthorizedPayment as MercadoPagoAuthorizedPayment;

class AuthorizedPayment extends MercadoPagoAuthorizedPayment implements ClassToJson
{
   use EntityTrait;
  
}