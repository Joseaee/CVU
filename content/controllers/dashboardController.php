<?php

require_once "src/layout/layout.php";

if(isset($_GET['url'])){

	if($_GET['url'] == 'dashboard'){

		renderLayout(['mainContent'=>'src/views/dashboardView.php', 'links'=>[['href'=>'assets/css/dashboard.css']], 'scripts'=>[['src'=>'assets/js/dashboard.js'], ['src'=>'assets/js/main.js']], 'footer'=> true, 'navbar'=> true, 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=dashboard"</script>');
}