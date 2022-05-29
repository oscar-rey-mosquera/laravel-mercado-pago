<?php

return [
   /** 
    * token de tu aplicación
    * https://www.mercadopago.com.co/developers/panel/credentials
    */
   'access_token' => env('MERCADO_PAGO_ACCESS_TOKEN'),
   /**
    * URL donde será redirigido una vez un usuario termine un pago
    */
   'callback_url' => 'http://www.tu-sitio.com',
   /** 
    * Requerido para marketplace
    * https://www.mercadopago.com.co/developers/panel
    */
   'app_id' => env('MERCADO_PAGO_APP_ID'),

   /** 
    * Requerido para marketplace
    * URL donde será redirigido una vez un usuario haya dado permisos sobre su cuenta de mercado pago    */
   'redirect_uri' => 'http://www.tu-sitio.com/callback'
];
