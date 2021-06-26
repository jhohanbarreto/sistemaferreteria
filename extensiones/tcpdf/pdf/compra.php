<?php
require_once "../../../controladores/compras.controlador.php";
require_once "../../../modelos/compras.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirCompra{

public $codigo;//de esa manera se dara el valor 
	
public function traerImpresionCompra(){
	
//TRAEMOS LA INFORMACIÓN DE LA VENTA
	
$itemCompra = "codigo";
$valorCompra = $this->codigo;

$respuestaCompra = ControladorCompras::ctrMostrarCompra($itemCompra, $valorCompra);

$fecha = substr($respuestaCompra["fecha"],0,-8);
$productos = json_decode($respuestaCompra["compras"], true);
// $neto = number_format($respuestaCompra["neto"],2);
// $impuesto = number_format($respuestaCompra["impuesto"],2);
$total = number_format($respuestaCompra["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id_proveedor";
$valorCliente = $respuestaCompra["id_proveedor"];

$respuestaproveedor = ControladorProveedores::ctrMostrarProveedores($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id_usuario";
$valorVendedor = $respuestaCompra["id_usuario"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
//esta variable instancia la clase TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//grupo de paginas para poder agregar varias paginas
$pdf->startPageGroup();
//una pagina (no se puede tirar haia delante votaria errores)
$pdf->AddPage();

// ---------------------------------------------------------
//bloque de maquetacion 
//recuerde que cantidad de pixel que se debe utilzar es 540px
$bloque1 = <<<EOF
	
	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/Mapa.png"></td>

			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
						
					<br>
					RUC: 71.759.963-9

					<br>
					Dirección: Calle 44B 92-11

				</div>
				
			</td>
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 936528223
					
					<br>
					ferrecolonio@gmail.com

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>COMPRA N.<br>$valorCompra</td>

		</tr>

	</table>

EOF;

//ejecutar el metodo de escribir html
$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$bloque1 = <<<EOF
	<table>
			
		<tr>
					<!--para que no quede apegado a la cabeza utilizare imagenes en blanco-->

			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 0px solid #999; background-color:white; width:390px">

				Proveedor: $respuestaproveedor[nombre_proveedor]

			</td>

			<td style="border: 0px solid #999; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>

			<td style="border: 0px solid #999; background-color:white; width:540px">Comprador: $respuestaVendedor[nombre]</td>

		</tr>

		<tr>
					<!--para que no quede apegado a la cabeza utilizare imagenes en blanco-->
			<td style="border-bottom: 0px solid #999; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:4px 10px;">

		<tr>
		
		<td style="border: 1px solid #555; background-color:white; width:400px; text-align:center">Producto</td>
		<td style="border: 1px solid #555; background-color:white; width:140px; text-align:center">Cantidad</td>
		
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//como los productos lo estamos convirtiendo con datos json entonces podemos recorrer con un foreach
foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;
	
$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
//para saber el precio untario
$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);
	
$precioTotal = number_format($item["total"], 2);


$bloque4 = <<<EOF

	<table style="font-size:9px; padding:2px 10px;">

		<tr>
			
			<td style="border: 0px solid #999; color:#333; background-color:white; width:400px;">
				$item[descripcion]
			</td>

			<td style="border: 0px solid #999; color:#333; background-color:white; width:140px; text-align:center">
				$item[cantidad]
			</td>

			


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}

// ---------------------------------------------------------




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('compras.pdf');
}
}

//capturaremos por medio de get
$factura = new imprimirCompra();
$factura ->codigo = $_GET["codigo"];
$factura -> traerImpresionCompra();
?>