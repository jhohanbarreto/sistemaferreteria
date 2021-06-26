<?php
class ControladorProforma{
        /*=============================================
        MOSTRAR VENTAS
        =============================================*/

        static public function ctrMostrarProforma($item, $valor){

            $tabla = "proforma";

            $respuesta = ModeloProforma::mdlMostrarProforma($tabla, $item, $valor);

            return $respuesta;

        }

    /*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearProforma(){

		if(isset($_POST["nuevaProforma"])){


			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "proforma";

			$datos = array("id_usuario"=>$_POST["idproforma"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaProforma"],
						   "compra"=>$_POST["listaProductosProforma"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "descuento"=>$_POST["nuevoDescuento"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			//var_dump($datos);
			$respuesta = ModeloProforma::mdlIngresarProforma($tabla, $datos);
			//var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La proforma ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "proforma";

								}
							})

				</script>';

			}

		}

	}
	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarProforma(){

		if(isset($_POST["editarProforma"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "proforma";

			$item = "codigo";
			$valor = $_POST["editarProforma"];//por a qui traeremos el codigo de la venta correspondiente

			$traerProforma = ModeloProforma::mdlMostrarProforma($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductosProforma"] == ""){
				//
				$listaProductos = $traerProforma["compra"];
				$cambioProducto = false;

				//var_dump($cambioProducto);
			}else{

				$listaProductos = $_POST["listaProductosProforma"];
				
				$cambioProducto = true;
				//var_dump($cambioProducto);
			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_usuario"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarProforma"],
						   "compra"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);

			//var_dump($datos);
			$respuesta = ModeloProforma::mdlEditarProforma($tabla, $datos);
			// var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "proforma";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarProforma(){

		if(isset($_GET["idProforma"])){

			$tabla = "proforma";

			$item = "id_proforma";
			$valor = $_GET["idProforma"];

			$traerVenta = ModeloProforma::mdlMostrarProforma($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloProforma::mdlMostrarProforma($tabla, $itemVentas, $valorVentas);
			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {

				if($value["id_cliente"] == $traerVenta["id_cliente"]){
					//var_dump($value["fecha"]);
				array_push($guardarFechas, $value["fecha"]);

				}

			}
			//var_dump($guardarFechas);

		if(count($guardarFechas) > 1){

			if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

		}


		}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloProforma::mdlEliminarProforma($tabla, $_GET["idProforma"]);
			//var_dump($respuesta);
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "proforma";

								}
							})

				</script>';

			}
		 }

	}

	/*=============================================
	Eliminar Proforma si se genera la proforma
	=============================================*/
	static public function ctrEliminarProforma1(){


			/*=============================================
			ELIMINAR VENTA
			=============================================*/
			$tabla = "proforma";
			$respuesta = ModeloProforma::mdlEliminarProforma($tabla, $_GET["idProformaVenta"]);
			//var_dump($respuesta);
			//var_dump($respuesta);
		 

	}




	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function ctrRangoFechasProforma($fechaInicial, $fechaFinal){

		$tabla = "proforma";

		$respuesta = ModeloProforma::mdlRangoFechasProforma($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}
}
?>