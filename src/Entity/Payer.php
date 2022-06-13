<?php

namespace LaravelMercadoPago\Entity;


use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class Payer extends \MercadoPago\Payer implements ClassToJson
{
    use EntityTrait;


}
