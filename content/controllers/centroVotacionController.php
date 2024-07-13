<?php 

use Cvu\Content\Models\CentroVotacionModel;

require_once "src/layout/layout.php";

$centroVotacionModel = new centroVotacionModel(); 

if(isset($_GET['url'])){

	$error = false; 

	if($_GET['url'] == 'centroVotacion'){

		if(isset($_POST['existeCentroVotacion']) && !$error){
			//die($_POST['existeCentroVotacion']);
			$r = $centroVotacionModel->existeCentroVotacion($_POST['existeCentroVotacion']);
			if($r['status'] != 'success') $error = true;
			$existeCentroVotacion = $r['data'];
		}

		if(isset($_POST['existeDetallesEleccion']) && !$error){

			$r = $centroVotacionModel->existeDetallesEleccion($_POST['existeDetallesEleccion']);
			if($r['status'] != 'success') $error = true;
			$existeDetallesEleccion = $r['data'];
		}

		if(isset($_POST['validarCentroVotacion']) && isset($_POST['nombre']) && isset($_POST['presidente']) && isset($_POST['secretario']) && isset($_POST['lugar']) && !$error){

			$r = $centroVotacionModel->validarCentroVotacion($_POST['nombre'], $_POST['presidente'], $_POST['secretario'], $_POST['lugar']);
			if($r['status'] != 'success') $error = true;
			$validoCentroVotacion = $r['data'];
		}

		if(isset($_POST['consultarCentrosVotacion']) && !$error){

			$r = $centroVotacionModel->consultarCentrosVotacion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarDetallesElecciones']) && !$error){

			$r = $centroVotacionModel->consultarDetallesElecciones();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['insertarCentroVotacion']) && isset($validoCentroVotacion) && isset($existeDetallesEleccion) && !$error){

			if($validoCentroVotacion && $existeDetallesEleccion) $r = $centroVotacionModel->getInsertarCentroVotacion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['consultarCentrosVotacionSeleccionado']) && isset($existeCentroVotacion) && !$error){

			if($existeCentroVotacion) $r = $centroVotacionModel->consultarCentroVotacionSeleccionado();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['actualizarCentroVotacion']) && isset($validoCentroVotacion) && isset($existeCentroVotacion) && !$error){

			if($existeCentroVotacion && $validoCentroVotacion && $existeDetallesEleccion) $r = $centroVotacionModel->getActualizarCentroVotacion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['eliminarCentroVotacion']) && isset($existeCentroVotacion) && !$error){

			if($existeCentroVotacion) $r = $centroVotacionModel->getEliminarCentroVotacion();
			if($r['status'] != 'success') $error = true;
		}

		if(isset($_POST['response'])){

			$centroVotacionModel->jsonResponse($r['status'], $r['message'], $r['data'], $r['statusCode']);
		}

		renderLayout(['mainContent'=>'src/views/sessionView.php', 'links'=>[['href'=>'assets/css/inicio.css']], 'scripts'=>[['src'=>'assets/js/session.js']], 'errorUrl'=>'session']);
	}
}else{

	die('<script>window.location="?url=session"</script>');
}