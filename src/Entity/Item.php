<?php

namespace LaravelMercadoPago\Entity;


use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class Item extends \MercadoPago\Item implements ClassToJson
{
    use EntityTrait;


}
