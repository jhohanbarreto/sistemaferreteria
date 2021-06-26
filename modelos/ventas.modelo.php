<?php 
require_once "conexion.php";
class ModeloVentas{
	/*=============================================
	MOSTRAR VENTAS
	=============================================*/
    static public function mdlMostrarVentas($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item ORDER BY id_venta ASC"); 
            $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
    }else{

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC"); 
    $stmt->execute();
    return $stmt->fetchAll();
    }

    $stmt->close();
    $stmt=null;
	}
	//---------------------------------------------
	static public function mdlMostrarVentas123($tabla, $item, $valor){
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item ORDER BY id_venta DESC"); 
            $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
    }else{

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC"); 
    $stmt->execute();
    return $stmt->fetchAll();
    }

    $stmt->close();
    $stmt=null;
    }
    /*=============================================
	ACTUALIZAR VENTAS
	=============================================*/

	static public function mdlActualizarVentas($tabla, $item1, $valor1, $item2, $valor2){

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
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_usuario, productos, impuesto, neto, total, adelanto, pendiente, metodo_pago, tipo_comprobante) VALUES (:codigo, :id_cliente, :id_usuario, :productos, :impuesto, :neto, :total, :adelanto, :pendiente, :metodo_pago, :tipo_comprobante)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adelanto", $datos["adelanto"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_comprobante", $datos["tipo_comprobante"], PDO::PARAM_STR);

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

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_usuario, productos, impuesto, neto, total, adelanto, pendiente, metodo_pago, tipo_comprobante) VALUES (:codigo, :id_cliente, :id_usuario, :productos, :impuesto, :neto, :total, :adelanto, :pendiente, :metodo_pago, :tipo_comprobante)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adelanto", $datos["adelanto"], PDO::PARAM_STR);
		$stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_comprobante", $datos["tipo_comprobante"], PDO::PARAM_STR);

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

	static public function mdlEliminarVenta($tabla, $datos){
		
			
		

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_venta = :id_venta");

		$stmt -> bindParam(":id_venta", $datos, PDO::PARAM_INT);

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
	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){
		if ($fechaInicial == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC"); 
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
	
	/*=============================================
	ACTUALIZAR PAGO POR PARTES
	=============================================*/
	static public function mdlActualizarDeuda($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item3 = :$item3");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}