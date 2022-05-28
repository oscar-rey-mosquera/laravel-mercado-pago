<?php
namespace OscarRey\MercadoPago;

class MercadoPagoConfig  
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
}