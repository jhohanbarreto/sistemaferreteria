<?php
require_once "../controladores/categoriaGastos.controlador.php";
require_once "../modelos/categoriaGastos.modelo.php";

class AjaxCategoriasGastos{

    /*=============================================
    EDITAR CATEGORIA
    =============================================*/
    public $idCategoriaGastos;
    public function ajaxEditarCategoriaGastos(){
        $item = "id_categoriaGastos";
        $valor = $this->idCategoriaGastos;
        $respuesta = ControladorCategoriaGastos::ctrMostrarCategoriaGasto($item,$valor);
        
        echo json_encode($respuesta);
    }


    /*=============================================
    REVISAR CATEGORIA REPETIDO
    =============================================*/

    // public $validarCategoria;
    // public function ajaxValidarCategoria(){
    //     $item = "categoria";
    //     $valor = $this->validarCategoria;
    //     $respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);
        
    //         echo json_encode($respuesta);

    // }


}




/*=============================================
EDITAR CATEGORIA
=============================================*/
if (isset($_POST["idCategoriaGastos"])) {
    $CategoriaGasto = new AjaxCategoriasGastos();
    $CategoriaGasto->idCategoriaGastos = $_POST["idCategoriaGastos"];
    $CategoriaGasto->ajaxEditarCategoriaGastos();
}







/*=============================================
REVISAR CATEGORIA REPETIDO
=============================================*/
// if (isset($_POST["validarCategoria"])) {
//     $valCategoria = new AjaxCategoriasGastos();
//     $valCategoria->validarCategoria = $_POST["validarCategoria"];
//     $valCategoria->ajaxValidarCategoria();
// }
