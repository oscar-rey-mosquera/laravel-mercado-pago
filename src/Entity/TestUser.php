<?php

namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\Entity;
use MercadoPago\Annotation\RestMethod;
use OscarRey\MercadoPago\Traits\EntityTrait;

/**
 * testuser class
 * @RestMethod(resource="/users/test_user", method="create")
 */
class TestUser extends Entity
{
    use EntityTrait;

    /**
     * id
     * @Attribute()
     * @var string
     */
    protected $id;

    /**
     * nickname
     * @Attribute()
     * @var string
     */
    protected $nickname;

    /**
     * password
     * @Attribute()
     * @var string
     */
    protected $password;

    /**
     * site_status
     * @Attribute()
     * @var string
     */
    protected $site_status;

    /**
     * site_id
     * @Attribute()
     * @var string|null
     */
    protected $site_id;

    /**
     * email
     * @Attribute()
     * @var string
     */
    protected $email;

    /**
     * date_created
     * @Attribute()
     * @var string|null
     */
    protected $date_created;

    /**
     * date_last_updated
     * @Attribute()
     * @var string|null
     */
    protected $date_last_updated;


      /**
   * crear usuarios para hacer test
   * @link https://www.mercadopago.com.co/developers/es/reference/test_user/_users_test_user/post
   * @param string $site_id id del sitio donde se creará el usuario de prueba.
   */
  public function create($site_id = 'MCO')
  {
    $response = SDK::post('/users/test_user', $this->bodyHttp(
      [
        'site_id' => $site_id
      ]
    ));

    return $response;
  }
}
