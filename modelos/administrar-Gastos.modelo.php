<?php 
require_once "conexion.php";

class ModeloGastos{
    
    /*--=====================================
    Mostrar Categoria
    ======================================-*/
    static public function mdlMostrarGastos($tabla, $item, $valor){
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

    static public function mdlIngresarGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoriagastos, codigo, descripcion, monto) VALUES (:id_categoriagastos, :codigo, :descripcion, :monto)");

		$stmt->bindParam(":id_categoriagastos", $datos["id_categoriagastos"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
    /*=============================================
	EDITAR GASTO
	=============================================*/
	static public function mdlEditarGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoriagastos = :id_categoriagastos, descripcion = :descripcion, monto = :monto WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoriagastos", $datos["id_categoriagastos"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);

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

	static public function mdlEliminarGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_gasto = :id_gasto");

		$stmt -> bindParam(":id_gasto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}