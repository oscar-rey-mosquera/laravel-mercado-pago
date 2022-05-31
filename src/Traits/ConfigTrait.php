<?php
namespace OscarRey\MercadoPago\Traits;


trait ConfigTrait  
{

    public $api_version = '/v1';
 
    /**
     * Retorna token de la configuración
     */
    public function getAccesToken() {

        return config('mercado-pago.access_token');
    }

    /**
     * Retorna callback_url de la configuración
     */
    public function getCallbackUrl() {

        return config('mercado-pago.callback_url');
    }

     /**
     * Retorna app_id de la configuración
     */
    public function getAppId() {

        return config('mercado-pago.app_id');
    }

      /**
     * Retorna redirect_uri de la configuración
     */
    public function getRedirectUri() {

        return config('mercado-pago.redirect_uri');
    }
}