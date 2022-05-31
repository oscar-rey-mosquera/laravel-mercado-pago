<?php

namespace OscarRey\MercadoPago;

use MercadoPago\{
  SDK,
  Payer,
  Item,
  Chargeback,
  Entity,
  Refund,
  InstoreOrder
};

use OscarRey\MercadoPago\Traits\ConfigTrait;

use OscarRey\MercadoPago\Entity\{
  Preapproval,
  Plan,
  PaymentMethod,
  OAuth,
  Card,
  IdentificationType,
  MerchantOrder,
  InstoreOrderV2,
  Store,
  InstoreOrderQr,
  AuthorizedPayment,
  Payment,
  Customer,
  Preference,
  POS
};

class MercadoPago
{

   use ConfigTrait; 

  public function __construct()
  {
    $this->initSdk();
  }

  /**
   * función para comprobar el uso del facade a esta clase
   */
  public function hello()
  {

    return 'hello';
  }

  /**
   * Instancia de Payment
   * @return Payment
   */
  public function payment()
  {

    return new Payment();
  }

  /**
   * Instancia de Store
   * @return Store
   */
  public function store()
  {

    return new Store();
  }

  /**
   * Instancia de  AuthorizedPayment
   * @return  AuthorizedPayment
   */
  public function authorizedPayment()
  {

    return new AuthorizedPayment();
  }

  /**
   * Instancia de InstoreOrder
   * @return InstoreOrder
   * @link https://github.com/mercadopago/sdk-php/blob/9ca999e06cc8a875a11f0fcf4dccc75b41d020d5/src/MercadoPago/Entities/InstoreOrder.php
   */
  public function instoreOrder()
  {

    return new InstoreOrder();
  }

  /**
   * Instancia de InstoreOrderQr
   * @return InstoreOrderQr
   * @link https://www.mercadopago.com.co/developers/es/reference/qr-dynamic/_instore_orders_qr_seller_collectors_user_id_pos_external_pos_id_qrs/post
   */
  public function instoreOrderQr()
  {

    return new InstoreOrderQr();
  }

  /**
   * Instancia de InstoreOrderV2
   * @return InstoreOrderV2
   */
  public function instoreOrderV2()
  {

    return new InstoreOrderV2();
  }


  /**
   * Instancia de MerchantOrder
   * @return MerchantOrder
   */
  public function merchantOrder()
  {

    return new MerchantOrder();
  }

  /**
   * Instancia de PaymentMethod
   * @return PaymentMethod
   */
  public function paymentMethod()
  {

    return new PaymentMethod();
  }

  /**
   * Instancia de POS
   * @return POS
   */
  public function pos()
  {

    return new POS();
  }

  /**
   * Instancia de IdentificationType
   * @return IdentificationType
   */
  public function identificationType()
  {

    return new IdentificationType();
  }

  /**
   * Instancia de Payer
   * @return Payer
   */
  public function payer()
  {
    return new Payer();
  }

  /**
   * Instancia de Refund
   * @return Refund
   */
  public function refund()
  {
    return new Refund();
  }

  /**
   * Instancia de Customer
   * @return Customer
   */
  public function customer()
  {
    return new Customer();
  }

  /**
   * Instancia de Card
   * @return Card
   */
  public function card()
  {
    return new Card();
  }


  /**
   * Instancia de Plan
   * @return Plan
   */
  public function plan()
  {
    return new Plan();
  }

  /**
   * Instancia de OAuth
   * @return OAuth
   */
  public function oauth()
  {
    return new OAuth();
  }


  /**
   * Instancia de Preapproval
   * @return Preapproval
   * @link https://github.com/mercadopago/sdk-php/blob/9ca999e06cc8a875a11f0fcf4dccc75b41d020d5/src/MercadoPago/Entities/Preapproval.php
   */
  public function preapproval()
  {
    return new Preapproval();
  }

  /**
   * Instancia de Preference
   * @return Preference
   */
  public function preference()
  {
    return new Preference();
  }

  /**
   * Instancia de Item
   * @return Item
   */
  public function item()
  {
    return new Item();
  }

  /**
   * Instancia de Chargeback 
   * @return Chargeback
   */
  public function chargeback()
  {
    return new Chargeback();
  }

  /**
   * País de localidad de cuenta de mercado pago
   * @return string
   */
  public function getCountryId()
  {
    return SDK::getCountryId();
  }


  /**
   * Eliminar targeta de credito
   * @param string $customer_id
   * @return Card|null
   * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards/get
   */
  public function deleteCard($card_id, $customer_id)
  {
    $card = $this->card()->findById($customer_id);

    if ($card) {
      $card->customer_id = $customer_id;
      $card->id = $card_id;

      $card->delete();
    }

    return $card;
  }


  /**
   *  Crear suscripción
   * @param string|null $back_url url de redirección despues del pago
   * @param string $reason descripción de la suscripción
   * @return Preapproval
   */
  public function createPreapproval($reason, $back_url = null)
  {
    $preapproval = $this->preapproval();
    $preapproval->back_url = $back_url ?? $this->getCallbackUrl();
    $preapproval->reason = $reason;

    return $preapproval;
  }

  /**
   *  Crear plan
   * @param string $back_url url de redirección una vez terminado el pago
   * @param string $description descripcion del plan (reason)
   * @return Plan
   * @link https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_plan/post
   */
  public function createPlan($description, $back_url = null)
  {
    $plan = $this->plan();

    $plan->reason = $description;

    $plan->back_url = $back_url ?? $this->getCallbackUrl();

    return $plan;
  }

  /**
   * Consultar reembolso de un pago por el payment_id
   * @param string $payment_id
   * @return Refund|null
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds/get
   */
  public function refundFindBydId($payment_id)
  {
    $refund = $this->findByIdHandler($this->refund(), $payment_id);

    return $refund;
  }

  /**
   * find by id
   * @param Entity $class
   * @param string $id
   * @return Entity
   */
  public function FindByIdHandler(Entity $class, $id)
  {
    $response = get_class($class);

    $response = $response::find_by_id($id);

    return $response;
  }

  /**
   * Inicializa el sdk de mercado pago
   * @link https://github.com/mercadopago/sdk-php
   */
  public function initSdk()
  {
    SDK::setAccessToken($this->getAccesToken());
  }



  /**
   * Returna la url de authorización de cuenta mercado pago
   * @param string|null $redirect_uri
   * @return string
   */
  public function authorizationURL($redirect_uri = null, $random_id = null)
  {
    return $this->oauth()->customGetAuthorizationURL(
      $this->getAppId(),
      $random_id,
      $redirect_uri ?? $this->getRedirectUri()
    );
  }

 
}
