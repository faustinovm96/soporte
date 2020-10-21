<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorServicios::ctrMostrarServicios($item, $valor);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	$item1 = "id";
    		$valor1 = $productos[$i]["id_pedido"];

    		$pedidos = ControladorPedidos::ctrMostrarPedidos($item1, $valor1);

    		$item2 = "id";
    		$valor2 = $pedidos["id_equipo"];

    		$equipo = ControladorEquipos::ctrMostrarEquipos($item2, $valor2);

    		$item3 = "id";
    		$valor3 = $equipo["id_cliente"];

    		$cliente = ControladorClientes::ctrMostrarClientes($item3, $valor3);

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$cliente["nombre_razon_social"].'",
			      "'.$equipo["tipo"].' '.$equipo["marca"].' '.$equipo["modelo"].'",
			      "'.$productos[$i]["correcciones"].'",
			      "'.$productos[$i]["costo"].'",

			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();

