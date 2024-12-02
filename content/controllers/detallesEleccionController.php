<?php 

use Cvu\Content\Models\detalleEleccionesModel;
require_once "src/layout/layout.php";

$detallesEleccionModel = new detalleEleccionesModel(); 

if(isset($_GET['url'])){

	$error = false; 

	if($_GET['url'] == 'detallesEleccion'){

		if(isset($_POST['existeDetallesEleccion']) && !$error){

			$r = $detallesEleccionModel->existeDetallesEleccion($_POST['existeDetallesEleccion']);
			if($r['status'] != 'success') $error = true;
			$existeDetallesEleccion = $r['data'];
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

		if(isset($_POST['insertarDetallesEleccion']) && isset($existeEleccion) && isset($validaEleccion)  && !$error){

			if($existeEleccion && $validaEleccion) $r = $detallesEleccionModel->getInsertarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarDetallesEleccionSeleccionada']) && isset($existeDetallesEleccion) && !$error){

			if($existeDetallesEleccion) $r = $detallesEleccionModel->consultarDetallesEleccionSeleccionada();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['actualizarDetallesEleccion']) && isset($existeDetallesEleccion) && isset($existeEleccion) && isset($validaEleccion) && !$error){

			if($existeDetallesEleccion && $existeEleccion && $validaEleccion) $r = $detallesEleccionModel->getActualizarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['eliminarDetallesEleccion']) && isset($existeDetallesEleccion) && !$error){

			if($existeDetallesEleccion) $r = $detallesEleccionModel->getEliminarDetallesEleccion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['response'])){

			$detallesEleccionModel->jsonResponse($r['status'], $r['message'], $r['data'], $r['statusCode']);
		}

		renderLayout(['mainContent'=>'src/views/detalleEleccionesView.php', 'links'=>[['href'=>'assets/css/modulos.css'], ['href'=>'assets/css/dashboard.css']], 'scripts'=>[['src'=>'assets/js/main.js']], 'footer'=> true, 'navbar'=> true, 'errorUrl'=>'error']);
	}
}else{

	die('<script>window.location="?url=session"</script>');
}