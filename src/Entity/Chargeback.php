<?php

namespace OscarRey\MercadoPago\Entity;


use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class Chargeback extends \MercadoPago\Chargeback implements ClassToJson
{
    use EntityTrait;


}
