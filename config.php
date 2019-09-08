<?php

require_once 'google-api-php-client/vendor/autoload.php';
//require_once 'client.json';

session_start();

$client = new Google_Client();

$client->setApplicationName("Login with Google Account using PHP");

$client->setClientId('886382328767-bgh2zxcvxzcvsl30ep4l2qj2k350n110.apps.googleusercontent.com');
$client->setClientSecret('SSD-eYzxcvxzcv8liSyvOaMa');
$client->setRedirectUri('http://localhost:8888/oauthgooglephp/redirect.php');

//$client->setAuthConfig("client.json");

$client->addScope([Google_Service_Oauth2::PLUS_LOGIN,Google_Service_Oauth2::USERINFO_EMAIL]);

$client->setRedirectUri("http://localhost:8888/oauthgooglephp/redirect.php");