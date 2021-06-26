<?php

class ControladorCategoriaGastos{


    /*--=====================================
    MOSTRAR CATEGORIA
    ======================================-*/
    static public function ctrMostrarCategoriaGasto($item,$valor){
        $tabla="categoriagastos";

        $respuesta = ModeloCategoriaGastos::mdlMostrarCategoriaGasto($tabla,$item,$valor);

        return $respuesta;
    }

    /*--=====================================
    CREAR CATEGORIAS
    ======================================-*/
    static public function ctrCrearCategoriasGastos(){
		//$i += 1;
		//$respuesta = array();
		
		
		//var_dump($respuesta1[$i]);

        if (isset($_POST["nuevaCategoriaGasto"])) {
			
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoriaGasto"])){

					$tabla1 = "categoriagastos";
					$respuesta1 = ModeloCategoriaGastos::mdlMostrarCategoriaGasto123($tabla1);

					foreach ($respuesta1 as $key => $value) {
						
						if(strtoupper($_POST["nuevaCategoriaGasto"]) == strtoupper($value["categoria"])){
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
			
										window.location = "categoriaGastos";
			
										}
									})
			
							</script>';
					
					}else{

							$tabla = "categoriagastos";
							$datos = $_POST["nuevaCategoriaGasto"];
							$respuesta = ModeloCategoriaGastos::mdlIngresarCategoriaGasto($tabla,$datos);
			
							if ($respuesta == "ok") {
								echo '<script>
			
								swal({
			
									type: "success",
									title: "¡La categoria a sido guardado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
			
								}).then(function(result){
			
									if(result.value){
									
										window.location = "categoriaGastos";
			
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
	
								window.location = "categoriaGastos";
	
								}
							})
	
					  </script>';
				}

			
            
        }

    }
    
    /*--=====================================
    EDITAR CATEGORIAS GASTOS
    ======================================-*/
    static public function ctrEditarCategoriasGastos(){
        if (isset($_POST["editarCategoriaGastos"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoriaGastos"])){
                $tabla1 = "categoriagastos";
                $respuesta1 = ModeloCategoriaGastos::mdlMostrarCategoriaGasto123($tabla1);

					foreach ($respuesta1 as $key => $value) {	
						if(strtoupper($_POST["editarCategoriaGastos"]) == strtoupper($value["categoria"])){
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
			
										window.location = "categoriaGastos";
			
										}
									})
			
							</script>';
					
					}else{
				
						$tabla = "categoriagastos";
						$datos = array("categoria"=>$_POST["editarCategoriaGastos"],
										"id_categoriaGastos"=>$_POST["idCategoriaGastos"]); 
						$respuesta = ModeloCategoriaGastos::mdlEditarCategoriaGastos($tabla,$datos);

						if ($respuesta == "ok") {
							echo '<script>

							swal({

								type: "success",
								title: "¡La categoria a sido cambiada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "categoriaGastos";

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

								window.location = "categoriaGastos";

								}
							})

					</script>';
				}
			
			}

        }
        
        	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoriaGastos(){

		if(isset($_GET["idCategoriaGastos"])){

			$tabla ="categoriagastos";
			$datos = $_GET["idCategoriaGastos"];


			$respuesta = ModeloCategoriaGastos::mdlBorrarCategoriaGastos($tabla, $datos);

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

								window.location = "categoriaGastos";

								}
							})

				</script>';

			}		

		}

	}
}