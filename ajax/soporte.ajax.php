<?php

require_once "../controladores/soporte.controlador.php";
require_once "../modelos/soporte.modelo.php";

class AjaxSoportes{

	/*=============================================
	EDITAR SOPORTE
	=============================================*/	

	public $idSoporte;

	public function ajaxEditarSoporte(){

		$item = "id";
		$valor = $this->idSoporte;

		$respuesta = ControladorSoportes::ctrMostrarSoportes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR SOPORTE
=============================================*/	
if(isset($_POST["idSoporte"])){

	$soporte = new AjaxSoportes();
	$soporte -> idSoporte = $_POST["idSoporte"];
	$soporte -> ajaxEditarSoporte();
}
