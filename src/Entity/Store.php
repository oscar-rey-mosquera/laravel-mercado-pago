<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
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
  public function find($filter = [], $user_id = null)
  {
    $user_id = $user_id ?? $this->getUserId();

    $store = static::search(array_merge([
        ['user_id' => $user_id],
        $filter
    ]));

    return $store;
  }

     /**
   * Crear una store
   * @param array $data datos de la sucursal
   * @param int $user_id encuentre el id del usuario en su panel de desarrollador en nuestro sitio para desarrolladores mercado pago
   * @return Store
   * @link https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores/post
   */
  public function create($data = [], $user_id = null)
  {
    $user_id = $user_id ?? $this->getUserId();
    $store = SDK::post("/users/{$user_id}/stores", $this->bodyHttp($data));

    return $this->findByIdhandlerResponse($store);
  }



     /**
   * Actualizar una store
   * @param array $data datos de la sucursal
   * @param int $user_id encuentre el id del usuario en su panel de desarrollador en nuestro sitio para desarrolladores mercado pago
   * @param int $user_id store id
   * @return Store
   * @link https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores_id/put
   */
  public function updateV2($store_id , $data = [], $user_id = null)
  {
    $user_id = $user_id ?? $this->getUserId();
    $store = SDK::put("/users/{$user_id}/stores/{$store_id}", $this->bodyHttp($data));

    return $this->findByIdhandlerResponse($store);
  }

      /**
   * delete una store
   * @param int $user_id encuentre el id del usuario en su panel de desarrollador en nuestro sitio para desarrolladores mercado pago
   * @param int $user_id store id
   * @return array
   * @link https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores_id/delete
   */
  public function deleteV2($store_id, $user_id = null)
  {
    $response = $this->findById($store_id);
    $this->user_id = $user_id ?? $this->getUserId();
   
    if($response) {
      $response->delete();
    }

    return $response;
  }
}
