<?php 

namespace Cvu\Content\Config\Connect;

use Cvu\Content\Config\Settings\SystemConfig as SystemConfig;
use \PDO;
use PDOException;

class ConnectDB extends SystemConfig{

	private $localhost;
	private $password;
	private $user;
	private $DataBase;
	private $con;

	public function __construct(){

		$this->localhost = parent::_Server_();
		$this->password = parent::_Pass_();
		$this->user = parent::_User_();
		$this->DataBase = parent::_Db_();
	}

	protected function activeDB(){

		try {

			$this->con = new PDO("mysql: host=" . $this->localhost . "; dbname=" . $this->DataBase, $this->user, $this->password);
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {

			die('ERROR DE CONEXIÓN: No se ha podido conectar con la base de datos.');
		}

		return $this->con;
	}
}