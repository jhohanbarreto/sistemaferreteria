<?php
error_reporting(0);
class ControladorVentas{
    /*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

		// var_dump($respuesta);

	}

	static public function ctrMostrarVentas123($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas123($tabla, $item, $valor);

		return $respuesta;

		//var_dump($respuesta);

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/
			$listaProductos = json_decode($_POST["listaProductos"], true);

			//var_dump($listaProductos);
			$totalProductosComprados = array();//para la suma de cantidad

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id_producto";
				$valor = $value["id_producto"];
				$orden = "id_producto";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);
					//var_dump($traerProducto["ventas"]);

				//para la cantidad de compras
				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
				$item1b = "stock";
				$valor1b = $value["stock"];
				
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				

			}
			$tablaClientes = "clientes";

			$item = "id_cliente";
			$valor = $_POST["seleccionarCliente"];
			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);
			//var_dump( $traerCliente["compras"]);

        	//actualizar clientes
			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
			//para que la fecha y hora del ultimo que izo una compra el cliente
			$item1b = "ultima_compra";

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			

			if($_POST["nuevoCambioPendiente"]){
				$pendiente = str_replace(array(","), "", $_POST["nuevoCambioPendiente"]);

			}else{
				$pendiente = 0;
			}

			
			if($_POST["nuevoValorAdelanto"]){

				$adelanto = str_replace(array(","), "", $_POST["nuevoValorAdelanto"]);
			}else{
				$adelanto = 0;
			}

			// var_dump($adelanto);
			$tabla = "ventas";
			$datos = array("id_usuario"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "adelanto"=>$adelanto,
						   "pendiente"=>$pendiente,
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   //"ruc"=>$_POST["ruc"],
						   "tipo_comprobante"=>$_POST["listarComprobante"]);

			//var_dump($datos);
			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
			//var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}

    /*=============================================
	GENERAR  VENTA  APARTIR DE UNA PROFORMA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["nuevaVenta"])){

			$tabla1234 = "ventas";

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "proforma";

			$item = "codigo";
			$valor = $_POST["agregarProducto1"];//por a qui traeremos el codigo de la venta correspondiente

			$traerVenta = ModeloProforma::mdlMostrarProforma($tabla, $item, $valor);

			var_dump($traerVenta);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){
				//
				$listaProductos = $traerVenta["compra"];
				$cambioProducto = true;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = false;
		
			}

			if($cambioProducto){


				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				//var_dump($listaProductos);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id_producto";
					$valor_2 = $value["id_producto"];
					$orden = "id_producto";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2,$orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id_cliente";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);


				$tablaVentas_3 = "ventas";

				$item_3 = "id_venta";
				$valor_3 = $_POST["nuevoComprobante"];

				$traerCliente_3 = ModeloVentas::mdlMostrarVentas($tablaVentas_3, $item_3, $valor_3);


				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Lima');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}else{

				$listaProductos_2 = json_decode($listaProductos, true);

				//var_dump($listaProductos);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id_producto";
					$valor_2 = $value["id_producto"];
					$orden = "id_producto";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2,$orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}




				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Lima');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}
			if($_POST["nuevoCambioPendiente"]){
				$pendiente = str_replace(array(","), "", $_POST["nuevoCambioPendiente"]);

			}else{
				$pendiente = 0;
			}

			
			if($_POST["nuevoValorAdelanto"]){

				$adelanto = str_replace(array(","), "", $_POST["nuevoValorAdelanto"]);
			}else{
				$adelanto = 0;
			}

			/*=============================================
			 GUARDAR CAMBIOS DE LA COMPRA
			 =============================================*/	

			$datos = array("id_usuario"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "adelanto"=>$adelanto,
						   "pendiente"=>$pendiente,
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "tipo_comprobante"=>$_POST["listarComprobante"]);
			//var_dump($datos);
			$respuesta = ModeloVentas::mdlEditarVenta($tabla1234, $datos);
			

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta se a realizado correctamente",
					  showConfirmButton: true,
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';
				$valor15=$_POST["idVendedora"];
				$tabla15 = "proforma";
				$respuesta = ModeloProforma::mdlEliminarProforma($tabla15, $valor15);

			}
		}
		

	}

	// /*=============================================
	// ELIMINAR VENTA
	// =============================================*/

	// static public function ctrEliminarVenta($valor15){


	// 	$tabla15 = "proforma";

	// 	$respuesta = ModeloProforma::mdlEliminarProforma($tabla15, $valor15);
	// 	return $respuesta;
					

	// }

	/*=============================================
	 ACTUALIZAR STOCK DEL LA VENTA
	=============================================*/
	static public function ctrActualizarVenta(){
	
		if(isset($_POST["nuevoRestanteDeuda"])){

			if(preg_match('/^[\.\0-9]+$/', $_POST["nuevoRestanteDeuda"])){

				$tabla = "ventas";

				$item1 = "pendiente";
				$datos1 = $_POST["nuevoRestanteDeuda"];

				$item2 = "adelanto";
				$datos2 = $_POST["nuevoPagoDeuda"] + $_POST["nuevoAdelantoDeuda"];

				$item3 = "id_venta";
				$datos3 = $_POST["llevandoId"];


				//var_dump($item1,$datos1,$item2,$datos2,$datos3);
			$respuesta = ModeloVentas::mdlActualizarDeuda($tabla, $item1, $datos1, $item2, $datos2, $item3, $datos3);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El pago ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';

			}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El pago no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventas";

							}
						})

			  	</script>';
			}
		}
	}


	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $item["id_usuario"]);
			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
						 <td style='border:1px solid #eee;'>");
						 
						 $productos =  json_decode($item["productos"], true); 

						 foreach ($productos as $key => $valueProductos) {
								 
								 echo utf8_decode($valueProductos["cantidad"]."<br>");
							 }
		
						 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
		
						 foreach ($productos as $key => $valueProductos) {
								 
							 echo utf8_decode($valueProductos["descripcion"]."<br>");
						 
						 }


		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>S/ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>S/ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>S/ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>	
		 			</tr>");


			}


			echo "</table>";

		}
		

	}
	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

}

