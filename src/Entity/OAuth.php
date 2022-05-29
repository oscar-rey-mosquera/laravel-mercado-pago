<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\SDK;
use MercadoPago\OAuth as MercadoPagoOAuth;
use OscarRey\MercadoPago\Traits\EntityTrait;


class OAuth extends MercadoPagoOAuth
{
   use EntityTrait;

    /**
     * getAuthorizationURL
     * @param $app_id
     * @param $redirect_uri
     * @return string
     */
    public function customGetAuthorizationURL($app_id, $random_id, $redirect_uri){
        $county_id = strtolower(SDK::getCountryId());
        $random_id = $random_id ?? 'RANDOM_ID';
        return "https://auth.mercadopago.com.{$county_id}/authorization?client_id={$app_id}&response_type=code&platform_id=mp&state={$random_id}&redirect_uri={$redirect_uri}";
    }
   
  
}