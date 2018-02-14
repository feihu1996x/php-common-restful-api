<?php
/**
 * @name UserModel
 * @desc 用户操作Model类
 * @author pangee
 */
class UserModel {
	public $errno = 0;
	public $errmsg = "";
	private $_dao = null;

    public function __construct() {
		$this->_dao = new Db_User();
    }   
    
	public function login( $uname, $pwd ) {
		$userInfo = $this->_dao->find( $uname );
		if( !$userInfo ) {
			$this->errno = $this->_dao->errno();
			$this->errmsg= $this->_dao->ermsg();
			return false;
		}
		if( Common_Password::pwdEncode($pwd) != $userInfo['pwd'] ) {
			list( $this->errno, $this->errmsg ) = Err_Map::get( 1004 );
			return false;
		}
		return intval($userInfo[1]);
	}

	public function register( $uname, $pwd ){
		if( ! $this->_dao->checkExists( $uname ) ) {
			$this->errno = $this->_dao->errno();
			$this->errmsg= $this->_dao->errmsg();
			return false;
		}

		if( strlen($pwd)<8 ) {
			list( $this->errno, $this->errmsg ) = Err_Map::get( 1006 );
			return false;
		} else {
			$password = Common_Password::pwdEncode( $pwd );
		}

		if( ! $this->_dao->addUser( $uname, $password, date("Y-m-d H:i:s") ) ) {
			$this->errno = $this->_dao->errno();
			$this->errmsg= $this->_dao->errmsg();
			return false;
		}
		return true;
	}

}
