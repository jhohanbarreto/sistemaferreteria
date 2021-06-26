<?php
require_once "conexion.php";
class ModeloPromocion{

    /*========================================================
        INGRESAR PRODUCTO
    =========================================================*/
    static public function mdlIngresarPromocion($tabla,$datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, producto, id_producto, precioReal, precioRebajado, porcentaje,descripcion, fecha_inicio, fecha_final, imagen) VALUES (:nombre, :producto, :id_producto, :precioReal, :precioRebajado, :porcentaje, :descripcion, :fecha_inicio, :fecha_final, :imagen)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":precioReal", $datos["precioReal"], PDO::PARAM_STR);
		$stmt->bindParam(":precioRebajado", $datos["precioRebajado"], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje", $datos["porcentaje"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	/*========================================================
		MOSTRAR PROMOCION
    =========================================================*/
	static public function mdlMostrarPromocion($tabla,$item,$valor){ 
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
        $stmt->close();
        $stmt=null;

	}
	/*========================================================
	EDITAR PROMOCION
	=========================================================*/
	static public function mdlEditarPromocion($tabla,$datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_producto = :id_producto, precioReal = :precioReal, precioRebajado = :precioRebajado, porcentaje = :porcentaje, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_final = :fecha_final, imagen = :imagen WHERE id_oferta = :id_oferta");
		
		$stmt->bindParam(":id_oferta", $datos["id_oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":precioReal", $datos["precioReal"], PDO::PARAM_STR);
		$stmt->bindParam(":precioRebajado", $datos["precioRebajado"], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje", $datos["porcentaje"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarPromocion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_oferta = :id_oferta");

		$stmt -> bindParam(":id_oferta", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}