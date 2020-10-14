<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquipos{

	/*=============================================
	  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
	  =============================================*/
	/*  public $idCategoria;

	  public function ajaxCrearCodigoEquipo(){

	  	$item = "id_cliente";
	  	$valor = $this->idCliente;

	  	$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

	  	echo json_encode($respuesta);

	  }*/

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquipo(){

		$item = "id";
		$valor = $this->idEquipo;

		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idEquipo"])){

	$equipos = new AjaxEquipos();
	$equipos -> idEquipo = $_POST["idEquipo"];
	$equipos -> ajaxEditarEquipo();

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	
/*
if(isset($_POST["idCliente"])){

	$codigoEquipo = new AjaxEquipos();
	$codigoEquipo -> idCliente = $_POST["idCliente"];
	$codigoEquipo -> ajaxCrearCodigoEquipo();

}*/