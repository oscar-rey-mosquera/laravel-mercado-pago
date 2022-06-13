<?php
namespace LaravelMercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\Refund as MercadoPagoRefund;
use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class Refund extends MercadoPagoRefund implements ClassToJson
{
   use EntityTrait;



  /**
   * Obtener lista de reembolsos
   * @param string $payment_id
   * @return Refund|null
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds/get
   * @throws \Exception
   */
  public function find($payment_id)
  {
    $refund = SDK::get("/v1/payments/{$payment_id}/refunds");

    return $this->findhandlerResponse($refund);
  }

    /**
   * Obtener reembolso específico
   * @param string $payment_id
   * @param string $refund_id
   * @return Refund|null
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds_refund_id/get
   * @throws \Exception
   */
  public function findById($payment_id, $refund_id)
  {
    $refund = SDK::get("/v1/payments/{$payment_id}/refunds/{$refund_id}");

    return $this->findByIdhandlerResponse($refund);
  }
  
}