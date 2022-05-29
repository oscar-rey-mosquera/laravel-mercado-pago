<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Card as MercadoPagoCard;
use OscarRey\MercadoPago\Traits\EntityTrait;

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
  
}