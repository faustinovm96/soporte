<?php

class ControladorSoportes{

	/*=============================================
	MOSTRAR SOPORTE
	=============================================*/

	static public function ctrMostrarSoportes($item, $valor){

		$tabla = "soporte_tec";

		$respuesta = ModeloSoportes::mdlMostrarSoportes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR SERVICIO
	=============================================*/

	static public function ctrCrearSoporte(){

		if(isset($_POST["nuevaCausa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCausa"])){

		   		$tabla = "soporte_tec";

				$datos = array("pedido" => $_POST["seleccionarPedido"],
							   "causas" => $_POST["nuevaCausa"],
							   "solucion" => $_POST["nuevaSolucion"],
								"estado" => $_POST["nuevoEstado"]);

				$respuesta = ModeloSoportes::mdlIngresarSoporte($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El soporte ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "soporte";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El soporte no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "soporte";

							}
						})

			  	</script>';
			}

		} 

	}

	/*== ===========================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrBorrarSoporte(){

		if(isset($_GET["idSoporte"])){

			$tabla ="soporte_tec";
			$datos = $_GET["idSoporte"];

			$respuesta = ModeloSoportes::mdlEliminarSoporte($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "soporte";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarSoporte(){

		if(isset($_POST["editarCausa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCausa"])){

				$tabla = "soporte_tec";

				$datos = array("pedido" => $_POST["editarPedido"],
							   "causas" => $_POST["editarCausa"],
							   "solucion" => $_POST["editarSolucion"],
							   "estado" => $_POST["editarEstado"],
							   "id" => $_POST["idSoporte"]);

				$respuesta = ModeloSoportes::mdlEditarSoporte($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "soporte";

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

										window.location = "soporte";

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

							window.location = "soporte";

							}
						})

			  	</script>';
			}
		}

	}

}