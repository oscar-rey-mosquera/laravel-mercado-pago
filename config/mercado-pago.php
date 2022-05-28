<?php

return [
   /** 
    * token de tu aplicación
    * https://www.mercadopago.com.co/developers/panel/credentials
    */
   'access_token' => env('MERCADO_PAGO_ACCESS_TOKEN'),
   /**
    * URL donde serás redirigido una vez un usuario termine un pago
    */
   'callback_url' => 'http://www.tu-sitio.com'
];
