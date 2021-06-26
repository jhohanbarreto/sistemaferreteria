<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/post-venta.controlador.php";
require_once "../modelos/post-venta.modelo.php";
class AjaxPromocion{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID PRODUCTO
  =============================================*/
  public $codigoPromocion;

  public function ajaxCrearCodigoProducto(){

  	$item = "id_producto";
  	$valor = $this->idPromocion;

  	$respuesta = ControladorProductos::ctrMostrarProductos123($item, $valor);

  	echo json_encode($respuesta);

  }

  public $idPromocion;

  public function ajaxEditarPromocion(){

	  $item = "id_oferta";
	  $valor = $this->idPromocion123;

	  $respuesta = ControladorPromocion::ctrMostrarPomocion($item, $valor);

	  echo json_encode($respuesta);


}

public $idPromocion2;

public function ajaxEnviarPromocion(){

	$item = "id_oferta";
	$valor = $this->idPromocion2;

	$respuesta = ControladorPromocion::ctrMostrarPomocion($item, $valor);

	echo json_encode($respuesta);

}

public $idPromocion3;

public function ajaxEnviarPromocion5(){

	$item = "id_producto";
	$valor = $this->idPromocion5;

	$respuesta1 = ControladorPromocion::ctrMostrarPomocion123($item, $valor);

	echo json_encode($respuesta1);

}

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID PRODUCTO
=============================================*/	

if(isset($_POST["idPromocion"])){

	$codigoPromocion = new AjaxPromocion();
	$codigoPromocion ->idPromocion= $_POST["idPromocion"];
	$codigoPromocion ->ajaxCrearCodigoProducto();

}

/*=============================================
EDITAR PROMOCION
=============================================*/	

if(isset($_POST["idPromocion123"])){

	$idPromocion = new AjaxPromocion();
	$idPromocion ->idPromocion123 = $_POST["idPromocion123"];
	$idPromocion ->ajaxEditarPromocion();

}
/*=============================================
TRAER DATOS DE LA PROMOCI[ON]
=============================================*/	

if(isset($_POST["idPromocion2"])){

	$idPromocion2 = new AjaxPromocion();
	$idPromocion2 ->idPromocion2 = $_POST["idPromocion2"];
	$idPromocion2 ->ajaxEnviarPromocion();

}

/*=============================================
TRAER DATOS DE LA PROMOCI[ON]
=============================================*/	

if(isset($_POST["idProducto"])){

	$idPromocion3 = new AjaxPromocion();
	$idPromocion3 ->idPromocion5 = $_POST["idProducto"];
	$idPromocion3 ->ajaxEnviarPromocion5();

}