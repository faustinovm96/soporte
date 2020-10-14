<?php

require_once "../controladores/tecnicos.controlador.php";
require_once "../modelos/tecnicos.modelo.php";

class AjaxTecnicos{

	/*=============================================
	EDITAR TECNICOS
	=============================================*/	

	public $idTecnico;

	public function ajaxEditarTecnico(){

		$item = "id";
		$valor = $this->idTecnico;

		$respuesta = ControladorTecnicos::ctrMostrarTecnicos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idTecnico"])){

	$tecnico = new AjaxTecnicos();
	$tecnico -> idTecnico = $_POST["idTecnico"];
	$tecnico -> ajaxEditarTecnico();
}
