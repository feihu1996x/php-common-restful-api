<?php
require_once __DIR__ . '/../vendor/autoload.php';
use \Curl\Curl;

$host = "http://localhost";
$curl = new Curl();
$uname = 'apitest_uname_'.rand();
$pwd = 'apitest_pwd_'.rand();

/**
 * 注册接口验证
 */
$curl->post(
			$host."/user/register", 
			array("uname"=>$uname, "pwd"=>$pwd)
		);
if ( $curl->error ) {
	die( "Error: ". $curl->errorCode . ":" . $curl->errorMessage . "\n" );
} else {
	$rep = json_decode( $curl->response, true );
	if ( $rep['errno']!==0 ) {
		die( "Error: 注册用户失败，注册接口异常。错误信息:". $rep['errmsg']."\n"  );	
	}
	echo "注册用户接口测试成功，注册新用户：".$uname."\n";
}

/**
 * 登录接口验证
 */
$curl->post(
			$host."/user/login?submit=1",
			array("uname"=>$uname, "pwd"=>$pwd)
			);
if ( $curl->error ) {
	die( "Error: ". $curl->errorCode . ":" . $curl->errorMessage . "\n" );
} else {
	$rep = json_decode( $curl->response, true );
	if ( $rep['errno']!==0 ) {
		die( "Error: 登录失败，登录接口异常。错误信息：". $rep['errmsg']."\n" );
	}
	echo "登录接口测试成功，登录用户：".$uname.", 密码：".$pwd."\n";
}


echo 'check done.'."\n";

