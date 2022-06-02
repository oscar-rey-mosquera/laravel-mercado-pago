<?php
namespace OscarRey\MercadoPago\Entity;

use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;
use MercadoPago\Preapproval as MercadoPagoPreapproval;

class Preapproval extends MercadoPagoPreapproval implements ClassToJson
{
   use EntityTrait;
   
  
}