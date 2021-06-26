<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos{
    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaProductos(){
        //para traer toda la informacion de la bd necesitamos encluir reuier_once
        $item = null;
        $valor = null;
        $orden = "id_producto";

        $productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
           
            
            //caso para los botones
            

            //para concatenar .=
        $datosJson = '{
                    "data": [';
                    //recorrido de lavarible $productos
                    for ($i=0; $i < count($productos) ; $i++) { 
                        /*=============================================
                        PARA LA IMAGEN
                        =============================================*/
                        if ($productos[$i]["imagen"] != "") {

                            $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
                        }else{
                            $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";
                        }
                        
                        /*=============================================
                        PARA LA CATEGORIA
                        =============================================*/
                        //agregaremos las categorias de la bd
                        $item = "id_categoria";
                        $valor = $productos[$i]["id_categoria"];

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);

                        /*=============================================
                        STOCK PARA VER LA CANTIDAD
                        =============================================*/
                        if ($productos[$i]["stock"] <= 10) {
                            $stock ="<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                        }else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){
                            //para cambiar el color
                            $stock ="<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
                        }else{
                            $stock ="<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
                        }

                        /*=============================================
                        PARA EDITAR O ELIMINAR
                        =============================================*/
                        //caso para los botones
                        if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

                        $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' id='btnEditarProducto' idProducto ='".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";
                        }else{
                        $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_producto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger  btnEliminarProducto' idProducto='".$productos[$i]["id_producto"]."' codigo='".$productos[$i]["codigo"]."' imagen=    '".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

                    }
                        $datosJson .='[
                            "'.($i+1).'",
                            "'.$imagen.'",
                            "'.$productos[$i]["codigo"].'",
                            "'.$productos[$i]["descripcion"].'",
                            "'.$categorias["categoria"].'",
                            "'.$stock.'",
                            "'.'S/ '.$productos[$i]["precio_compra"].'",
                            "'.'S/ '.$productos[$i]["precio_venta"].'",
                            "'.$productos[$i]["fecha"].'",
                            "'.$botones.'"
                          ],'; //, es para la separacion de filas pero la ultima fila no tiene que ir con comas 
                        }
                        //para quitar la ultima coma
                        $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;

       
    }
}

/*=============================================
ATIVAR LA TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos-> mostrarTablaProductos();