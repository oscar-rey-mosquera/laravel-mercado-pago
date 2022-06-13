<?php

namespace LaravelMercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\OAuth as MercadoPagoOAuth;
use LaravelMercadoPago\Traits\EntityTrait;
use LaravelMercadoPago\Interfaces\ClassToJson;


class OAuth extends MercadoPagoOAuth implements ClassToJson
{
  use EntityTrait;

  /**
   * getAuthorizationURL
   * @param $app_id
   * @param $redirect_uri
   * @return string
   */
  public function customGetAuthorizationURL($app_id, $random_id, $redirect_uri)
  {
    $county_id = strtolower(SDK::getCountryId());
    $random_id = $random_id ?? 'RANDOM_ID';
    return "https://auth.mercadopago.com.{$county_id}/authorization?client_id={$app_id}&response_type=code&platform_id=mp&state={$random_id}&redirect_uri={$redirect_uri}";
  }

  /**
   * Returna la url de authorización de cuenta mercado pago
   * @param string|null $redirect_uri
   * @return string
   */
  public function authorizationURL($random_id, $redirect_uri = null)
  {
    return $this->customGetAuthorizationURL(
      $this->getAppId(),
      $random_id,
      $redirect_uri ?? $this->getRedirectUri()
    );
  }


  /**
   * oauthCredentials
   * @param $authorization_code
   * @param $redirect_uri
   * @return bool|mixed
   * @throws \Exception
   */
  public function oauthCredentials($authorization_code, $redirect_uri = null)
  {
    return $this->getOAuthCredentials(
      $authorization_code,
      $redirect_uri ?? $this->getRedirectUri()
    );
  }
  
}
