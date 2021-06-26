<?php
require_once "../modelos/compras.modelo.php";

require_once "../controladores/compras.controlador.php";

class ajaxCompras{


    public $traerCompra;
    public function ajaxmetodoCompras(){
            
            $item = "id_compra"; //para que trae todos los datos
            $valor = $this->traerCompra;
            $respuesta = ControladorCompras::ctrMostrarCompra($item, $valor);

            echo json_encode($respuesta);


    }
    public $activarCompras;
	public $activarId;

	public function ajaxActivarCompras(){

		$tabla = "compras";

		$item1 = "estado";
		$valor1 = $this->activarId;

		$item2 = "id_compra";
		$valor2 = $this->activarCompras;

		$respuesta = ModeloCompras::mdlActualizarCompras($tabla, $item1, $valor1, $item2, $valor2);

    }

}




/*=============================================
REVISAR Producto REPETIDO editada
=============================================*/
if (isset($_POST["idCompra"])) {
    $traerCompra = new ajaxCompras();
    $traerCompra ->traerCompra = $_POST["idCompra"];
    $traerCompra ->ajaxmetodoCompras();
}

/*=============================================
ACTIVAR ESTADO CON UN CLICK
=============================================*/
if(isset($_POST["activarVentas"])){

	$activarCompras = new ajaxCompras();
	$activarCompras ->activarCompras = $_POST["idCompra"];
	$activarCompras ->activarId = $_POST["activarVentas"];
	$activarCompras -> ajaxActivarCompras();

}
