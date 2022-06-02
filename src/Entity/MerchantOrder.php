<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;
use OscarRey\MercadoPago\Interfaces\ClassToJson;
use MercadoPago\MerchantOrder as MercadoPagoMerchantOrder;

/**
 * This class will allow you to create and manage your orders. You can attach one or more payments in your merchant order.
 * @link https://www.mercadopago.com/developers/en/reference/merchant_orders/_merchant_orders_search/get/ Click here for more infos
 * 
 * @RestMethod(resource="/merchant_orders/:id", method="read") 
 * @RestMethod(resource="/merchant_orders/", method="create")
 * @RestMethod(resource="/merchant_orders/:id", method="update")
 * @RestMethod(resource="/merchant_orders/search", method="search")
 */

class MerchantOrder extends MercadoPagoMerchantOrder implements ClassToJson
{
    use EntityTrait;
}
