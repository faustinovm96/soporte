<?php

class ControladorServicios{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor){

		$tabla = "servicios_tec";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR SERVICIO
	=============================================*/

	static public function ctrCrearServicio(){

		if(isset($_POST["nuevaCausa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCausa"])){

		   		$tabla = "servicios_tec";

				$datos = array("pedido" => $_POST["nuevoPedido"],
							   "tecnico" => $_POST["nuevoTecnico"],
							   "causas" => $_POST["nuevaCausa"],
							   "correcciones" => $_POST["nuevaCorreccion"],
								"costo" => $_POST["nuevoCosto"],
								"estado" => $_POST["nuevoEstado"]);

				$respuesta = ModeloServicios::mdlIngresarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "servicio";

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

							window.location = "servicio";

							}
						})

			  	</script>';
			}

		} 

	}

	/*== ===========================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrBorrarServicio(){

		if(isset($_GET["idServicio"])){

			$tabla ="servicios_tec";
			$datos = $_GET["idServicio"];

			$respuesta = ModeloServicios::mdlEliminarServicio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "servicio";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarServicio(){

		if(isset($_POST["editarCausa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCausa"])/* &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCorreccion"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarCosto"])*/){

				$tabla = "servicios_tec";

				$datos = array("causas" => $_POST["editarCausa"],
							   "correcciones" => $_POST["editarCorreccion"],
							   "costo" => $_POST["editarCosto"],
							   "estado" => $_POST["editarEstado"],
							   "id" => $_POST["idServicio"]);

				$respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "servicio";

										}
									})

						</script>';

				} else {

					echo'<script>

						swal({
							  type: "success",
							  title: "Error",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "servicio";

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

							window.location = "servicio";

							}
						})

			  	</script>';
			}
		}

	}

}