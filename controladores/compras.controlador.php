<?php
class ControladorCompras{

	
	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/ 


	static public function ctrMostrarCompra($item, $valor){

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

		return $respuesta;
    }

    /*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearCompra(){

		if(isset($_POST["nuevaCompra"])){


			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "compras";

			$datos = array("id_usuario"=>$_POST["idComprador"],
						   "id_proveedor"=>$_POST["seleccionarProveedor"],
						   "codigo"=>$_POST["nuevaCompra"],
						   "compras"=>$_POST["listaProductosCompra"],
						   "total"=>$_POST["totalVenta"]);

			//var_dump($datos);
			$respuesta = ModeloCompras::mdlIngresarCompras($tabla, $datos);
			//var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La compra se ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-Compras";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarCompra(){

		if(isset($_POST["editarCompra"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "compras";

			$item = "codigo";
			$valor = $_POST["editarCompra"];//por a qui traeremos el codigo de la venta correspondiente

			$traerCompras = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductosCompra"] == ""){
				//
				$listaProductos = $traerCompras["compras"];
				$cambioProducto = false;

				//var_dump($cambioProducto);
			}else{

				$listaProductos = $_POST["listaProductosCompra"];
				
				$cambioProducto = true;
				//var_dump($cambioProducto);
			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	


			$datos = array("id_usuario"=>$_POST["idComprador"],
						   "id_proveedor"=>$_POST["seleccionarProveedor"],
						   "codigo"=>$_POST["editarCompra"],
						   "compras"=>$_POST["listaProductosCompra"],
						   "total"=>$_POST["totalVenta"]);

			//var_dump($datos);
			$respuesta = ModeloCompras::mdlEditarCompras($tabla, $datos);
			//var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La compra se ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-Compras";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR COMPRA
	=============================================*/

	static public function ctrEliminarCompra(){

		if(isset($_GET["idCompra"])){
			$tabla= "compras";

			$respuesta = ModeloCompras::mdlEliminarCompra($tabla, $_GET["idCompra"]);
			//var_dump($respuesta);
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La compra ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-Compras";

								}
							})

				</script>';

			}
		 }

	}


	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasCompras($fechaInicial, $fechaFinal){

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlRangoFechasCompras($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarCompras(){

		if(isset($_GET["reporte-compras"])){

			$tabla = "compras";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$compras = ModeloCompras::mdlRangoFechasCompras($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$compras = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte-compras"].'.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>COMPRADOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($compras as $row => $item){

				$proveedor = ControladorProveedores::ctrMostrarProveedores("id_proveedor", $item["id_proveedor"]);
				$comprador = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $item["id_usuario"]);
			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$proveedor["nombre_proveedor"]."</td>
			 			<td style='border:1px solid #eee;'>".$comprador["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

						 $productos =  json_decode($item["compras"], true); 

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}


		 		echo utf8_decode("</td>	
					<td style='border:1px solid #eee;'>S/ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>	
		 			</tr>");


			}


			echo "</table>";

		}
		

	}

}
