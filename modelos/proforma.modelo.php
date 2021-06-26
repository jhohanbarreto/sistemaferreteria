<?php 
require_once "conexion.php";
class ModeloProforma{
        /*=============================================
        MOSTRAR VENTAS
        =============================================*/
        static public function mdlMostrarProforma($tabla, $item, $valor){
            if ($item != null) {
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item ORDER BY id_proforma ASC"); 
                    $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
                    $stmt->execute();
                    return $stmt->fetch();
            }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_proforma ASC"); 
            $stmt->execute();
            return $stmt->fetchAll();
            }

            $stmt->close();
            $stmt=null;
        }
    /*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarProforma($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_usuario, compra, impuesto, descuento, neto, total) VALUES (:codigo, :id_cliente, :id_usuario, :compra, :impuesto, :descuento, :neto, :total)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":compra", $datos["compra"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
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

	static public function mdlEditarProforma($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_usuario = :id_usuario, compra = :compra, impuesto = :impuesto, neto = :neto, total= :total WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":compra", $datos["compra"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
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

	static public function mdlEliminarProforma($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_proforma = :id_proforma");

		$stmt -> bindParam(":id_proforma", $datos, PDO::PARAM_INT);

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
	static public function mdlRangoFechasProforma($tabla, $fechaInicial, $fechaFinal){
		if ($fechaInicial == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_proforma ASC"); 
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
	
				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2 ->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
	
				if($fechaFinalMasUno == $fechaActualMasUno){
	
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
	
				}else{
	
	
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
	
				}
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}	
}

?>