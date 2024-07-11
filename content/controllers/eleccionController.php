<?php 

use Cvu\Content\Models\EleccionModel;
require_once "src/layout/layout.php";

$eleccionModel = new EleccionModel(); 

if(isset($_GET['url'])){

	$error = false; 

	if($_GET['url'] == 'eleccion'){

		if(isset($_POST['existeEleccion']) && !$error){

			$r = $eleccionModel->existeEleccion($_POST['existeEleccion']);
			if($r['status'] != 'success') $error = true;
			$existeEleccion = $r['data'];
		}

		if(isset($_POST['validarEleccion']) && isset($_POST['nombreEleccion']) && isset($_POST['fechaEleccion']) && !$error){

			$r = $eleccionModel->validarEleccion($_POST['nombreEleccion'], $_POST['fechaEleccion']);
			if($r['status'] != 'success') $error = true;
			$validaEleccion = $r['data'];
		}

		if(isset($_POST['consultarElecciones']) && !$error){

			$r = $eleccionModel->consultarElecciones();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['insertarEleccion']) && isset($validaEleccion) && !$error){

			if($validaEleccion) $r = $eleccionModel->getInsertarEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarEleccionSeleccionada']) && isset($existeEleccion) && !$error){

			if($existeEleccion) $r = $eleccionModel->consultarEleccionSeleccionada();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['actualizarEleccion']) && isset($validaEleccion) && isset($existeEleccion) && !$error){

			if($existeEleccion && $validaEleccion) $r = $eleccionModel->getActualizarEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['eliminarEleccion']) && isset($existeEleccion) && !$error){

			if($existeEleccion) $r = $eleccionModel->getEliminarEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['response'])){

			$eleccionModel->jsonResponse($r['status'], $r['message'], $r['data'], $r['statusCode']);
		}

		renderLayout(['mainContent'=>'src/views/sessionView.php', 'links'=>[['href'=>'assets/css/inicio.css']], 'scripts'=>[['src'=>'assets/js/session.js']], 'errorUrl'=>'session']);
	}
}else{

	die('<script>window.location="?url=session"</script>');
}