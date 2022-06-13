<?php

namespace LaravelMercadoPago\Entity;


use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class Chargeback extends \MercadoPago\Chargeback implements ClassToJson
{
    use EntityTrait;


}
