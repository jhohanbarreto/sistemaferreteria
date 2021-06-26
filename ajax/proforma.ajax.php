<?php
require_once "../modelos/proforma.modelo.php";

require_once "../controladores/proforma.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/ventas.controlador.php";

class ajaxMensaje{


    public $metodoComprobante;
    public function ajaxmetodoProforma(){
            
        //$tabla = "proforma";
		$valor15 = $this->metodoComprobante;

		$respuesta = ControladorVentas::ctrEliminarVenta($valor15);


    }
}

/*=============================================
REVISAR Producto REPETIDO editada
=============================================*/
if (isset($_POST["idProformaVenta"])) {
    $traerComprobante = new ajaxMensaje();
    $traerComprobante ->metodoComprobante = $_POST["idProformaVenta"];
    $traerComprobante ->ajaxmetodoProforma();
}