<?php

require_once "src/layout/layout.php";

if(isset($_GET['url'])){

	if($_GET['url'] == 'mesaTrabajo'){

		renderLayout(['mainContent'=>'src/views/mesaTrabajoView.php', 'links'=>[['href'=>'assets/css/modulos.css'], ['href'=>'assets/css/dashboard.css']], 'scripts'=>[['src'=>'assets/js/main.js']], 'footer'=> true, 'navbar'=> true, 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=mesaTrabajo"</script>');
}