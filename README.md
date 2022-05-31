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
   * createTestUser($site_id = 'MCO')
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


## Contribución

Puedes contribuir agregando nuevas funcionalidades, actualizaciones,  refactorización de código y notificando errores, con antelación se agradece.

## License

[MIT license](LICENSE).
