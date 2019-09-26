# dapp-php-sdk
区块链改造php sdk

## RSA签名工具

> php RsaTester.php

## webhook 伪代码

cd ${dapp-php-sdk} 即 当前工作目录

> php -S localhost:8000 webhook.php

- 支付回调

`http://localhost:8000/pay_notify`

- 查询用户积分

`http://localhost:8000/get_point`

- 扣除用户积分

`http://localhost:8000/reduce_point`

- 扣除用户通知（不成功会发送通知）

`http://localhost:8000/reduce_point_notify`
