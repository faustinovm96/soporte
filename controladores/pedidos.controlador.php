<?php

class ControladorPedidos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarPedidos($item, $valor){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearPedido(){

		if(isset($_POST["nuevoProblema"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProblema"])){

				$tabla = "pedidos";

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaActual = $fecha.' '.$hora;

				$datos = array("id_usuario" => $_POST["idUsuario"],
							   "id_cliente" => $_POST["seleccionarCliente"],
							   "id_equipo" => $_POST["seleccionarEquipo"],
							   "id_tecnico" => $_POST["seleccionarTecnico"],
							   "fecha" => $fechaActual,
							   "problema" => $_POST["nuevoProblema"],
								"causas" => $_POST["nuevaCausa"],
								"solucion" => $_POST["nuevaSolucion"],
								"estado" => $_POST["nuevoEstado"]);

				var_dump($datos);

				$respuesta = ModeloPedidos::mdlIngresarPedido($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El pedido ha sido guardado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "pedidos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pedidos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarPedido(){

		if(isset($_POST["editarProblema"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProblema"])){

				$tabla = "pedidos";

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaActual = $fecha.' '.$hora;

				$datos = array("id_cliente" => $_POST["editarCliente"],
								"id_equipo" => $_POST["editarEquipo"],
								"id_tecnico" => $_POST["editarTecnico"],
							   "fecha" => $fechaActual,
							   "problema" => $_POST["editarProblema"],
							   "causas" => $_POST["editarCausa"],
							   "solucion" => $_POST["editarSolucion"],
							   "estado" => $_POST["editarEstado"],
							   "id" => $_POST["idPedido"]);

				var_dump($datos);

				$respuesta = ModeloPedidos::mdlEditarPedido($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El pedido ha sido modificado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "pedidos";

										}
									})

						</script>';

				}else {

					echo'<script>

						swal({
							  type: "error",
							  title: "Ha ocurrido un error",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "pedidos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pedidos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrBorrarPedido(){

		if(isset($_GET["idPedido"])){

			$tabla ="pedidos";
			$datos = $_GET["idPedido"];

			$respuesta = ModeloPedidos::mdlBorrarPedido($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El pedido ha sido borrado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/
/*
	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}*/


}