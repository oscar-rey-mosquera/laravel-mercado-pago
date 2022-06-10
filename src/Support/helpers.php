<?php

use OscarRey\MercadoPago\MercadoPago;

if (!function_exists("cloudinary")) {

    /**
     * @return MercadoPago
     */
    function MercadoPago()
    {
        return app(MercadoPago::class);
    }
}