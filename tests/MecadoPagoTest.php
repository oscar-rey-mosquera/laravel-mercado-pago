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
      $this->assertArrayHasKey(1, MercadoPago()->findPaymentMethod());


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

     $this->assertNotNull(MercadoPago()->findPayment()[0]->id);

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

        /** @test */
      public function crear_suscripcion() {

        $suscripcion = MercadoPago()->createPreapproval(
          "Monthly subscription to premium package"
        );

        $suscripcion->payer_email = $this->getUserTest()[1]['email'];
         
        $suscripcion->auto_recurring = array( 
          "frequency" => 1,
          "frequency_type" => "months",
          "transaction_amount" => 50000,
          "currency_id" => "COP", // your currency
      );
  
        $suscripcion->save();

        $this->assertNotNull($suscripcion->id);

        $findById = MercadoPago()->preapprovalFindBydId($suscripcion->id);

        $this->assertEquals($suscripcion->id, $findById->id);

         $this->assertArrayHasKey(0, MercadoPago()->findPreapproval());

        //  $plan = MercadoPago()->createPlan('plan test');
          
        //  $plan->auto_recurring = array( 
        //   "frequency" => 1,
        //   "frequency_type" => "months",
        //   "transaction_amount" => 50000,
        //   "currency_id" => "COP", // your currency
        //  );

        //  $plan->save();


        //  $plan = MercadoPago()->cancelPlan($plan->id);

         
       }

       /** @test */
       public function consultar_usuarios() {
           
         $customer =  MercadoPago()->createCustomerEmail('test@test.es');

         $this->assertNotNull($customer->id);
         
       }
 
}