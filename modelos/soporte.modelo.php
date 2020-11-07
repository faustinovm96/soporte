<?php

require_once "conexion.php";

class ModeloSoportes{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarSoportes($tabla, $item, $valor){

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
	REGISTRO DE PRODUCTO
	CUANDO un campo mencionado dentro de una consulta esta mal escrito dara un error en el cual no se podrá envar los datos a la db
	=============================================*/
	static public function mdlIngresarSoporte($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_pedido, causas, solucion, estado) VALUES (:id_pedido, :causas, :solucion, :estado)");

		$stmt->bindParam(":id_pedido", $datos["pedido"], PDO::PARAM_STR);
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
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarSoporte($tabla, $datos){

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
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarSoporte($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_pedido = :id_pedido, causas = :causas, solucion = :solucion, estado = :estado WHERE id = :id");
		
		$stmt->bindParam(":id_pedido", $datos["id_pedido"], PDO::PARAM_STR);
		$stmt->bindParam(":causas", $datos["causas"], PDO::PARAM_STR);
		$stmt->bindParam(":solucion", $datos["solucion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}