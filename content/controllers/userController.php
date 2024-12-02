<?php 

use Cvu\Content\Models\SessionModel as SessionModel;

require_once "src/layout/layout.php";

$sessionModel = new SessionModel(); 

if(isset($_GET['url'])){

	if($_GET['url'] == 'login'){

		renderLayout(['mainContent'=>'src/views/loginView.php', 'links'=>[['href'=>'assets/css/modulos.css'], ['href'=>'assets/css/login.css']], 'scripts'=>[['src'=>'assets/js/login.js']], 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=login"</script>');
}