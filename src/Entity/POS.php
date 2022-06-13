<?php
namespace LaravelMercadoPago\Entity;

use MercadoPago\POS as MercadoPagoPOS;
use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class POS extends MercadoPagoPOS implements ClassToJson
{
   use EntityTrait;
  
}