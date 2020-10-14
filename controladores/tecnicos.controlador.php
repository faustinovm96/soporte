<?php

class ControladorTecnicos{

	/*=============================================
	CREAR TECNICO
	=============================================*/

	static public function ctrCrearTecnico(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){

				$tabla = "tecnicos";

				$datos = array("documento" => $_POST["nuevoDocumento"],
								"nombre" => $_POST["nuevoNombre"],						
					           	"direccion" => $_POST["nuevaDireccion"],
					           	"celular" => $_POST["nuevoCelular"],
					           	"email" => $_POST["nuevoEmail"],);

				//var_dump($datos);

				$respuesta = ModeloTecnicos::mdlIngresarTecnico($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Técnico ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tecnicos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Técnico no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tecnicos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR TECNICOS
	=============================================*/

	static public function ctrMostrarTecnicos($item, $valor){

		$tabla = "tecnicos";

		$respuesta = ModeloTecnicos::mdlMostrarTecnicos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR TECNICO
	=============================================*/

	static public function ctrEditarTecnico(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$tabla = "tecnicos";

				$datos = array("documento"=>$_POST["editarDocumento"],
								"nombre"=>$_POST["editarNombre"],
								"direccion"=>$_POST["editarDireccion"],
								"celular"=>$_POST["editarCelular"],
								"email"=>$_POST["editarEmail"],
							   	"id"=>$_POST["idTecnico"]);

				var_dump($datos);

				$respuesta = ModeloTecnicos::mdlEditarTecnico($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Técnico ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tecnicos";

									}
								})

					</script>';

				} else {

					echo'<script>

					swal({
						  type: "success",
						  title: "Eh Guachin",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tecnicos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Técnico no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tecnicos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR Tecnico
	=============================================*/

	static public function ctrBorrarTecnico(){

		if(isset($_GET["idTecnico"])){

			$tabla ="tecnicos";
			$datos = $_GET["idTecnico"];

			$respuesta = ModeloTecnicos::mdlBorrarTecnico($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El técnico ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tecnicos";

									}
								})

					</script>';
			}
		}
		
	}
}
