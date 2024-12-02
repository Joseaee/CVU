<?php 

namespace Cvu\Content\helpers;

trait expRegTrait {

	//GENERAL
	public $expLetras = '/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ ]/';
	public $expNumeros = '/^[0-9]/';
	public $expCaracteresEspeciales = "/[0-9\.\,\!\¡¿?;\s\-]/";
	public $expTextos = '/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\.\,\!\¡¿?;\ ]/';
	public $expFechas = '/^\d{4}-\d{2}-\d{2}$/';
	public $expHoras = '/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/';
	public $expId = '/^[0-9A-Z\:\-]{1,21}$/';
	public $expOneTwo = '/^[1-2]{1}$/';

	//ELECCION
	public $expCodigoEleccion =  '/^\d{8}\d{6}eleccion:\d{3}$/';
	public $expNombreEleccion = '/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\.\,\!\¡¿?;\ ]{1,45}$/';

	//DETALLES ELECCION
	public $expCodigoDetallesEleccion = '/^\d{8}\d{6}detalleElec:\d{3}$/';

	//CENTRO VOTACION
	public $expCodigoCentroVotacion = '/^\d{8}\d{6}cv:\d{3}$/';
	public $expNombreCentroVotacion = '/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1\.\,\!\¡¿?;\ ]{1,45}$/';
}