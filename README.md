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

Una vez haya hecho la instalación puede agregar la variable de entorno MERCADO_PAGO_ACCESS_TOKEN y MERCADO_PAGO_USER_ID en el archivo .env de tu proyecto de laravel  con el valor de tu access token que encontraras en tu [cuenta de desarrollador de mercado pago](https://www.mercadopago.com.co/developers/panel).

```bash
//.env
MERCADO_PAGO_ACCESS_TOKEN=access_token
MERCADO_PAGO_USER_ID=user_id
```

o llama el metodo initSdk y como parametro le pasas tu access_token

```php
MercadoPago()->initSdk($access_token);
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

### Obtener medios de pago disponibles y tipos de documentos

Consulta todos los medios de pago disponibles y obtén un listado con el detalle de cada uno y sus propiedades [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/payment_methods/_payment_methods/get)..

```php
  /**
   * Instancia de PaymentMethod
   * @link https://github.com/oscar-rey-mosquera/laravel-mercado-pago/blob/main/src/Entity/PaymentMethod.php
   */
    MercadoPago()->paymentMethod();

    // Consultar medios de pago disponibles
    MercadoPago()->paymentMethod()->find();

  // Buscar en medios de pago disponibles
    MercadoPago()->paymentMethod()->findV2($filters);

    // Buscar medio de pago de tarjeta 
    $cardType = MercadoPago()->paymentMethod()->findCreditCard('5254133674403564');

    $cardTYpe->issuer // Devuelve una lista de emisores
     
    $paymenMethod->payer_costs // Devuelve todas las cuotas disponibles

    /**
   * Instancia de IdentificationType
   * @link https://www.mercadopago.com.co/developers/es/reference/identification_types/_identification_types/get
   */
    MercadoPago()->identificationType();

    // Consultar tipos de documentos disponibles
    MercadoPago()->identificationType()->find();

     // Buscar en payment 
    
   
```

### ¿Cómo hacer pruebas en modo desarrollo?

Para hacer pruebas con el sdk de mercado pago necesitas crear usuarios de prueba que van a simular roles como vendedores(cuenta de mercado pago con access_token)  o compradores(Un usuario natural que puede o no tener una cuenta de mercado pago normal).[referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/integration-test/test-your-integration).

```php

 /**
   * Crear usuario de prueba para hacer test
   * @link https://www.mercadopago.com.co/developers/es/docs/checkout-api/integration-test/test-user-create
   * 
   * createTestUser($site_id = 'MCO'): array
   */
 $testUser = MercadoPago()->createTestUser();
 
 ```

### Tokenizar tarjeta en el servidor

```php

 /**
   * Nota: si deseas tokenizar la tarjeta de crédito de tus usuarios en tu servidor, recuerda comprometerte a no guardar datos sensibles de las tarjetas 
   */

 /**
   * Instancia de cardToken
   * @link https://github.com/oscar-rey-mosquera/laravel-mercado-pago/blob/main/src/Entity/CardToken.php
   */
  $cardToken = MercadoPago()->cardToken();

  $cardToken->card_number = '5254133674403564';
  $cardToken->expiration_month = '11';
  $cardToken->expiration_year = '2025';
  $cardToken->security_code = '123';
  $cardToken->cardholder = [ // este campo solo es obligatorio cuando hagas test, ya que de no ponerle un estado esperado mercado pago te arrojara un error cuando trates de generar un pago vía tarjeta
            'name' => 'APRO'
          ];

  $cardToken->save();

  $cardToken->id // token de targeta

  // o utiliza el método create para mandar un array

  $cardToken =  MercadoPago()->cardToken()->create(
     'card_number' => '5254133674403564',
     'expiration_month' => '11',
     'expiration_year' => '2025',
     'security_code' => '123',
     'cardholder' => [
        'name' => 'APRO'
     ]);

   $cardToken // resultado

 
 ```

### Integra Checkout API para pagos con tarjetas

La integración del Checkout API de Mercado Pago para tarjetas permite que puedas ofrecer una opción de pagos completa dentro de tu sitio [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/receiving-payment-by-card).

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

Con el Checkout API de Mercado Pago puedes sumar otras alternativas de medios de pago para ofrecer a tus clientes a la hora de realizar el pago [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/payment-methods/other-payment-methods).

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

Usa nuestras APIs para guardar la referencia de las tarjetas de tus clientes y poder brindarles una mejor experiencia. De esta manera, tus clientes no tienen que completar sus datos cada vez y pueden finalizar sus pagos más rápido. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/advanced-integration/remember-customers-and-cards#editor_1).

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

Cancelaciones ocurren cuando se realiza una compra pero el pago aún no ha sido aprobado por algún motivo. En este caso, considerando que la transacción no fue procesada y el establecimiento no recibió ningún monto, la compra se cancela y no hay cargo. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/additional-content/cancellations-and-refunds).

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
   * Obtener lista de reembolsos
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds/get
   * 
   *  find($payment_id)
   */
 $reembolso = MercadoPago()->refund()->find($payment_id);

 dd($reembolso) // resultado

  /**
   * Obtener reembolso específico
   * @link https://www.mercadopago.com.co/developers/es/reference/chargebacks/_payments_id_refunds_refund_id/get
   * 
   *  findById($payment_id, $refund_id)
   */
 $reembolso = MercadoPago()->refund()->findById($payment_id, $refund_id);

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

Para integrarlo, tienes que generar la preferencia de pago con la información del producto o servicio que quieras ofrecer y agregar la opción de pago en tu sitio. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-api/wallet-integration/wallet-addto-website).

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
[referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/docs/checkout-pro/how-tos/integrate-marketplace).

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

### Crear orden

Genera una orden para asociarla a la preferencia de pago y obtén la URL necesaria para iniciar el flujo de pago. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/merchant_orders/_merchant_orders/post).

```php
/**
 * Instacia de MerchantOrder
 * @link https://www.mercadopago.com.co/developers/es/reference/merchant_orders/_merchant_orders/post
 */
 $orden = MercadoPago()->merchantOrder();

 /**
  * Nota: Para crear una orden solo tienes que llenar los campos de la instancia y luego ejecutar save() metodo
  */

 /**
 * Buscar en órdenes
 * @link https://www.mercadopago.com.co/developers/es/reference/merchant_orders/_merchant_orders_search/get
 * 
 * find(array $filter);
 */
 $orden = MercadoPago()->merchantOrder()->find();

  /**
 * Obtener una orden
 * @link https://www.mercadopago.com.co/developers/es/reference/merchant_orders/_merchant_orders_id/get
 * 
 */
 $orden = MercadoPago()->merchantOrder()->findById($orden_id);

  /**
  * Nota: Para actualizar utiliza primero el método findById de la instancia
merchantOrder reemplaza los campos a actualizar y luego ejecuta el método update() de la instancia
  */

 ```

### Crear preferencia

Genera una preferencia con la información de un producto o servicio y obtén la URL necesaria para iniciar el flujo de pago. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/preferences/_checkout_preferences/post).

```php
/**
 * Instacia de Preference
 * @link https://www.mercadopago.com.co/developers/es/reference/preferences/_checkout_preferences/post
 */
 $preference = MercadoPago()->preference();

 /**
  * Nota: Para crear una preferencia solo tienes que llenar los campos de la instancia y luego ejecutar save() metodo
  */

 /**
 * Buscar en preferencias
 * @link https://www.mercadopago.com.co/developers/es/reference/preferences/_checkout_preferences_search/get
 * 
 * find(array $filter);
 */
 $preferences = MercadoPago()->preference()->find();

  /**
 * Obtener una preferencia
 * @link https://www.mercadopago.com.co/developers/es/reference/preferences/_checkout_preferences_id/get
 * 
 */
 $preference = MercadoPago()->preference()->findById($preference_id);

  /**
  * Nota: Para actualizar utiliza primero el método findById de la instancia
preference reemplaza los campos a actualizar y luego ejecuta el método update() de la instancia
  */
 ```

### Crear caja

Genera un punto de venta en una sucursal. Cada caja tendrá vinculado un código QR unívoco. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/pos/_pos/post).

```php
/**
 * Instacia de POS
 * @link https://www.mercadopago.com.co/developers/es/reference/pos/_pos/post
 */
 $caja = MercadoPago()->pos();

/** 
 * Nota: Para crear una caja solo tienes que llenar los campos de la instancia y luego ejecutar save() metodo
*/

 /**
 * Buscar en cajas
 * @link https://www.mercadopago.com.co/developers/es/reference/pos/_pos/get
 * 
 * find(array $filter);
 */
 $caja = MercadoPago()->pos()->find();

  /**
 * Obtener caja
 * @link https://www.mercadopago.com.co/developers/es/reference/pos/_pos_id/gets/get
 * 
 */
 $caja = MercadoPago()->pos()->findById($pos_id);

 /**
  * Nota: Para actualizar utiliza primero el método findById de la instancia
preference reemplaza los campos a actualizar y luego ejecuta el método update() de la instancia
  */

/**
 * Eliminar caja
 * @link https://www.mercadopago.com.co/developers/es/reference/pos/_pos_id/delete
 * 
 */
 $caja = MercadoPago()->pos()->deleteV2($pos_id);
 

 ```

### Crear orden

Genera una orden de pago asociada a la caja que quieras con toda la información de pago de tu producto o servicio. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/instore_orders/_mpmobile_instore_qr_user_id_external_id/post).

```php
/**
 * Instacia de in store order
 * @link https://www.mercadopago.com.co/developers/es/reference/instore_orders/_mpmobile_instore_qr_user_id_external_id/post
 */
 $instoreOrder = MercadoPago()->instoreOrder();

 /** 
 * Nota: Para crear una orden en la caja solo tienes que llenar los campos de la instancia y luego ejecutar save() metodo
*/

/**
 * Obtener orden
 * @link https://www.mercadopago.com.co/developers/es/reference/instore_orders_v2/_instore_qr_seller_collectors_user_id_pos_external_pos_id_orders/get
 * 
 * findById($user_id, $external_pos_id)
 */
 $instoreOrder = MercadoPago()->instoreOrderV2()->findById($user_id, $external_pos_id);

 /**
 * Eliminar orden
 * @link https://www.mercadopago.com.co/developers/es/reference/instore_orders_v2/_instore_qr_seller_collectors_user_id_pos_external_pos_id_orders/delete
 * 
 * deleteV2($user_id, $external_pos_id)
 */
 $instoreOrder = MercadoPago()->instoreOrderV2()->deleteV2($user_id, $external_pos_id);

 ```

### Crear sucursal

Genera una tienda física en la que los clientes pueden adquirir los productos o servicios. Puedes crear más de una sucursal por cuenta.
[referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores/post).

```php
/**
 * Instacia de store
 * @link https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores/post
 */
 $instoreOrder = MercadoPago()->store();

//create($data = [], $user_id = null)
$instoreOrder = MercadoPago()->store()->create([
'name' => 'test store',
'location' => [
'city_name' => 'Quibdó',
'state_name' => 'Choco',
'latitude' => -32.8897322,
'longitude' => -68.8443275,
'street_name' => "Los rosales"
 ]
]);

//Buscar en sucursales
// @url https://www.mercadopago.com.co/developers/es/reference/stores/_users_user_id_stores_search/get
// find($filter = [], $user_id = null)
$stores = MercadoPago()->store()->find();

//Obtener sucursal
// @url https://www.mercadopago.com.co/developers/es/reference/stores/_stores_id/get

$stores = MercadoPago()->store()->findById($store_id);

//Eliminar sucursal
// @url https://www.mercadopago.com.co/developers/es/reference/stores/_stores_id/get
// deleteV2($store_id, $user_id = null)
$stores = MercadoPago()->store()->deleteV2($store_id);

//Actualizar sucursal
// @url https://www.mercadopago.com.co/developers/es/reference/stores/_stores_id/get
// updateV2($store_id , $data = [], $user_id = null)
$stores = MercadoPago()->store()->updateV2($store_id, 
[
'name' => 'test store',
'location' => [
'city_name' => 'Quibdó',
'state_name' => 'Choco',
'latitude' => -32.8897322,
'longitude' => -68.8443275,
'street_name' => "Los rosales"
]
]);

 ```

### Create a QR tramma

Genera un tramma QR que se agregará a una imagen. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/qr-dynamic/_instore_orders_qr_seller_collectors_user_id_pos_external_pos_id_qrs/post).

```php
/**
 * Instacia de InstoreOrderQr
 * @link https://www.mercadopago.com.co/developers/es/reference/qr-dynamic/_instore_orders_qr_seller_collectors_user_id_pos_external_pos_id_qrs/post
 */
 $instoreOrderQr = MercadoPago()->instoreOrderQr();

//create($external_pos_id, $data = [],$user_id = null)
$instoreOrderQr = MercadoPago()->instoreOrderQr()->create(8787, [
  "descripción" => "example descripción"
]);

 ```

### Crear suscripción

Una suscripción es la unión entre un plan y un cliente. La principal característica de este contrato es que tiene configurada una forma de pago y es la base para la creación de las facturas. También puedes crear una suscripción sin un plan. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval/post).

```php
/**
 * Instacia de preapproval
 * @link https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval/post
 */
 $preapproval = MercadoPago()->preapproval();

//createPreapproval($reason, $back_url = null)
$preapproval = MercadoPago()->createPreapproval('Premium');

$preapproval->preapproval_plan_id = "2c938084726fca480172750000000000";

$preapproval->save();

dd($preapproval) /resultado


//Buscar en suscripciones
// @url https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_search/get
//
$preapproval = MercadoPago()->preapproval()->find();

//Obtener suscripción
// @url https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_id/get
//
$preapproval = MercadoPago()->preapproval()->findById($preapproval_id);

  /**
  * Nota: Para actualizar utiliza primero el método findById de la instancia
preapproval reemplaza los campos a actualizar y luego ejecuta el método update() de la instancia
  */
 ```

### Crear un plan de suscripción

Un plan es un template para crear suscripciones que indican con qué frecuencia y cuánto cobrar a tus clientes. Se pueden crear planes con pruebas gratuitas, ciclos de facturación y más. Las suscripciones creadas a partir de un plan están relacionadas con el mismo y permiten sincronizar modificaciones como reason o amount. [referencia a la documentación oficial del sdk](https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_plan/post).

```php
/**
 * Instacia de plan
 * @link https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_plan/post
 */
 $plan = MercadoPago()->plan();

//createPlan($description, $back_url = null)
$plan = MercadoPago()->createPlan('Premium');

$plan->save();

dd($plan) /resultado


//Buscar en planes de suscripción
// @url https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_plan_search/get
//
$plan = MercadoPago()->plan()->find();

//Obtener un plan de suscripción
// @url https://www.mercadopago.com.co/developers/es/reference/subscriptions/_preapproval_plan_id/get
//
$plan = MercadoPago()->plan()->findById($plan_id);

  /**
  * Nota: Para actualizar utiliza primero el método findById de la instancia
plan reemplaza los campos a actualizar y luego ejecuta el método update() de la instancia
  */
  
 ```

## Contribución

Puedes contribuir agregando nuevas funcionalidades, actualizaciones,  refactorización de código y notificando errores, con antelación se agradece.

## License

[MIT license](LICENSE).
