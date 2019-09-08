<?php

require_once('config.php');

$authUrl = $client->createAuthUrl();

header('location:'.$authUrl);