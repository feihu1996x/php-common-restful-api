<?php
class Common_Password {

	const SALT = "I-love-iMooc";

	static public function pwdEncode( $pwd ){
		return md5( self::SALT . $pwd );
	}


}
