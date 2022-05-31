<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Card as MercadoPagoCard;
use OscarRey\MercadoPago\Traits\EntityTrait;
use MercadoPago\Entity;

/**
 * The cards class is the way to store card data of your customers safely to improve the shopping experience.
 *
 * This will allow your customers to complete their purchases much faster and easily, since they will not have to complete their card data again.
 *  
 * This class must be used in conjunction with the Customer class.
 *
 * @link https://www.mercadopago.com/developers/en/guides/online-payments/web-tokenize-checkout/customers-and-cards Click here for more infos
 * 
 * @RestMethod(resource="/v1/customers/:customer_id/cards", method="create")
 * @RestMethod(resource="/v1/customers/{customer_id}/cards", method="read")
 * @RestMethod(resource="/v1/customers/:customer_id/cards/:id", method="update")
 * @RestMethod(resource="/v1/customers/:customer_id/cards/:id", method="delete")
 */

class Card extends MercadoPagoCard
{
   use EntityTrait;

   /**
    * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards_id/get
    * @param int $id targeta de credito guardada
    * @param string $customer_id
    * @return Card|null
    * Consultar targeta de credito guardada
    */
   public function findById($customer_id, $id) {

      $response = SDK::get("/v1/customers/{$customer_id}/cards/{$id}");

     return  $this->findByIdhandlerResponse($response);
   }


     /**
    * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards_id/delete
    * @param int $id targeta de credito guardada
    * @param string $customer_id
    * @return Card|null
    * eliminar
    */
    public function deleteV2($customer_id, $id) {

      $response = $this->findById($customer_id, $id);

      if($response) {

         $response->delete();
      }

      return $response;
   }
  
}