<?php
namespace OscarRey\MercadoPago\Entity;

use OscarRey\MercadoPago\Traits\EntityTrait;
use MercadoPago\Preapproval as MercadoPagoPreapproval;

class Preapproval extends MercadoPagoPreapproval
{
   use EntityTrait;
  
}