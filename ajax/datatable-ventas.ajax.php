<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaVentas{
    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaVentas(){
        //para traer toda la informacion de la bd necesitamos encluir reuier_once
        $item = null;
        $valor = null;
        $orden = "id_producto"; //con que queremos ordenar

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
                        $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto ='".$productos[$i]["id_producto"]."'>Agregar</i></button></div>";

                        $datosJson .='[
                            "'.($i+1).'",
                            "'.$imagen.'",
                            "'.$productos[$i]["codigo"].'",
                            "'.$productos[$i]["descripcion"].'",
                            "'.'S/ '.$productos[$i]["precio_venta"].'",
                            "'.$stock.'",
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
$activarProductos = new TablaVentas();
$activarProductos-> mostrarTablaVentas();