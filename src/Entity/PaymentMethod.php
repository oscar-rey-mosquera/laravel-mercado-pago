<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use OscarRey\MercadoPago\Traits\EntityTrait;

/**
 * paymentmethod class
 * @RestMethod(resource="/v1/payment_methods", method="list")
 */
class PaymentMethod extends Entity
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
     * payment_type_id
     * @Attribute()
     * @var string
     */
    protected $payment_type_id;


    /**
     * status
     * @Attribute()
     * @var string
     */
    protected $status;

    /**
     * secure_thumbnail
     * @Attribute()
     * @var string
     */
    protected $secure_thumbnail;

    /**
     * thumbnail
     * @Attribute()
     * @var string
     */
    protected $thumbnail;

    /**
     * deferred_capture
     * @Attribute()
     * @var string
     */
    protected $deferred_capture;

    /**
     * settings
     * @Attribute()
     * @var array
     */
    protected $settings;

    /**
     * additional_info_needed
     * @Attribute()
     * @var array
     */
    protected $additional_info_needed;


    /**
     * min_allowed_amount
     * @Attribute()
     * @var int
     */
    protected $min_allowed_amount;

    /**
     * max_allowed_amount
     * @Attribute()
     * @var int
     */
    protected $max_allowed_amount;

    /**
     * accreditation_time
     * @Attribute()
     * @var int
     */
    protected $accreditation_time;


    /**
     * financial_institutions
     * @Attribute()
     * @var array
     */
    protected $financial_institutions;

    /**
     * processing_modes
     * @Attribute()
     * @var array
     */
    protected $processing_modes;
}
