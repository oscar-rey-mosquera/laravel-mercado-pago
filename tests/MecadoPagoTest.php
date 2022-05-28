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
    public function pago_sdk_test() {
        
      /**
       * consultar medios de pago
       */
      $response = MercadoPago()->findPaymentMethods();

      $this->assertEquals($response['code'], 200);


      /** crear por efecry */
      $payment = MercadoPago()->efecty(5000);

      $payment->description = "Título del producto";
      $payment->payer = ["email" => $this->getUserTest()[1]['email']];

      $payment->save();

      $this->assertNotNull($payment->id);

      $this->assertEquals('pending_waiting_payment', $payment->status_detail);

      /** buscar */
      $find = MercadoPago()->paymentFindById($payment->id);
    
      $this->assertEquals($payment->id, $find->id);
  
       
    }

    /** @test */
    public function listar_pagos() {

     $this->assertNotNull(MercadoPago()->paymentFind()[0]->id);

    }

      /** @test */
      public function crear_item_billetera() {

        $preference = MercadoPago()->walletPurchase();

        $item = MercadoPago()->item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75;

        $preference->items = array($item);
        $preference->save();

        $this->assertNotNull($preference->id);
   
       }
 
}