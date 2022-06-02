<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
use OscarRey\MercadoPago\Traits\EntityTrait;
use MercadoPago\Payment as MercadoPagoPayment;
use OscarRey\MercadoPago\Interfaces\ClassToJson;


class Payment extends MercadoPagoPayment implements ClassToJson
{
   use EntityTrait;


      /**
   * Reembolsar un pago
   * 
   * @param string $id
   * @return Payment|null
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/additional-content/cancellations-and-refunds
   */
  public function refundV2($id, $amount = 0)
  {
    $payment = $this->findById($id);

    if($payment) {
        
        $payment->refund($amount);
    }

    return $payment;
  }


   /**
   * Crear un pago por efecty
   * @param int $amount
   * @param string|null $url_callback
   * @param string|null $notification_url
   * @return Payment
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/other-payment-methods
   */
  public function efecty($amount, $notification_url = null,  $url_callback = null)
  {
    return  $this->paymentHandler('efecty', $amount, $notification_url, $url_callback);
  }

  /**
   * Crear un pago por efecty
   * @param int $amount
   * @param string|null $url_callback
   * @param string|null $notification_url
   * @return Payment
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/other-payment-methods
   */
  public function pse($amount, $notification_url = null, $url_callback = null)
  {
    return  $this->paymentHandler('pse', $amount, $notification_url, $url_callback);
  }

  /**
   * Manejador de payment
   * @param int $amount
   * @param string|null $url_callback
   * @param string $payment_type
   * @param string|null $notification_url
   * @return Payment
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/other-payment-methods
   */
  public function paymentHandler($payment_type, $amount, $notification_url = null, $url_callback = null)
  {
    $payment = $this;
    $payment->payment_method_id = $payment_type;
    $payment->transaction_amount = $amount;
    $payment->notification_url = $notification_url;
    $payment->callback_url = $url_callback ?? $this->getCallbackUrl();
    return $payment;
  }

  
  
}