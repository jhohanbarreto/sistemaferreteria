<?php
class ControladorCategorias{
    /*--=====================================
    CREAR CATEGORIAS
    ======================================-*/
    static public function ctrCrearCategorias(){
		//$i += 1;
		//$respuesta = array();
		
		
		//var_dump($respuesta1[$i]);

        if (isset($_POST["nuevaCategoria"])) {
			
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

					$tabla1 = "categorias";
					$respuesta1 = ModeloCategorias::MdlMostrarCategorias123($tabla1);

					foreach ($respuesta1 as $key => $value) {
						
						if(strtoupper($_POST["nuevaCategoria"]) == strtoupper($value["categoria"])){
							$respuesta12 = true;
						}

					}

					if($respuesta12){

						echo'<script>
			
								swal({
									type: "error",
									title: "¡La categoria ya existe en la bd!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
									}).then(function(result){
										if (result.value) {
			
										window.location = "categorias";
			
										}
									})
			
							</script>';
					
					}else{

							$tabla = "categorias";
							$datos = $_POST["nuevaCategoria"];
							$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla,$datos);
			
							if ($respuesta == "ok") {
								echo '<script>
			
								swal({
			
									type: "success",
									title: "¡La categoria a sido guardado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
			
								}).then(function(result){
			
									if(result.value){
									
										window.location = "categorias";
			
									}
			
								});
							
			
								</script>';
							}
					}
	
				}else{
					echo'<script>
	
						swal({
							  type: "error",
							  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
	
								window.location = "categorias";
	
								}
							})
	
					  </script>';
				}

			
            
        }

	}
	/*--=====================================
    visualizar categoria
    ======================================-*/
	static public function ctrMostrarCategorias($item,$valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::MdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	}


	/*--=====================================
    EDITAR CATEGORIAS
    ======================================-*/
    static public function ctrEditarCategorias(){
        if (isset($_POST["editarCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){
					$tabla1 = "categorias";
					$respuesta1 = ModeloCategorias::MdlMostrarCategorias123($tabla1);

					foreach ($respuesta1 as $key => $value) {	
						if(strtoupper($_POST["editarCategoria"]) == strtoupper($value["categoria"])){
							$respuesta12 = true;
						}

					}

					if($respuesta12){

						echo'<script>
			
								swal({
									type: "error",
									title: "¡La categoria ya existe en la bd!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
									}).then(function(result){
										if (result.value) {
			
										window.location = "categorias";
			
										}
									})
			
							</script>';
					
					}else{
				
						$tabla = "categorias";
						$datos = array("categoria"=>$_POST["editarCategoria"],
										"id_categoria"=>$_POST["idCategoria"]); 
						$respuesta = ModeloCategorias::mdlEditarCategoria($tabla,$datos);

						if ($respuesta == "ok") {
							echo '<script>

							swal({

								type: "success",
								title: "¡La categoria a sido cambiada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "categorias";

								}

							});
						

							</script>';
						}
				}

				}else{
					echo'<script>

						swal({
							type: "error",
							title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
								if (result.value) {

								window.location = "categorias";

								}
							})

					</script>';
				}
			
			}

		}
	
	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla ="categorias";
			$datos = $_GET["idCategoria"];


			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La categoria ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "categorias";

								}
							})

				</script>';

			}		

		}

	}
}

