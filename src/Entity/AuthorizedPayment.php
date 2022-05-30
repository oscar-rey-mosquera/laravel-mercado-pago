<?php
namespace OscarRey\MercadoPago\Entity;

use OscarRey\MercadoPago\Traits\EntityTrait;
use MercadoPago\AuthorizedPayment as MercadoPagoAuthorizedPayment;

class AuthorizedPayment extends MercadoPagoAuthorizedPayment
{
   use EntityTrait;
  
}