<?php 

namespace Cvu\Content\Config\Settings;

define("_ROUTE_", "http://localhost/xampp/cvu");
define("_CON_", "Controller.php");
define("_DIR_", "content/Controllers/");
define("_DB_", "cvubd");
define("_USER_", "root");
define("_PASS_", "");
define("_SERVER_", "localhost");
define("SECURE_KEY", "");

class SystemConfig {

	public function existController(){

		if (!file_exists(_DIR_."frontController.php")) {

			die('Error: no se encontró el frontController.');
		}
	}

	protected function _Contro_(){

		return _CON_;
	}

	protected function _Dir_(){

		return _DIR_;
	}

	protected function _Route_(){

		return _ROUTE_;
	}

	protected function _Db_(){

		return _DB_;
	}

	protected function _User_(){

		return _USER_;
	}

	protected function _Pass_(){

		return _PASS_;
	}

	protected function _Server_(){

		return _SERVER_;
	}
}