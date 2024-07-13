<?php 

use Cvu\Content\Models\DetallesEleccionModel;
require_once "src/layout/layout.php";

$detallesEleccionModel = new DetallesEleccionModel(); 

if(isset($_GET['url'])){

	$error = false; 

	if($_GET['url'] == 'detallesEleccion'){

		if(isset($_POST['existeDetallesEleccion']) && !$error){

			$r = $detallesEleccionModel->existeDetallesEleccion($_POST['existeDetallesEleccion']);
			if($r['status'] != 'success') $error = true;
			$existeEleccion = $r['data'];
		}

		if(isset($_POST['existeEleccion']) && !$error){

			$r = $detallesEleccionModel->existeEleccion($_POST['existeEleccion']);
			if($r['status'] != 'success') $error = true;
			$existeEleccion = $r['data'];
		}

		if(isset($_POST['validarDetallesEleccion']) && isset($_POST['periodo']) && isset($_POST['horaApertura']) && isset($_POST['horaCierre']) && !$error){

			$r = $detallesEleccionModel->validarDetallesEleccion($_POST['periodo'], $_POST['horaApertura'], $_POST['horaCierre']);
			if($r['status'] != 'success') $error = true;
			$validaEleccion = $r['data'];
		}

		if(isset($_POST['consultarDetallesElecciones']) && !$error){

			$r = $detallesEleccionModel->consultarDetallesElecciones();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarElecciones']) && !$error){

			$r = $detallesEleccionModel->consultarElecciones();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['insertarDetallesEleccion']) && isset($validaEleccion) && !$error){

			if($validaEleccion) $r = $detallesEleccionModel->getInsertarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarDetallesEleccionSeleccionada']) && isset($existeEleccion) && !$error){

			if($existeEleccion) $r = $detallesEleccionModel->consultarDetallesEleccionSeleccionada();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['actualizarDetallesEleccion']) && isset($validaEleccion) && isset($existeEleccion) && !$error){

			if($existeEleccion && $validaEleccion) $r = $detallesEleccionModel->getActualizarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['eliminarDetallesEleccion']) && isset($existeEleccion) && !$error){

			if($existeEleccion) $r = $detallesEleccionModel->getEliminarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['response'])){

			$detallesEleccionModel->jsonResponse($r['status'], $r['message'], $r['data'], $r['statusCode']);
		}

		renderLayout(['mainContent'=>'src/views/sessionView.php', 'links'=>[['href'=>'assets/css/inicio.css']], 'scripts'=>[['src'=>'assets/js/session.js']], 'errorUrl'=>'session']);
	}
}else{

	die('<script>window.location="?url=session"</script>');
}