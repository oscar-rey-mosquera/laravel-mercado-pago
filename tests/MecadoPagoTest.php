<?php

namespace LaravelMercadoPago\Tests;

use MercadoPago\SDK;
use LaravelMercadoPago\Facades\MercadoPago;


class MecadoPagoTest extends TestCase
{
  /**
   * @test
   */
  public function funciona_el_helper_y_facade()
  {

    $this->assertEquals('hello', MercadoPago()->hello());

    $this->assertEquals('hello', MercadoPago::hello());
  }

  /**
   * @test
   */
  public function pago_sdk_test()
  {

    /**
     * consultar medios de pago
     */
    $this->assertArrayHasKey(1, MercadoPago()->paymentMethod()->find());


    /** crear por efecry */
    $payment = MercadoPago()->payment()->efecty(5000);

    $payment->description = "Título del producto";
    $payment->payer = ["email" => $this->getUserTest()[1]['email']];

    $payment->save();

    $this->assertNotNull($payment->id);

    $this->assertEquals('pending_waiting_payment', $payment->status_detail);

    /** buscar */
    $find = MercadoPago()->payment()->findById($payment->id);

    $this->assertEquals($payment->id, $find->id);
  }

  /** @test */
  public function listar_pagos()
  {

    $this->assertNotNull(MercadoPago()->payment()->find()[0]->id);
  }

  /** @test */
  public function crear_item_billetera()
  {

    $preference = MercadoPago()->preference()->wallet();

    $item = MercadoPago()->item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 75;

    $preference->items = array($item);
    $preference->save();

    $this->assertNotNull($preference->id);
  }

  /** @test */
  public function crear_suscripcion()
  {

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

    $findById = MercadoPago()->preapproval()->findById($suscripcion->id);

    $this->assertEquals($suscripcion->id, $findById->id);

    $this->assertArrayHasKey(0, MercadoPago()->preapproval()->find());

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
  public function consultar_usuarios_y_pago_con_targeta_de_credito()
  {

    $customer =  MercadoPago()->customer()->createWithEmail('rios@test.es');

    $this->assertNotNull($customer->id);


    //  dd(MercadoPago()->store()->create([
    //    'name' => 'test store',
    //    'location' => [
    //      'city_name' => 'Quibdó',
    //      'state_name' => 'Choco',
    //      "latitude" => -32.8897322,
    //      "longitude" => -68.8443275,
    //      "street_name" => "Los rosales"
    //    ]
    //  ]));


    //47293910


    list($cardToken, $cardNumber) = $this->createCardToken();



    $paymenMethod = MercadoPago()->paymentMethod()->findCreditCard($cardNumber);


    $payment = $this->creditCardPayment($cardToken, $customer, $paymenMethod);

    $this->assertNotNull($payment->id);

    $this->pago_avanzado($customer);
  }

  public function pago_avanzado($customer)
  {

    list($cardToken, $cardNumber) = $this->createCardToken();

    $paymenMethod = MercadoPago()->paymentMethod()->findCreditCard($cardNumber);

    $card = MercadoPago()->card();

    $card->token = $cardToken->id;
    $card->customer_id = $customer->id;
    $card->issuer = array("id" => $paymenMethod->issuer->id);
    $card->payment_method = array("id" => $paymenMethod->id);
    $card->save();

    $cardToken = MercadoPago()->cardToken();

    $cardToken->card_id = $card->id;
    $cardToken->security_code = '123';

    $cardToken->save();

    $payment = $this->creditCardPayment($cardToken, $customer, $paymenMethod);

    $this->assertNotNull($payment->id);
  }


  public function createCardToken()
  {

    $cardToken = MercadoPago()->cardToken();
    $cardNumber = "4013540682746260";

    $cardToken->card_number = $cardNumber;
    $cardToken->expiration_month = '11';
    $cardToken->expiration_year = '2025';
    $cardToken->security_code = '123';
    $cardToken->cardholder = [
      'name' => 'APRO'
    ];

    $cardToken->save();

    return [$cardToken, $cardNumber];
  }


  public function creditCardPayment($cardToken, $customer, $paymenMethod)
  {

    $payment = MercadoPago()->payment();
    $payment->transaction_amount = 500000;
    $payment->token = $cardToken->id;
    $payment->description = 'test';
    $payment->installments = 1;
    $payment->payment_method_id = $paymenMethod->id;
    $payment->issuer_id = $paymenMethod->issuer->id;

    $payment->payer = array(
      "type" => "customer",
      "id" => $customer->id
    );

    $payment->save();

    return $payment;
  }
}
