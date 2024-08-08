<?php

require_once "src/layout/layout.php";

if(isset($_GET['url'])){

	if($_GET['url'] == 'candidatos'){

		renderLayout(['mainContent'=>'src/views/candidatosView.php', 'links'=>[['href'=>'assets/css/modulos.css'], ['href'=>'assets/css/dashboard.css']], 'scripts'=>[['src'=>'assets/js/main.js']], 'footer'=> true, 'navbar'=> true, 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=candidatos"</script>');
}