<?php
class Err_Map {
	const ERRMAP = array(
						1000 => 'Exception error',
						1001 => '请通过正确渠道提交',
						1002 => '用户名与密码必须传递',
						1003 => '用户查找失败',
						1004 => '密码错误',
						1005 => '用户名已存在',
						1006 => '密码太短，请设置至少8位的密码',
						//1007 => '新的错误信息！！！ ',
						/**
						 * 2*** 3*** 4*** ...... 7*** 留给大家
						 */
					);

	public static function get( $code ){
		if( isset(ERRMAP[$code]) ) {
			return array( 'errno'=>(0-$code), 'errmsg'=>ERRMAP[$code] );
		}
		return array( 'errno'=>(0-$code), 'errmsg'=>"undefined this error number." );
	}

}
