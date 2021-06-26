<?php
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/ventas.controlador.php";

class ajaxVentas{


    public $metodoComprobante;
    public function ajaxmetodoComprobante(){
            
            $item = "tipo_comprobante"; //para que trae todos los datos
            $valor = $this->metodoComprobante;
            $respuesta = ControladorVentas::ctrMostrarVentas123($item, $valor);

            echo json_encode($respuesta);


    }

    /*=============================================
	TRAER VENTAS
	=============================================*/
	public $TraerVentas;
    public function ajaxTraerVentas(){
            
            $item = "id_venta"; //para que trae todos los datos
            $valor = $this->TraerVentas;
            $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

            echo json_encode($respuesta);


	}
	

    /*=============================================
	ACTIVAR ESTADO VENTAS
	=============================================*/	

	public $activarProveedor;
	public $activarId;

	public function ajaxActivarVentas(){

		$tabla = "ventas";

		$item1 = "estado";
		$valor1 = $this->activarVentas;

		$item2 = "id_venta";
		$valor2 = $this->activarId;

		$respuesta = ModeloVentas::mdlActualizarVentas($tabla, $item1, $valor1, $item2, $valor2);

    }

}




/*=============================================
REVISAR Producto REPETIDO editada
=============================================*/
if (isset($_POST["metodoComprobante"])) {
    $traerComprobante = new ajaxVentas();
    $traerComprobante ->metodoComprobante = $_POST["metodoComprobante"];
    $traerComprobante ->ajaxmetodoComprobante();
}

/*=============================================
Para traer todos los productos
=============================================*/	

if(isset($_POST["activarId"])){

	$TraerVentas = new ajaxVentas();
	$TraerVentas ->TraerVentas = $_POST["activarId"];
	$TraerVentas -> ajaxTraerVentas();

}

/*=============================================
ACTIVAR ESTADO VENTAS
=============================================*/	

if(isset($_POST["activarVentas"])){

	$activarVentas = new ajaxVentas();
	$activarVentas ->activarVentas = $_POST["activarVentas"];
	$activarVentas ->activarId = $_POST["activarId"];
	$activarVentas -> ajaxActivarVentas();

}