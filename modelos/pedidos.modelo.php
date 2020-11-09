<?php

require_once "conexion.php";

class ModeloPedidos{

	/*=============================================
	CREAR TECNICO
	=============================================*/

	static public function mdlIngresarPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente, id_equipo, id_tecnico,  id_usuario, fecha, problema, causas, solucion, estado) VALUES (:id_cliente, :id_equipo, :id_tecnico, :id_usuario, :fecha, :problema, :causas, :solucion, :estado)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":id_equipo", $datos["id_equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tecnico", $datos["id_tecnico"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":causas", $datos["causas"], PDO::PARAM_STR);
		$stmt->bindParam(":solucion", $datos["solucion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarPedidos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR tecnico
	=============================================*/

	static public function mdlEditarPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, id_equipo = :id_equipo, id_tecnico = :id_tecnico, fecha = :fecha, problema = :problema, causas = :causas, solucion = :solucion, estado = :estado WHERE id = :id");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":id_equipo", $datos["id_equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tecnico", $datos["id_tecnico"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":causas", $datos["causas"], PDO::PARAM_STR);
		$stmt->bindParam(":solucion", $datos["solucion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR TECNICO
	=============================================*/

	static public function mdlBorrarPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR TECNICO
	=============================================*/

	static public function mdlActualizarPedido($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}