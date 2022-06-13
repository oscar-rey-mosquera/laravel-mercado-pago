<?php

use LaravelMercadoPago\MercadoPago;

if (!function_exists("cloudinary")) {

    /**
     * @return MercadoPago
     */
    function MercadoPago()
    {
        return app(MercadoPago::class);
    }
}