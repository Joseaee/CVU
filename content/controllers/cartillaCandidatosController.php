<?php

require_once "src/layout/layout.php";

if(isset($_GET['url'])){

	if($_GET['url'] == 'cartillaCandidatos'){

		renderLayout(['mainContent'=>'src/views/cartillaCandidatosView.php', 'links'=>[['href'=>'assets/css/cartilla.css']], 'scripts'=>[['src'=>'assets/js/main.js']], 'footer'=> true, 'navbar'=> true, 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=cartillaCandidatos"</script>');
}