<?php

namespace OscarRey\MercadoPago\Tests;

use OscarRey\MercadoPago\MercadoPagoServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      MercadoPagoServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }

  public function test_fake()
  {

    $this->assertTrue(true);
  }

  public function getUserTest()
  {
    return [
      [
        'rol' => 'vendedor',
        "id" => 1131625646,
        "nickname" => "TESTUWL4UGE3",
        "password" => "qatest1778",
        "site_status" => "active",
        "email" => "test_user_57082196@testuser.com"
      ],
      [
        'rol' => 'Comprador',
        "id" => 1131626824,
        "nickname" => "TETE8274044",
        "password" => "qatest4891",
        "site_status" => "active",
        "email" => "test_user_21750243@testuser.com",
      ]
    ];
  }
}
