<?php
require_once "conexion.php";
class ModeloProveedores{
        
    /*=============================================
    MOSTRAR PROVEEDOR
    =============================================*/ 

    static public function mdlMostrarProveedores($tabla, $item, $valor){

    if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item"); 
            $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
    }else{

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    $stmt->execute();
    return $stmt->fetchAll();
    }

    $stmt->close();
    $stmt=null;
    }

    /*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarProveedores($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_proveedor, nombre_representante, correo, dni, ruc, celular, telefono) VALUES (:nombre_proveedor, :nombre_representante, :correo, :dni, :ruc, :celular, :telefono)");

		$stmt->bindParam(":nombre_proveedor", $datos["nombre_proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_representante", $datos["nombre_representante"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	ACTUALIZAR TRABAJO
	=============================================*/

	static public function mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2){

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
    
    
    /*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_proveedor = :nombre_proveedor, nombre_representante = :nombre_representante, correo=:correo, ruc = :ruc, celular = :celular, telefono = :telefono  WHERE dni = :dni");

		$stmt->bindParam(":nombre_proveedor", $datos["nombre_proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_representante", $datos["nombre_representante"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function mdlEliminarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_proveedor = :id_proveedor");

		$stmt -> bindParam(":id_proveedor", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	    


}
