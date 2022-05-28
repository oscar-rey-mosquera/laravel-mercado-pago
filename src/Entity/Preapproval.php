<?php
namespace OscarRey\MercadoPago\Entity;

use MercadoPago\RecuperableError;
use MercadoPago\Preapproval as MercadoPagoPreapproval;

class Preapproval extends MercadoPagoPreapproval
{
   
   public function process_error_body($message){
        $recuperable_error = new RecuperableError(
            $message['message'],
            $message['error'] ?? null,
            $message['status']
        );

        if(isset($message['cause']))
            $recuperable_error->proccess_causes($message['cause']);
        
        $this->error = $recuperable_error;
    }
}