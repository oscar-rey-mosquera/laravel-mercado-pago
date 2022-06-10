<?php

namespace OscarRey\MercadoPago\Entity;


use MercadoPago\SDK;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class CardToken extends \MercadoPago\CardToken implements ClassToJson
{
  use EntityTrait;

  /**
   * card_number
   * @Attribute()
   * @var string
   */
  protected $card_number;

  /**
   * expiration_month
   * @Attribute()
   * @var string
   */
  protected $expiration_month;

  /**
   * expiration_year
   * @Attribute()
   * @var string
   */
  protected $expiration_year;


  /**
   * security_code
   * @Attribute()
   * @var string
   */
  protected $security_code;

  /**
   * cardholder
   * @Attribute()
   * @var object
   */
  protected $cardholder;

  /**
   * @param array $data
   */
  public function create($data)
  {
    $cardToken = SDK::post("/v1/card_tokens", $this->bodyHttp($data));

    return  $this->findByIdhandlerResponse($cardToken);
  }
}
