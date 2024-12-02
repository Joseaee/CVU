<?php 

use Cvu\Content\Models\SessionModel as SessionModel;

require_once "src/layout/layout.php";

$sessionModel = new SessionModel(); 

if(isset($_GET['url'])){

	if($_GET['url'] == 'session'){

		renderLayout(['mainContent'=>'src/views/sessionView.php', 'links'=>[['href'=>'assets/css/session.css']], 'scripts'=>[['src'=>'assets/js/session.js']], 'errorUrl'=>'session']);
	}
}else{

	die('<script>window.location="?url=session"</script>');
}