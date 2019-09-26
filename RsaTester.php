<?php

include('RsaTool.php');

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
// 开发者默认接收 post 请求参数
// $params = $_POST;

$_signature = $params['_signature'];
unset($params['_signature']);

$result = verifySignatureRSA($params, $_signature);

if($result){
  echo 'verify pass ~'.PHP_EOL;
}else{
  echo 'verify error ~'.PHP_EOL;
}