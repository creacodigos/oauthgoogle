# oauthgoogle
## oauth

https://cloud.google.com/php/getting-started/authenticate-users

https://codingshiksha.com/login-with-google-account-using-php

https://www.codexworld.com/login-with-google-api-using-php/

# Iniciar Sesión con Google Api

google-api-php-client 2.2.2 -> https://github.com/googleapis/google-api-php-client/releases/tag/v2.2.2

## Nuevo Proyecto Google Developers Console

https://console.developers.google.com

Accedemos a `Google Developers Console` y en el `Panel de Control` pulsamos sobre Seleccionar `proyect` > + `Nuevo Proyecto` y creamos un nuevo proyecto con el nombre deseado.

Seleccionamos el proyecto recién creado y vamos a `Credenciales` > `Crear credenciales` > `ID de cliente de OAuth`.

En el tipo de aplicación seleccionamos `Web application`.

Si es neceario, rellenaremos los datos de autoría.

Definiremos el `URIs de refirección autorizados` con http://localhost:8888/oauthgooglephp/redirect.php (podemos definir tantas URLs como queramos)


## Descarga de la librería php OAuth Client v 2.2.2 
https://github.com/googleapis/google-api-php-client/releases/tag/v2.2.2 versión `PHP54`

Extraemos el contenido en la raíz del proyecto y lo incluimos en la carpeta `google-api-php-client`.

### index.php

```php
<?php

require_once('config.php');

$authUrl = $client->createAuthUrl();

header('location:'.$authUrl);
```

### config.php
```php
<?php

require_once 'google-api-php-client/vendor/autoload.php';
//require_once 'client.json';

session_start();

$client = new Google_Client();

$client->setApplicationName("Login with Google Account using PHP");

$client->setClientId('CLIENTID.apps.googleusercontent.com');
$client->setClientSecret('SSD-SECRET');
$client->setRedirectUri('http://localhost:8888/oauthgooglephp/redirect.php');

//$client->setAuthConfig("client.json");

$client->addScope([Google_Service_Oauth2::PLUS_LOGIN,Google_Service_Oauth2::USERINFO_EMAIL]);

$client->setRedirectUri("http://localhost:8888/oauthgooglephp/redirect.php");
```

### redirect.php

```php
<?php

require_once("config.php");

if(isset($_SESSION['accessToken']))
{
    $client->setAccessToken($_SESSION['accessToken']);
}
else if(isset($_GET['code']))
{
    $access_token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['accessToken'] = $access_token;
}
else{
    header('location : index.php');
}

$oauth = new Google_Service_Oauth2($client);

$user = $oauth->userinfo->get();

$picture_link = $user->picture;

echo '<br><img width="200" height="200" src="'.$picture_link.'">';

echo '<br>';

echo "<h2>".$user->name."</h2>";
echo "<h2>".$user->email."</h2>";

echo '<pre>$_SESSION: ';
print_r($_SESSION);
echo '</pre>';

echo '<pre>$user: ';
print_r($user);
echo '</pre>';

echo "<a href='logout.php'>Logout</a>";

```

### logout.php
```php
<?php

session_start();

unset($_SESSION);

session_destroy();

echo "<a href='index.php'>Volver al inicio index.php</a>";
```