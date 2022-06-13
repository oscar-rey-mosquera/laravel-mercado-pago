<?php

namespace LaravelMercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;

/**
 * identificationtype class
 * @RestMethod(resource="/v1/identification_types", method="list")
 */
class IdentificationType extends Entity implements ClassToJson
{
    use EntityTrait;

    /**
     * id
     * @Attribute()
     * @var string
     */
    protected $id;

    /**
     * name
     * @Attribute()
     * @var string
     */
    protected $name;

    /**
     * type
     * @Attribute()
     * @var string
     */
    protected $type;


    /**
     * min_length
     * @Attribute()
     * @var int
     */
    protected $min_length;

    /**
     * max_length
     * @Attribute()
     * @var int
     */
    protected $max_length;


  /**
   * Obtener tipos de documentos
   * @return array
   * @link https://www.mercadopago.com.co/developers/es/reference/identification_types/_identification_types/get
   */
  public function find()
  {
    return static::all();
  }
}
