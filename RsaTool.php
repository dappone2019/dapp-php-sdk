<?php

$public_key_path = dirname(__FILE__) . '/key/rsa_public_key.pem';

// 支付成功回调的参数
$params = array(
  'app_id' => 1,
  'out_trade_no' => '5621048635828989',
  'status' => 4,
  'createtime' => 1555047944,
  'amount' => '3',
  'real_amount' => '3',
  'confirm_time' => 1555051016,
  'openid' => 'hFXkZSdnrEj7QuN8xDYg9G',
  '_signature' => 'wRfPt61g6fxrk13aoZL3gvMuW6lnncjFNlg9RDA0ftCYh1edBvoqE6slQYaqruijT/zqaDhywz9zVt636TcjN96NJLIfoFSsEU/5udbnYnfbeCNrzJzfz7KOZDaY7HmEAuq2hybqjGO4wiuCakeiENsYUbCP6ySQpTZvQcs+Iec=',
);

// $params = $_POST;

$_signature = $params['_signature'];
unset($params['_signature']);
$data = param2str($params);
$pubKey = file_get_contents($public_key_path);
$res = openssl_get_publickey($pubKey);
$result = (bool)openssl_verify($data, base64_decode($_signature), $res);
openssl_free_key($res);

if($result){
  echo 'verify pass ~'.PHP_EOL;
}else{
  echo 'verify error ~'.PHP_EOL;
}

function param2str($params)
{
    if (is_array($params)) {
        $params = (array) $params;
        ksort($params);

        $string_fragments = [];
        foreach ($params as $key => $value) {
            $string_fragments[] = $key . '=' . $value;
        }
        $string = implode('&', $string_fragments);
    } else {
        $string = $params;
    }

    return $string;
}
