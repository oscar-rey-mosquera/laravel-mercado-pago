<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;

/**
 * @link https://www.mercadopago.com.co/developers/es/reference/qr-dynamic/_instore_orders_qr_seller_collectors_user_id_pos_external_pos_id_qrs/post Click here for more infos
 * 
 * @RestMethod(resource="/instore/orders/qr/seller/collectors/:user_id/pos/:external_pos_id/qrs", method="create")
 * @RestMethod(resource="/instore/orders/qr/seller/collectors/:user_id/pos/:external_pos_id/qrs", method="update")
 */

class InstoreOrderQr extends Entity
{
    use EntityTrait;

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

    /**
     * cash_out
     * @Attribute()
     * @var object
     */
    protected $cash_out;


    /**
     * description
     * @Attribute()
     * @var string
     */
    protected $description;


    /**
     * expiration_date
     * @Attribute()
     * @var string
     */
    protected $expiration_date;



    /**
     * external_reference
     * @Attribute()
     * @var string
     */
    protected $external_reference;

    /**
     * items
     * @Attribute()
     * @var array
     */
    protected $items;

    /**
     * notification_url
     * @Attribute()
     * @var string
     */
    protected $notification_url;

        /**
     * sponsor
     * @Attribute()
     * @var object
     */
    protected $sponsor;

    /**
     * taxes
     * @Attribute()
     * @var array
     */
    protected $taxes;

    /**
     * title
     * @Attribute()
     * @var string
     */
    protected $title;

   /**
     * total_amount
     * @Attribute()
     * @var int
     */
    protected $total_amount;

    /**
     * qr_data
     * @Attribute()
     * @var string
     */
    protected $qr_data;

}
