<?php

namespace OscarRey\MercadoPago\Entity;


use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class InstoreOrder extends \MercadoPago\InstoreOrder implements ClassToJson
{
    use EntityTrait;


}
