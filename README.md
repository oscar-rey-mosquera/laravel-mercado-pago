<p align="center">
  <img src="https://ps.w.org/woocommerce-mercadopago/assets/icon-256x256.png?rev=2653727" alt="Logo Laravel Cashier Stripe" width="170px">
</p>

<p align="center">
<a href="https://packagist.org/packages/oscar-rey/laravel-mercado-pago"><img src="https://img.shields.io/packagist/dt/oscar-rey/laravel-mercado-pago" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/oscar-rey/laravel-mercado-pago"><img src="https://img.shields.io/packagist/v/oscar-rey/laravel-mercado-pago" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/oscar-rey/laravel-mercado-pago"><img src="https://img.shields.io/packagist/l/oscar-rey/laravel-mercado-pago" alt="License"></a>
</p>

## Introducción
Laravel mercado pago es un paquete que te ayuda a implementar el [sdk](https://github.com/mercadopago/sdk-php) de mercado pago para php en laravel.

## 💻 Instalación 

Para instalar utiliza composer.

```.bash
composer require oscar-rey/laravel-mercado-pago
```
## Configuración 

Una vez haya hecho la instalación puede agregar la variable de entorno MERCADO_PAGO_ACCESS_TOKEN en el archivo .env de tu proyecto de laravel  con el valor de tu access token que encontraras en tu [cuenta de desarrollador de mercado pago](https://www.mercadopago.com.co/developers/panel).
```bash
//.env
MERCADO_PAGO_ACCESS_TOKEN=access_token
```
## Publica archivo de configuración 

Publica el archivo de configuración ejecutando php artisan vendor:publish y selecciona el número que tiene como tag mercado-pago.

## Uso del paquete

Accede a la funcionalidad del paquete : 
```php
use OscarRey\MercadoPago\MercadoPago;
use OscarRey\MercadoPago\Facades\MercadoPago;

//Helper global
MercadoPago()->hello();

//MercadoPago facade
MercadoPago::hello();

//MercadoPago class
(new MercadoPago())->hello();

```

### Obtener medios de pago disponibles.

Consulta todos los medios de pago disponibles y obtén un listado con el detalle de cada uno y sus propiedades [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/reference/payment_methods/_payment_methods/get).. 
```php
  /**
   * Instancia de PaymentMethod
   * @link https://github.com/oscar-rey-mosquera/laravel-mercado-pago/blob/main/src/Entity/PaymentMethod.php
   */
    MercadoPago()->paymentMethod();
    
   
```

### Integra Checkout API para pagos con tarjetas

La integración del Checkout API de Mercado Pago para tarjetas permite que puedas ofrecer una opción de pagos completa dentro de tu sitio [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/receiving-payment-by-card).
```php

 /**
   * Instancia de Payment
   * @link https://www.mercadopago.com.co/developers/es/reference/payments/_payments/post
   */
 $payment = MercadoPago()->payment();
 
$payment->transaction_amount = (float)$_POST['transactionAmount'];
$payment->token = $_POST['token'];
$payment->description = $_POST['description'];
$payment->installments = (int)$_POST['installments'];
$payment->payment_method_id = $_POST['paymentMethodId'];
$payment->issuer_id = (int)$_POST['issuer'];

$payment->payer = array(
    "email" => "test_user_19549678@testuser.com"
  );

 $payment->save();
 
 //En la instacia se guarda la respuesta de la api de mercado pago
 dd($payment);
 ```

## Contribución

Puedes contribuir agregando nuevas funcionalidades, actualizaciones,  refactorización de código y notificando errores, con antelación se agradece.

## License

[MIT license](LICENSE).
