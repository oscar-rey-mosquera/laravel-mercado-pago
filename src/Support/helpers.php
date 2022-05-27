<?php

use OscarRey\MercadoPago\MercadoPago;
use Illuminate\Contracts\Foundation\Application;

if (!function_exists("cloudinary")) {

    /**
     * @return Application|mixed
     */
    function MercadoPago()
    {
        return app(MercadoPago::class);
    }
}