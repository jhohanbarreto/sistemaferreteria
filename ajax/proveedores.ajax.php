<?php
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

/*=============================================
EDITAR PROVEEDOR
=============================================*/ 

class ajaxProveedor{

    public $idProveedor;
    public function ajaxEditarProveedor(){
            $item = "id_proveedor";
            $valor = $this->idProveedor;
            $respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

            echo json_encode($respuesta);
    }


     /*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarProveedor;
	public $activarId;

	public function ajaxActivarProveedor(){

		$tabla = "proveedores";

		$item1 = "estado";
		$valor1 = $this->activarProveedor;

		$item2 = "id_proveedor";
		$valor2 = $this->activarId;

		$respuesta = ModeloProveedores::mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2);

    }
}

/*=============================================
EDITAR PROVEEDOR
=============================================*/ 

if(isset($_POST["idProveedor"])){

    $editarProveedor = new ajaxProveedor();
    $editarProveedor ->idProveedor = $_POST["idProveedor"];
    $editarProveedor ->ajaxEditarProveedor();
}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarProveedor"])){

	$activarProveedor1 = new ajaxProveedor();
	$activarProveedor1 ->activarProveedor = $_POST["activarProveedor"];
	$activarProveedor1 ->activarId = $_POST["activarId"];
	$activarProveedor1 -> ajaxActivarProveedor();

}