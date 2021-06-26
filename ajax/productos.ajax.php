<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class ajaxProductos{
    /*=============================================
    GENERAR CODIGO A PARTIR DE ID CATEGORIA
    =============================================*/
    public $idCategoria;
    public function ajaxCrearCodigoProducto(){

        $item = "id_categoria";
        $valor = $this->idCategoria;
        $orden = "id_producto"; //tambien puede ser null por que en el modelo ya esta restringido por id
        $respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
        echo json_encode($respuesta);
    }

      /*=============================================
    EDITAR PRODUCTO
    =============================================*/ 

    public $idProducto;
    //para dispositivo 
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditarProducto(){
        if ($this->traerProductos == "ok") {
            $item = null; //para que trae todos los datos
            $valor = null;
            $orden = "id_producto";

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

        echo json_encode($respuesta);

        }else if($this->nombreProducto != ""){
        $item = "descripcion";
        $valor = $this->nombreProducto;
        $orden = "id_producto";

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

        echo json_encode($respuesta);

        }else{
            $item = "id_producto";
            $valor = $this->idProducto;
            $orden = "id_producto";

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

            echo json_encode($respuesta);
        }
    }


    /*=============================================
    REVISAR CATEGORIA REPETIDO
    =============================================*/

    public $validarProducto;
    public function ajaxvalidarProducto(){
        $item = "descripcion";
        $valor = $this->validarProducto;
        $respuesta = ControladorProductos::ctrMostrarProductos123($item,$valor);
        
        echo json_encode($respuesta);

    }

    /*=============================================
    REVISAR CATEGORIA REPETIDO
    =============================================*/

    public $cambiarProducto;
    public function ajaxCambiarProducto(){
        $item = "id_producto";
        $valor = $this->cambiarProducto;
        $respuestaCambio = ControladorProductos::ctrMostrarProductoscambios($item,$valor);
        
        echo json_encode($respuestaCambio);

    }

    /*=============================================
    ACTUALIZAR PRODUCTO
    =============================================*/

    public $actualizarProducto;
    public function ajaxActualizarProducto(){
      $tabla = "productos";

      $item1 = "stock";
      $valor1 = $this->actualizarProducto;

      $item2 = "id_producto";
      $valor2 = $this->actualizarId;
  
  
      $respuesta = ModeloProductos::mdlActualizarStock($tabla, $item1, $valor1, $item2, $valor2);

    }

}




/*=============================================
    GENERAR CODIGO A PARTIR DE ID CATEGORIA
=============================================*/
if (isset($_POST["idCategoria"])) {
    $codigoProducto = new ajaxProductos();
    $codigoProducto->idCategoria = $_POST["idCategoria"];
    $codigoProducto->ajaxCrearCodigoProducto();
}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

    $editarProducto = new AjaxProductos();
    $editarProducto ->idProducto = $_POST["idProducto"];
    $editarProducto ->ajaxEditarProducto();
  
  }
  /*=============================================
TRAER PRODUCTOS dispositivo movil
=============================================*/ 

if(isset($_POST["traerProductos"])){

    $traerProductos = new AjaxProductos();
    $traerProductos ->traerProductos = $_POST["traerProductos"];
    $traerProductos ->ajaxEditarProducto();
  
  }
    /*=============================================
TRAER PRODUCTOS dispositivo movil
=============================================*/ 

if(isset($_POST["nombreProducto"])){

    $traerProductos = new AjaxProductos();
    $traerProductos ->nombreProducto = $_POST["nombreProducto"];
    $traerProductos ->ajaxEditarProducto();
  
  }

/*=============================================
REVISAR Producto REPETIDO editada
=============================================*/
if (isset($_POST["validarProducto"])) {
    $validarProducto = new ajaxProductos();
    $validarProducto ->validarProducto = $_POST["validarProducto"];
    $validarProducto ->ajaxvalidarProducto();
}

if(isset($_POST["idCambiarproducto"])){

    $cambiarProducto = new AjaxProductos();
    $cambiarProducto ->cambiarProducto = $_POST["idCambiarproducto"];
    $cambiarProducto ->ajaxCambiarProducto();
  
  }



  if(isset($_POST["activarStock"])){


    $actualizarProducto = new AjaxProductos();
    $actualizarProducto ->actualizarProducto = $_POST["activarStock"];
    $actualizarProducto ->actualizarId = $_POST["idProducto"];
    $actualizarProducto ->ajaxActualizarProducto();
  
  }
