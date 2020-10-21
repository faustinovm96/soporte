<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=id15067246_techport",
			            "id15067246_root",
			            "U/*[yJ\VZFl5NVLC");

		$link->exec("set names utf8");

		return $link;

	}

}