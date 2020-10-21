<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class AjaxServicios{

  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;

      $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "correcciones";
      $valor = $this->nombreProducto;

      $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idProducto;

      $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

      echo json_encode($respuesta);

    }

  }

}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxServicios();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxServicios();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxServicios();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}






