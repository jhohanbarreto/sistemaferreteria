<?php
class ControladorPromocion{


    /*=============================================
	MOSTRAR PROMOCION
    =============================================*/
    static public function ctrMostrarPomocion($item,$valor){
        $tabla = "oferta";
        $respuesta = ModeloPromocion::mdlMostrarPromocion($tabla,$item,$valor);
		return $respuesta;
		//var_dump($respuesta);
	}

	static public function ctrMostrarPomocion123($item,$valor){
        $tabla = "oferta";
        $respuesta1 = ModeloPromocion::mdlMostrarPromocion($tabla,$item,$valor);
		return $respuesta1;
		//var_dump($respuesta);
    }

    /*=============================================
	CREAR UNA PROMOCION
	=============================================*/
    static public function ctrCrearPromocion(){

        if (isset($_POST["nombrePromocion"])) {
            if(preg_match('/^[a-zA-Z0-\_\,\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombrePromocion"])&&
			  preg_match('/^[a-zA-Z0-\_\,\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionPromocion"])&&
			  preg_match('/^[a-zA-Z0-\_\,\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreProducto1"])&&
              preg_match('/^[0-9.]+$/', $_POST["promocionPorcentaje"])){

                /*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";
				if(isset($_FILES["nuevaFotoPromocion"]["tmp_name"])){
                    var_dump($_FILES["nuevaFotoPromocion"]["tmp_name"]);
                    
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoPromocion"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/promocion/".$_POST["nombrePromocion"];
					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					//["type"]->propiedad
					if($_FILES["nuevaFotoPromocion"]["type"] == "image/jpeg"){ 
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/promocion/".$_POST["nombrePromocion"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFotoPromocion"]["tmp_name"]);					

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); 
						//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//guarda la foto en la ruta asignada
						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFotoPromocion"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/promocion/".$_POST["nombrePromocion"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFotoPromocion"]["tmp_name"]);				

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

                $tabla = "oferta";
                
                $datos = array("porcentaje" => $_POST["promocionPorcentaje"],
								"nombre" => $_POST["nombrePromocion"],
								"producto" => $_POST["nombreProducto1"],
                                "id_producto" => $_POST["nuevaPromocion"],
                                "precioReal" => $_POST["precioActualPromocion"],
                                "precioRebajado" => $_POST["nuevoPrecioRebajado"],
                                //"fecha" => $_POST["nuevoStock"],
                                "descripcion" => $_POST["descripcionPromocion"],
                                "fecha_inicio" => $_POST["fechaInicio"],
                                "fecha_final" => $_POST["fechaFinal"],
                                "imagen" => $ruta);
        
                    //var_dump($datos);
                $respuesta = ModeloPromocion::mdlIngresarPromocion($tabla,$datos);
                 //var_dump($respuesta);
                    if($respuesta == "ok"){

                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡El producto ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "post-venta";
    
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
						
							window.location = "post-venta";

						}

					});
				

				    </script>';
                }
            
        }
    }
	/*=============================================
	EDITAR PROMOCION
	=============================================*/

	static public function ctrEditarPromocion(){

		if(isset($_POST["editarnombrePromocion"])){

			if(preg_match('/^[a-zA-Z0-\_\,\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnombrePromocion"])&&
            preg_match('/^[a-zA-Z0-\_\,\';\.-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editardescripcionPromocion"])&&
            preg_match('/^[0-9.]+$/', $_POST["editarpromocionPorcentaje"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["fotoActualPromocion"];

			   	if(isset($_FILES["editarnuevaFotoPromocion"]["tmp_name"]) && !empty($_FILES["editarnuevaFotoPromocion"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarnuevaFotoPromocion"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/promocion/".$_POST["editarnombrePromocion"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualPromocion"]) && $_POST["fotoActualPromocion"] != "vistas/img/promocion/default/anonymous.png"){

						unlink($_POST["fotoActualPromocion"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarnuevaFotoPromocion"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/promocion/".$_POST["editarnombrePromocion"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarnuevaFotoPromocion"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarnuevaFotoPromocion"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/promocion/".$_POST["editarnombrePromocion"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarnuevaFotoPromocion"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				

				$tabla = "oferta";

			   	$datos = array("id_oferta" => $_POST["idPromocion"],
                                "porcentaje" => $_POST["editarpromocionPorcentaje"],
                                "nombre" => $_POST["editarnombrePromocion"],
                                "id_producto" => $_POST["editarnuevaPromocion"],
                                "precioReal" => $_POST["editarprecioActualPromocion"],
                                "precioRebajado" => $_POST["editarnuevoPrecioRebajado"],
                                //"fecha" => $_POST["nuevoStock"],
                                "descripcion" => $_POST["editardescripcionPromocion"],
                                "fecha_inicio" => $_POST["editarfechaInicio"],
                                "fecha_final" => $_POST["editarfechaFinal"],
                                "imagen"=> $ruta);
                //var_dump($datos);
				$respuesta = ModeloPromocion::mdlEditarPromocion($tabla, $datos);
                var_dump($datos);
				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "post-venta";

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

							window.location = "post-venta";

							}
						})

			  	</script>';
			}
		}

	}
    
    /*=============================================
	ELIMINAR PROMOCION
	=============================================*/

	static public function ctrEliminarPromocion(){

		if(isset($_GET["idPromocion"])){

			$tabla ="oferta";
			$datos = $_GET["idPromocion"];

			$respuesta = ModeloPromocion::mdlEliminarPromocion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El promocion ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "post-venta";

								}
							})

				</script>';

			}		

		}

	}

}
?>
