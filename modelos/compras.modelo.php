<?php
require_once "conexion.php";
class ModeloCompras{

	
        /*=============================================
        MOSTRAR PROVEEDOR
        =============================================*/ 


        static public function mdlMostrarCompras($tabla, $item, $valor){

            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item ORDER BY id_compra ASC"); 
                $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
        }else{

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_compra ASC"); 
        $stmt->execute();
        return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt=null;
        }
    /*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlIngresarCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_proveedor, id_usuario, compras, total) VALUES (:codigo, :id_proveedor, :id_usuario, :compras, :total)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":compras", $datos["compras"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
    /*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_proveedor = :id_proveedor, id_usuario = :id_usuario, compras = :compras, total= :total WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":compras", $datos["compras"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	
	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_compra = :id_compra");

		$stmt -> bindParam(":id_compra", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR COMPRAS
	=============================================*/

	static public function mdlActualizarCompras($tabla, $item1, $valor1, $item2, $valor2){

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
	BUSQUEDA POR FECHAS
	=============================================*/
	static public function mdlRangoFechasCompras($tabla, $fechaInicial, $fechaFinal){
		if ($fechaInicial == null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_compra ASC"); 
			$stmt->execute();
			return $stmt->fetchAll();
	}else if($fechaInicial == $fechaFinal){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'"); 
			$stmt->bindParam(":fecha", $fechaFinal,PDO::PARAM_STR);
			
			$stmt->execute();
			return $stmt->fetchAll();
		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal23 = new DateTime($fechaFinal);
			$fechaFinal23 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal23->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		$stmt->execute();
		return $stmt->fetchAll();
	}

}
}