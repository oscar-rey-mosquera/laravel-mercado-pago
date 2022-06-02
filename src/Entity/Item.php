<?php

namespace OscarRey\MercadoPago\Entity;


use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class Item extends \MercadoPago\Item implements ClassToJson
{
    use EntityTrait;


}
