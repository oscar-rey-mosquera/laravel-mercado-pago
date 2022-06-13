<?php
namespace LaravelMercadoPago\Entity;

use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;
use MercadoPago\Preapproval as MercadoPagoPreapproval;

class Preapproval extends MercadoPagoPreapproval implements ClassToJson
{
   use EntityTrait;
   
  
}