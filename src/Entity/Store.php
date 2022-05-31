<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;

/**
 * store class
 * @RestMethod(resource="/users/:user_id/stores", method="create")
 * @RestMethod(resource="/stores/:id", method="read")
 * @RestMethod(resource="/users/:user_id/stores/search", method="search")
 * @RestMethod(resource="/users/:user_id/stores/:id", method="update")
 * @RestMethod(resource="/users/:user_id/stores/:id", method="delete")
 */
class Store extends Entity
{
    use EntityTrait;

    /**
     * id
     * @Attribute()
     * @var int
     */
    protected $id;

    /**
     * name
     * @Attribute()
     * @var string
     */
    protected $name;

    /**
     * date_created
     * @Attribute()
     * @var string
     */
    protected $date_created;

    /**
     * business_hours
     * @Attribute()
     * @var object
     */
    protected $business_hours;

    /**
     * location
     * @Attribute()
     * @var object
     */
    protected $location;

     /**
   * Encuentra toda la información de las sucursales generadas a través de filtros específicos.
   * @param array $filter filtros de sucursales
   * @param string $user_id encuentre el id del usuario en su panel de desarrollador en nuestro sitio para desarrolladores mercado pago
   * @return SearchResultsArray
   * @link https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores_search/get
   */
  public function find($user_id, $filter = [])
  {
    $store = static::search(array_merge([
        ['user_id' => $user_id],
        $filter
    ]));

    return $store;
  }
}
