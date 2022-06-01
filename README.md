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
## 🔧 Configuración 

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

### Obtener medios de pago disponibles y tipos de documentos.

Consulta todos los medios de pago disponibles y obtén un listado con el detalle de cada uno y sus propiedades [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/reference/payment_methods/_payment_methods/get).. 
```php
  /**
   * Instancia de PaymentMethod
   * @link https://github.com/oscar-rey-mosquera/laravel-mercado-pago/blob/main/src/Entity/PaymentMethod.php
   */
    MercadoPago()->paymentMethod();

    // Consultar medios de pago disponibles
    MercadoPago()->paymentMethod()->find();

    /**
   * Instancia de IdentificationType
   * @link https://www.mercadopago.com.co/developers/es/reference/identification_types/_identification_types/get
   */
    MercadoPago()->identificationType();

    // Consultar tipos de documentos disponibles
    MercadoPago()->identificationType()->find();
    
   
```

  ### ¿Cómo hacer pruebas en modo desarrollo?

Para hacer pruebas con el sdk de mercado pago necesitas crear usuarios de prueba que van a simular roles como vendedores(cuenta de mercado pago con access_token)  o compradores(Un usuario natural que puede o no tener una cuenta de mercado pago normal).[referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/integration-test/test-your-integration).
```php

 /**
   * Crear usuario de prueba para hacer test
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/integration-test/test-user-create
   * 
   * createTestUser($site_id = 'MCO'): array
   */
 $testUser = MercadoPago()->createTestUser();
 
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

 ### Integra otros medios de pago

Con el Checkout API de Mercado Pago puedes sumar otras alternativas de medios de pago para ofrecer a tus clientes a la hora de realizar el pago [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/other-payment-methods).
```php

 /**
   * Instancia de Payment con opción efecty
   * @link https://www.mercadopago.com.co/developers/es/reference/payments/_payments/post
   * 
   * efecty($amount, $notification_url = null,  $url_callback = null)
   */
 $efecty = MercadoPago()->payment()->efecty(5000);
 $efecty->description = "Título del producto";
 $efecty->payer = array(
    "email" => "test_user_19549678@testuser.com"
  );

 $efecty->save();

 dd($efecty); //resultado

 /**
   * Instancia de Payment con opción pse
   * @link https://www.mercadopago.com.co/developers/es/reference/payments/_payments/post
   * 
   * pse($amount, $notification_url = null, $url_callback = null)
   */
  $pse = MercadoPago()->payment()->pse(5000);
  //etc..


   /**
   * Consultar lista de pagos
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/additional-content/retrieving-payments
   *
   */
  $pagos = MercadoPago()->payment()->find();

  /**
   * Buscar un pago
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/additional-content/retrieving-payments
   *
   */
  $pagos = MercadoPago()->payment()->findById($id);
 
 ```

### Recuerda tus clientes y sus tarjetas

Usa nuestras APIs para guardar la referencia de las tarjetas de tus clientes y poder brindarles una mejor experiencia. De esta manera, tus clientes no tienen que completar sus datos cada vez y pueden finalizar sus pagos más rápido. [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/advanced-integration/remember-customers-and-cards#editor_1).
```php
 /**
   * Instancia de Customer
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers/post
   * 
   */
  $customer = MercadoPago()->customer();
  $customer->email = "test_payer_12345@testuser.com";
  $customer->save();

  dd($customer) //resultado

   /**
   * forma corta de crear un cliente con solo el email
   * createWithEmail($email)
   */
  $customer = MercadoPago()->customer()->createWithEmail("test_payer_12345@testuser.com");

  /**
   * Buscar un cliente ya existente
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers_id/get
   */
  $customer = MercadoPago()->customer()->findById($customer_id);

    /**
   * Actualizar cliente
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers_id/put
   */
  $customer = MercadoPago()->customer()->findById($customer_id);
  $customer->phone = '3215648956';
  $customer->update();
  dd($customer) // resultado
  
  /**
   * Consultar lista de clientes
   * @link https://www.mercadopago.com.co/developers/es/reference/customers/_customers_search/get
   * find(array $filter)
   */
  $customer = MercadoPago()->customer()->find();

 /**
   * Instancia de card
   * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards/post
   * 
   */
  $card = MercadoPago()->card();
 $card->token = "9b2d63e00d66a8c721607214cedaecda"; // token generado del lado del cliente en la intención de pago
  $card->customer_id = $customer->id(); // cliente creado anteriormente
  $card->issuer = array("id" => "3245612");
  $card->payment_method = array("id" => "debit_card");
  $card->save();

  dd($card) //resultado

  /**
   * Consultar tarjeta creada
   * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards_id/get
   * 
   */
  $customer = MercadoPago()->card()->findById($customer_id, $id);
  

    /**
   * Eliminar tarjeta
   * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards_id/delete
   * 
   */
  $customer = MercadoPago()->card()->deleteV2($customer_id, $id);

