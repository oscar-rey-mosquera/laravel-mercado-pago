<?php

namespace LaravelMercadoPago\Entity;


use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class InstoreOrder extends \MercadoPago\InstoreOrder implements ClassToJson
{
    use EntityTrait;


}
