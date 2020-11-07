<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=techport2",
			            "root",
			            "holamundo96");

		$link->exec("set names utf8");

		return $link;

	}

}