/** Nota : para actualizar busca la tarjeta con el método findById($customer_id, $id) modifica y luego ejecuta el método update() con la instancia activa y listo.
 * @link https://www.mercadopago.com.co/developers/es/reference/cards/_customers_customer_id_cards_id/put
 */
 
 ```

 ### Reembolsos y cancelaciones

Reembolsos son transacciones que se realizan cuando un determinado cargo se revierte y las cantidades pagadas se devuelven al comprador. Esto significa que el cliente recibirá en su cuenta o en el extracto de su tarjeta de crédito el monto pagado por la compra de un determinado producto o servicio.

Cancelaciones ocurren cuando se realiza una compra pero el pago aún no ha sido aprobado por algún motivo. En este caso, considerando que la transacción no fue procesada y el establecimiento no recibió ningún monto, la compra se cancela y no hay cargo. [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/additional-content/cancellations-and-refunds).

```php

 /**
   * Hacer un reembolso de un pago
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds/post
   * 
   *  refundV2($payment_id, $amount = 0)
   */
 $reembolso = MercadoPago()->payment()->refundV2($payment_id, $amount = 0);

 dd($reembolso) // resultado

  /**
   * Cancelar una intención de pago
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_payment_id/put
   * 
   *  cancelled($payment_id)
   */
 $cancelled = MercadoPago()->payment()->cancelled($payment_id);

 dd($cancelled) // resultado

 ```

### Cómo sumar la billetera en tu sitio

Necesitas integrar Checkout Pro configurado como modo billetera para agregar la billetera de Mercado Pago en tu sitio.

Para integrarlo, tienes que generar la preferencia de pago con la información del producto o servicio que quieras ofrecer y agregar la opción de pago en tu sitio. [referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-api/wallet-integration/wallet-addto-website).

```php

// Crea un objeto de preferencia
$preference = MercadoPago()->preference()->wallet();

// Crea un ítem en la preferencia
$item = MercadoPago()->item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75;
$preference->items = array($item);
$preference->save();

dd($preference) // resultado

/** Nota : Sigue los siguientes pasos en la documentación oficial del sdk.
 * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/wallet-integration/wallet-addto-website
 */
 ```

### Integración de un marketplace
Marketplace es un sitio/plataforma de comercio electrónico que conecta a vendedores y compradores en un mismo entorno de ventas, permitiendo la venta de productos y/o servicios online con mayor alcance y posibilidad de conversión.
[referencia a la documentación oficial del sdk ](https://www.mercadopago.com.co/developers/es/docs/checkout-pro/how-tos/integrate-marketplace).

```php
// paso 1 - genera la url y redirige al vendedor que quiera asocial su cuenta de mercado pago con tun aplicación.
// @url https://www.mercadopago.com.co/developers/es/docs/checkout-pro/additional-content/security/oauth/creation

// authorizationURL($random_id, $redirect_uri = null)
MercadoPago()->oauth()->authorizationURL($random_id );


 // paso 2 - Obten el authorization_code de la redirección de mercado pago para obtener las credenciales del vendedor.
// @url https://www.mercadopago.com.co/developers/es/docs/checkout-pro/additional-content/security/oauth/renewal

// oauthCredentials($authorization_code, $redirect_uri = null)
MercadoPago()->oauth()->oauthCredentials($authorization_code);

/**
 * Renovación
 * El flujo refresh_token se usa para intercambiar un temporal grant de tipo refresh_token por un access token cuando el token de acceso en uso ha caducado. El access token recibido a través del endpoint es válido durante 180 días, luego de lo cual se debe reconfigurar todo el flujo de autorización.
 * @link https://www.mercadopago.com.co/developers/es/docs/checkout-pro/additional-content/security/oauth/renewal
 * 
 * refreshOAuthCredentials($refresh_token)
 */
 MercadoPago()->oauth()->refreshOAuthCredentials($refresh_token);
 ```

## Contribución

Puedes contribuir agregando nuevas funcionalidades, actualizaciones,  refactorización de código y notificando errores, con antelación se agradece.

## License

[MIT license](LICENSE).
