<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id_cliente";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}
	/*=============================================
    REVISAR CATEGORIA REPETIDO
    =============================================*/

    public $validardni;
    public function ajaxvalidardni(){
        $item = "documento";
        $valor = $this->validardni;
        $respuesta = ControladorClientes::ctrMostrarClientes($item,$valor);
        
        echo json_encode($respuesta);

	}
	
	public $promocioncliente;
    public function ajaxpromocioncliente(){
        $item = "id_cliente";
        $valor = $this->promocioncliente;
        $respuesta = ControladorClientes::ctrMostrarClientes($item,$valor);
        
        echo json_encode($respuesta);

    }

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}
/*=============================================
REVISAR Producto REPETIDO editada
=============================================*/
if (isset($_POST["validardni"])) {
    $validardni = new AjaxClientes();
    $validardni ->validardni = $_POST["validardni"];
    $validardni ->ajaxvalidardni();
}

/*=============================================
PARA LA PROMOCION
=============================================*/
if (isset($_POST["idPromocion3"])) {
    $promocioncliente = new AjaxClientes();
    $promocioncliente ->promocioncliente = $_POST["idPromocion3"];
    $promocioncliente ->ajaxpromocioncliente();
}