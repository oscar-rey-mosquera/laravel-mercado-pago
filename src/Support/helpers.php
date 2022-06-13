<?php

use LaravelMercadoPago\MercadoPago;

if (!function_exists("MercadoPago")) {

    /**
     * @return MercadoPago
     */
    function MercadoPago()
    {
        return app(MercadoPago::class);
    }
}