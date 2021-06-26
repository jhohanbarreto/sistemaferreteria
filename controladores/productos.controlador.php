<?php
class ControladorProductos{

    /*=============================================
	MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProductos($item,$valor,$orden){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
		return $respuesta;
		//var_dump($respuesta);
	}
	
	/*=============================================
	MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProductos123($item,$valor){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos123($tabla,$item,$valor);
		return $respuesta;

	}
	
		/*=============================================
	MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProductoscambios($item,$valor){
        $tabla = "productos";
        $respuestaCambio = ModeloProductos::mdlMostrarProductos123($tabla,$item,$valor);
		return $respuestaCambio;

    }


    /*=============================================
	CREAR PRODUCTOS
    =============================================*/
    static public function ctrCrearProductos(){
        if (isset($_POST["nuevaDescripcion"])) {
            if(preg_match('/^[a-zA-Z0-\_\,\+\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"])&&
              preg_match('/^[0-9]+$/', $_POST["nuevoStock"])&&
			  preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"])&&
			  preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

                /*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";
				if(isset($_FILES["nuevaImagen"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];
					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					//["type"]->propiedad
					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){ 
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);					

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); 
						//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//guarda la foto en la ruta asignada
						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);				

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = "productos";
                
                $datos = array("id_categoria" => $_POST["nuevaCategoria"],
                                "codigo" => $_POST["nuevoCodigo"],
                                "descripcion" => $_POST["nuevaDescripcion"],
                                "stock" => $_POST["nuevoStock"],
								"precio_compra" => $_POST["nuevoPrecioCompra"],
								"precio_venta" => $_POST["nuevoPrecioVenta"],
                                //"fecha" => $_POST["nuevoStock"],
                                "imagen"=>$ruta);
        
                
                    $respuesta = ModeloProductos::mdlIngresarProductos($tabla,$datos);

                    if($respuesta == "ok"){

                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡El producto ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "productos";
    
                            }
    
                        });
                    
    
                        </script>';
    
    
                    }

            }else{
                    echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "productos";

						}

					});
				

				    </script>';
                }
            
        }
        
    }

    /*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarDescripcion"])){
			
			if(preg_match('/^[a-zA-Z0-\_\,\+\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
			   preg_match('/^[0-9]+$/', $_POST["aumentarStock"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["imagenActual"];

			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				$x = $_POST["editarStock"] + $_POST["aumentarStock"];

				$tabla = "productos";
				//$nuevostock = $_POST["editarStock"];

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $x,
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);

				//var_dump($datos);			   
				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}

	}
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/'.$_GET["codigo"]);

			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		
		}


	}
	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/
	static public function ctrMostrarSumaVentas(){
		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
		return $respuesta;
	}

	/*=============================================
	ACTUALIZAR PRODCUTOS DE COMPRAS
	=============================================*/
	// static public function ctrActualizarProductos(){
	// 	$tabla = "productos";
	// 	$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
	// 	return $respuesta;
	// }
}
