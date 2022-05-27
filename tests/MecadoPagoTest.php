<?php

namespace OscarRey\MercadoPago\Tests;

use OscarRey\MercadoPago\Facades\MercadoPago;


class MecadoPagoTest extends TestCase
{
    /**
     * @test
     */
    public function funciona_el_helper_y_facade() {
        
      $this->assertEquals('hello', MercadoPago()->hello());

      $this->assertEquals('hello', MercadoPago::hello());
    }

    /**
     * @test
     */
    public function consultar_users_test() {
        
       
    }
 
}