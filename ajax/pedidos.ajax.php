<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPedidos{

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

	public $idPedido;

	public function ajaxEditarPedido(){

		$item = "id";
		$valor = $this->idPedido;

		$respuesta = ControladorPedidos::ctrMostrarPedidos($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idPedido"])){

	$pedidos = new AjaxPedidos();
	$pedidos -> idPedido = $_POST["idPedido"];
	$pedidos -> ajaxEditarPedido();

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