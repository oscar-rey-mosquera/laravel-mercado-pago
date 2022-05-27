<?php
namespace OscarRey\MercadoPago;

class MercadoPagoConfig  
{
 
    public function getAccesToken() {

        return config('mercado-pago.access_token');
    }
}