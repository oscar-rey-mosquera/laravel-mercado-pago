<?php
namespace OscarRey\MercadoPago\Traits;

use MercadoPago\RecuperableError;

trait EntityTrait {

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