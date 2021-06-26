<?php

class ControladorProveedores{

	
	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/ 


	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	}
	/*=============================================
	CREAR PROVEEDOR
	=============================================*/ 

    static public function ctrCrearProveedores(){

        if(isset($_POST["nuevoNombreProveedor"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProveedor"])){

					$tabla = "proveedores";

					$datos = array("nombre_proveedor" => $_POST["nuevoNombreProveedor"],
                                "nombre_representante" => $_POST["nuevoNombreRepresentante"],
                                "correo" => $_POST["nuevaCorreoProveedor"],
                                "dni" => $_POST["nuevoDniProveedor"],
                                "ruc" => $_POST["nuevoRucProveedor"],
                                "celular" => $_POST["nuevaNumeroProveedor"],
                                "telefono" => $_POST["nuevoTelefono"]);

					//var_dump($datos);
					$respuesta = ModeloProveedores::mdlIngresarProveedores($tabla, $datos);
				
					if($respuesta == "ok"){

						echo '<script>

						swal({

							type: "success",
							title: "¡El proveedor ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

							}

						});
					

						</script>';


					}	


				}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

				</script>';

			}


		}

	}
	
	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/ 

    static public function ctrEditarProveedores(){

        if(isset($_POST["editarNombreProveedor"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreProveedor"])){

				$tabla = "proveedores";

				$datos = array("nombre_proveedor" => $_POST["editarNombreProveedor"],
							"nombre_representante" => $_POST["editarNombreRepresentante"],
							"correo" => $_POST["editarCorreoProveedor"],
							"dni" => $_POST["editarDniProveedor"],
							"ruc" => $_POST["editarRucProveedor"],
							"celular" => $_POST["editarNumeroProveedor"],
							"telefono" => $_POST["editarTelefono"]);
					///var_dump($datos);
					$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);
				
					if($respuesta == "ok"){

						echo '<script>

						swal({

							type: "success",
							title: "¡El proveedor ha sido editado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

							}

						});
					

						</script>';


					}	


				}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

				</script>';

			}


		}

	}
	
	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/
	static public function ctrEliminarProveedor(){

		if(isset($_GET["idProveedor"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedor"];
			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "EL proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

			}		
		}


	}
}