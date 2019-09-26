<?php

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

function verifySignatureRSA($params, $_signature)
{
  $public_key_path = dirname(__FILE__) . '/key/rsa_public_key.pem';
  unset($params['_signature']);
  $data = param2str($params);
  $pubKey = file_get_contents($public_key_path);
  $res = openssl_get_publickey($pubKey);
  $result = (bool)openssl_verify($data, base64_decode($_signature), $res);
  openssl_free_key($res);
  if($result){
    return true;
  }else{
    return false;
  }
}
