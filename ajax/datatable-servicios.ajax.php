<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";


class TablaServicios{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Servicios
  	=============================================*/ 

	public function mostrarTablaServicios(){

		$item = null;
    	$valor = null;

  		$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);	

  		if(count($servicios) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($servicios); $i++){

		  	
		  	$item = "id";
		  	$valor = $servicios[$i]["id_pedido"];

		  	$pedido = ControladorPedidos::ctrMostrarPedidos($item, $valor);

		  	$item1 = "id";
		  	$valor1 = $pedido["id_equipo"];

		  	$equipo = ControladorEquipos::ctrMostrarEquipos($item1, $valor1);

		  	
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-primary btnEditarServicio' idServicio='".$servicios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarServicio'>Agregar</button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-primary btnEditarServicio' idServicio='".$servicios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarServicio'>Agregar</button></div>"; 

  			}

		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$equipo["tipo"].' '.$equipo["marca"].' '.$equipo["modelo"].'",

			      "'.$servicios[$i]["causas"].'",
			      "'.$servicios[$i]["correcciones"].'",
			      "'.$servicios[$i]["costo"].'"

			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;

	}


}

/*=============================================
ACTIVAR TABLA DE servicios
=============================================*/ 
$activarServicios = new TablaServicios();
$activarServicios -> mostrarTablaServicios();

