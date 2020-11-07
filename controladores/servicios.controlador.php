<?php

class ControladorServicios{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor){

		$tabla = "servicios";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR SERVICIO
	=============================================*/

	static public function ctrCrearServicio(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"])){

		   		$tabla = "servicios";

				$datos = array("descripcion" => $_POST["nuevaDescripcion"],
								"costo" => $_POST["nuevoCosto"]);

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

			$tabla ="servicios";
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

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				$tabla = "servicios";

				$datos = array("descripcion" => $_POST["editarDescripcion"],
							   "costo" => $_POST["editarCosto"],
							   "id" => $_POST["idProducto"]);

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