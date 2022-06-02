<?php
namespace OscarRey\MercadoPago\Entity;

use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;
use MercadoPago\AuthorizedPayment as MercadoPagoAuthorizedPayment;

class AuthorizedPayment extends MercadoPagoAuthorizedPayment implements ClassToJson
{
   use EntityTrait;
  
}