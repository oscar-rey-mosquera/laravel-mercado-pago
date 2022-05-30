<?php

namespace OscarRey\MercadoPago\Entity;


use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;
use MercadoPago\InstoreOrder as MercadoPagoInstoreOrder;

/**
 * Instore Order V2 class
 * @link https://www.mercadopago.com.co/developers/es/reference/instore_orders_v2/_instore_qr_seller_collectors_user_id_pos_external_pos_id_orders/get Click here for more infos
 * 
 * @RestMethod(resource="/instore/qr/seller/collectors/:user_id/stores/:external_store_id/pos/:external_pos_id/orders", method="update")
 * @RestMethod(resource="/instore/qr/seller/collectors/:user_id/pos/:external_pos_id/orders", method="read")
 * @RestMethod(resource="/instore/qr/seller/collectors/:user_id/pos/:external_pos_id/orders", method="delete")
 */
class InstoreOrderV2 extends Entity
{
    use EntityTrait;

    /**
     * external_reference
     * @Attribute()
     * @var string
     */
    protected $external_reference;

    /**
     * total_amount
     * @Attribute()
     * @var int
     */
    protected $total_amount;

    /**
     * items
     * @Attribute()
     * @var array
     */
    protected $items;

    /**
     * title
     * @Attribute()
     * @var string
     */
    protected $title;

    /**
     * description
     * @Attribute()
     * @var string
     */
    protected $description;

    /**
     * sponsor
     * @Attribute()
     * @var object
     */
    protected $sponsor;

    /**
     * expiration_date
     * @Attribute()
     * @var string
     */
    protected $expiration_date;

    /**
     * notification_url
     * @Attribute()
     * @var string
     */
    protected $notification_url;

    /**
     * user_id
     * @Attribute()
     * @var string
     */
    protected $user_id;

    /**
     * external_pos_id
     * @Attribute()
     * @var string
     */
    protected $external_pos_id;
}
