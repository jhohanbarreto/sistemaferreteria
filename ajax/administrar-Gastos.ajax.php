<?php
require_once "../controladores/administrar-Gastos.controlador.php";
require_once "../modelos/administrar-Gastos.modelo.php";



class ajaxGastos{
    /*=============================================
    GENERAR CODIGO A PARTIR DE ID CATEGORIA
    =============================================*/
    public $idCategoria;
    public function ajaxCrearCodigoGastos(){

        $item = "id_gasto";
        $valor = $this->idCategoria;
        
        $respuesta = ControladorGastos::ctrMostrarGasto($item,$valor);
        echo json_encode($respuesta);
    }
        public $idGasto;

        public function ajaxEditarGasto(){
            $item = "id_gasto";
            $valor = $this->idGasto;
            // $orden = "id_producto";

            $respuesta = ControladorGastos::ctrMostrarGasto($item, $valor);

            echo json_encode($respuesta);
        }
}


/*=============================================
    GENERAR CODIGO A PARTIR DE ID CATEGORIA
=============================================*/
if (isset($_POST["idCategoria"])) {
    $codigoProducto = new ajaxGastos();
    $codigoProducto->idCategoria = $_POST["idCategoria"];
    $codigoProducto->ajaxCrearCodigoGastos();
}

/*=============================================
EDITAR GASTO
=============================================*/ 

if(isset($_POST["idGasto"])){

    $editarGasto = new ajaxGastos();
    $editarGasto ->idGasto = $_POST["idGasto"];
    $editarGasto ->ajaxEditarGasto();
  
  }