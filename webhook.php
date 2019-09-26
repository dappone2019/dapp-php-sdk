<?php
include('RsaTool.php');

$servers = $_SERVER;

$php_self = $servers['PHP_SELF'];

$query_string = $servers['QUERY_STRING'];


if(trim($php_self, '/') == 'pay_notify'){
	payNotify();
}else if(trim($php_self, '/') == 'get_point'){
	getPoint();
}else if(trim($php_self, '/') == 'reduce_point'){
	reducePoint();
}else if(trim($php_self, '/') == 'reduce_point_notify'){
	reducePointNotify();
}

// 所有请求 及 响应 都应按照接口标准来操作： http://showdoc.imakejoy.com/web/#/22?page_id=445
// 支付回调接口
function payNotify()
{
	$req_params = $_POST;
	//	第1步 先判断sign 略
	$_signature = $req_params['_signature'];
	$res = verifySignatureRSA($req_params, $_signature);
	if(!$res) {
		echo 'error';
		exit;
	}

	$app_id = $req_params['app_id'];
	$out_trade_no = $req_params['out_trade_no'];
	$openid = $req_params['openid'];  // 为开发者用户在平台db平台注册用户唯一标识
	$status = $req_params['status'];
	$amount = $req_params['amount'];
	$real_amount = $req_params['real_amount'];
	$confirm_time = $req_params['confirm_time'];

	// 第2步 判断status = 3 表示支付成功， 按实际业务处理发货流程
	// 接口需具有幂等性，防止重复发货
	if($status != 3){
		echo 'error';
		exit;
	}
	// 更改订单状态，处理发货

	// 最后处理发货成功 返回
	echo 'success';
}

// 查询当前用户的积分
function getPoint()
{
	$req_params = $_POST;
	//	第1步 先判断sign 略
	$_signature = $req_params['_signature'];
	$res = verifySignatureRSA($req_params, $_signature);
	if(!$res) {
		echo 'error';
		exit;
	}

	$app_id = $req_params['app_id'];
	$openid = $req_params['openid'];
	// 第2步
	// 按openid 去查询当前用户的
	// 从开发者库里查询
	$point = 100;

	// 按application/json
	// 伪代码
	// return json({
	//    "code": 0,
	// 	"point": 100,
	// 	"msg": ''
	// })

	echo 'get_point';
}

// 扣除积分
function reducePoint()
{
	$req_params = $_POST;
	//	第1步 先判断sign 略
	$_signature = $req_params['_signature'];
	$res = verifySignatureRSA($req_params, $_signature);
	if(!$res) {
		echo 'error';
		exit;
	}

	$app_id = $req_params['app_id'];
	$openid = $req_params['openid'];
	$point = $req_params['point'];
	$trans_id = $req_params['trans_id']; // 交易单号
	$title = $req_params['title'];

	// 第2步
	// 按openid 去查询当前用户的 是否足够本次消费
	// 若足够，则扣除 point，并记录trans_id

	// 扣除成功返回

	// 按application/json
	// 伪代码
	// return json({
	//     "code": 0,
	//     "msg": ''
	// })

	echo 'reduce_point';

}

// 扣除积分通知
function reducePointNotify()
{
	$req_params = $_POST;
	//	第1步 先判断sign 略
	$_signature = $req_params['_signature'];
	$res = verifySignatureRSA($req_params, $_signature);
	if(!$res) {
		echo 'error';
		exit;
	}

	$app_id = $req_params['app_id'];
	$is_success = $req_params['is_success']; // 2: 表示失败
	$trans_id = $req_params['trans_id'];

	if($is_success != 2){
		echo 'do nothing';
		exit;
	}

	// 接口需具有幂等性
	// 查询记录的trans_id: 关联的用户及扣除point
	// 还原 用户的积分，并标记trans_id 已退款

	// 成功返回

	// 按application/json
	// 伪代码
	// return json({
	//     "code": 0,
	//     "msg": ''
	// })

	echo 'reduce_point_notify';
}

?>

