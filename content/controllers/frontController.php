<?php 

namespace Cvu\Content\Controllers;

use Cvu\Content\Config\Settings\SystemConfig as SystemConfig;

session_start();

class FrontController extends SystemConfig {

	private $url;
	private $directory;
	private $controller;

	public function __construct(){

		if(isset($_REQUEST["url"])){

			$this->url = $_REQUEST["url"];
			$objSys = new systemConfig();
			$this->directory = $objSys->_Dir_();
			$this->controller = $objSys->_Contro_();
			$this->_ValidateURL();
		}else{

			die("<script>location='?url=inicio'</script>");
		}
	}

	private function _ValidateURL(){

		if (preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$ ]{1,700}$/", $this->url)){

			$this->_loadPage($this->url);
		}else{

			die("Ingresa una URL valida.");
		}
	}

	private function _loadPage($url){

		if (file_exists($this->directory.$url.$this->controller)){

			require_once($this->directory.$url.$this->controller);
		}else{

			if(file_exists($this->directory.'session'.$this->controller)){

				die("<script>location='?url=session'</script>");
			} else{

				die("<script>location='?url=error'</script>");
			}
		} 
	}
}