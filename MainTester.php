<?php

include('OpenApi.php');

$app_id = 3;
$app_secret = '4e7bb763ad142f577fe84deb79afb455';
$openid = '8Fdd6ZtzAqujik7cSSaaVZtNc8YnDz7fz';

$open_api_impl = new \com\blockchain\xbirds\OpenApi($app_id, $app_secret);

$resp_data = $open_api_impl->getUserInfo($openid);

var_dump($resp_data);
