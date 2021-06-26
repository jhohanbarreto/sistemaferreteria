<?php

class ControladorGastos{


    /*--=====================================
    MOSTRAR CATEGORIA
    ======================================-*/
    static public function ctrMostrarGasto($item,$valor){
        $tabla="gastos";

        $respuesta = ModeloGastos::mdlMostrarGastos($tabla,$item,$valor);

        return $respuesta;
    }

    /*=============================================
	INGRESO DE GASTO
	=============================================*/

	static public function ctrIngresoGasto(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoMonto"])){

				$tabla = "gastos";

			   	$datos = array("id_categoriagastos"=>$_POST["nuevaGasto"],
					           "codigo"=>$_POST["nuevoCodigo"],
					           "descripcion"=>$_POST["nuevaDescripcion"],
					           "monto"=>$_POST["nuevoMonto"]);
							   

				//var_dump($datos);
			   $respuesta = ModeloGastos::mdlIngresarGasto($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El gasto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "administrar-Gastos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El gasto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "administrar-Gastos";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	EDITAR GASTO
	=============================================*/

	static public function ctrEditarGasto(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarnuevoMonto"])){

				$tabla = "gastos";

			   	$datos = array("id_categoriagastos"=>$_POST["editarCategoria"],
					           "codigo"=>$_POST["editarCodigo"],
					           "descripcion"=>$_POST["editarDescripcion"],
					           "monto"=>$_POST["editarnuevoMonto"]);
							   

				//var_dump($datos);
			   $respuesta = ModeloGastos::mdlEditarGasto($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El gasto ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "administrar-Gastos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El gasto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "administrar-Gastos";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	BORRAR GASTO
	=============================================*/
	static public function ctrEliminarGasto(){

		if(isset($_GET["idGasto"])){

			$tabla ="gastos";
			$datos = $_GET["idGasto"];

			$respuesta = ModeloGastos::mdlEliminarGasto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El gasto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "administrar-Gastos";

								}
							})

				</script>';

			}		
		}


	}
}