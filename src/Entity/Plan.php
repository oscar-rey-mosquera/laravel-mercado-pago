<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\Entity;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use OscarRey\MercadoPago\Traits\EntityTrait;

/**
 * plan class
 * @RestMethod(resource="/preapproval_plan/:id", method="read")
 * @RestMethod(resource="/preapproval_plan", method="create")
 * @RestMethod(resource="/preapproval_plan/search", method="search")
 * @RestMethod(resource="/preapproval_plan/:id", method="update")
 */
class Plan extends Entity
{
   use EntityTrait;

   /**
    * id
    * @Attribute()
    * @var string
    */
   protected $id;

   /**
    * collector_id
    * @Attribute()
    * @var int
    */
   protected $collector_id;

   /**
    * application_id
    * @Attribute()
    * @var int
    */
   protected $application_id;

   /**
    * back_url
    * @Attribute()
    * @var string
    */
   protected $back_url;

   /**
    * auto_recurring
    * @Attribute()
    * @var object
    */
   protected $auto_recurring;

   /**
    * reason
    * @Attribute()
    * @var string
    */
   protected $reason;

   /**
    * status
    * @Attribute()
    * @var string
    */
   protected $status;

   /**
    * date_created
    * @Attribute()
    * @var string
    */
   protected $date_created;

   /**
    * last_modified
    * @Attribute()
    * @var string
    */
   protected $last_modified;

   /**
    * init_point
    * @Attribute()
    * @var string
    */
   protected $init_point;

   /**
    * payment_methods_allowed
    * @Attribute()
    * @var object
    */
   protected $payment_methods_allowed;
}
