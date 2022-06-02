<?php

namespace OscarRey\MercadoPago\Entity;


use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class Payer extends \MercadoPago\Payer implements ClassToJson
{
    use EntityTrait;


}
