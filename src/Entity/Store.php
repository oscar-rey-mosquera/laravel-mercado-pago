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
}
