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