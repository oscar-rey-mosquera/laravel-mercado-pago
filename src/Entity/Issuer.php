<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\SDK;
use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class Issuer extends Entity implements ClassToJson
{
    use EntityTrait;

  /**
   * @param array $data
   */
    public function create($data)
    {
       $issert = SDK::get("/v1/payment_methods/card_issuers", $this->bodyHttp($data));

       return  $issert;
    }

}
