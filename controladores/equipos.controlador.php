<?php

class ControladorEquipos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarEquipos($item, $valor){

		$tabla = "equipos_inf";

		$respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearEquipo(){

		if(isset($_POST["nuevoTipo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"]) &&
			   
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoAccesorio"])){

				$tabla = "equipos_inf";

				$datos = array("id_cliente" => $_POST["nuevoCliente"],
							   "tipo" => $_POST["nuevoTipo"],
							   "marca" => $_POST["nuevaMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "numero_serie" => $_POST["nuevaSerie"],
							   "accesorios" => $_POST["nuevoAccesorio"]);

				$respuesta = ModeloEquipos::mdlIngresarEquipo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El equipo ha sido guardado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "equipos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "equipos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarEquipo(){

		if(isset($_POST["editarTipo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTipo"])){

				$tabla = "equipos_inf";

				$datos = array("id_cliente" => $_POST["editarCliente"],
							   "tipo" => $_POST["editarTipo"],
							   "marca" => $_POST["editarMarca"],
							   "modelo" => $_POST["editarModelo"],
							   "numero_serie" => $_POST["editarSerie"],
							   "accesorios" => $_POST["editarAccesorio"],
							   "id" => $_POST["idEquipo"]);

				var_dump($datos);

				$respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El equipo ha sido modificado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "equipos";

										}
									})

						</script>';

				}else {

					echo'<script>

						swal({
							  type: "error",
							  title: "Algo ha salido mal",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "equipos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El equipo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrBorrarEquipo(){

		if(isset($_GET["idEquipo"])){

			$tabla ="equipos_inf";
			$datos = $_GET["idEquipo"];

			$respuesta = ModeloEquipos::mdlEliminarEquipo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El equipo ha sido borrado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "equipos";

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