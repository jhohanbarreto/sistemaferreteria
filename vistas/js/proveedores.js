
/*=============================================
EDITAR PROVEEDOR
=============================================*/

$(".tablas").on("click", ".btnEditarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");
	///console.log(idProveedor);
	var datos = new FormData();
	datos.append("idProveedor", idProveedor);
	
	$.ajax({
	
	url:"ajax/proveedores.ajax.php",
	method: "POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType:"json",
	  success:function(respuesta){

        
		  
			//console.log("respuesta",respuesta);
			
			$("#editarNombreProveedor").val(respuesta["nombre_proveedor"]);
	
			$("#editarNombreRepresentante").val(respuesta["nombre_representante"]);
	
            $("#editarCorreoProveedor").val(respuesta["correo"]);

            $("#editarDniProveedor").val(respuesta["dni"]);
	
			$("#editarRucProveedor").val(respuesta["ruc"]);
	
            $("#editarNumeroProveedor").val(respuesta["celular"]);
            
            $("#editarTelefono").val(respuesta["telefono"]);

            $("#id_proveedorCodigo").val(respuesta["id_proveedor"]);

            $("#editarCodigoProveedor").val(respuesta["codigo"]);

	
	  }
	
	})
	
})
/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");
	
	
		swal({
	
			title: '¿Está seguro de borrar el Proveedor?',
			text: "¡Si no lo está puede cancelar la accíón!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, borrar Trabajo!'
			}).then(function(result){
			if (result.value) {
	
				window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;
	
			}
	
	
		})
	
	})

	/*=============================================
ACTIVAR ESTADO
=============================================*/

$(document).on("click", ".btnActivarProveedor", function(){

	var idProveedor = $(this).attr("idProveedor");
	//console.log(idTrabajo);
    var estadoProveedor = $(this).attr("estadoProveedor");
    
   // console.log(estadoTrabajo);

	var datos = new FormData();
 	datos.append("activarId", idProveedor);
  	datos.append("activarProveedor", estadoProveedor);

  	$.ajax({

	  url:"ajax/proveedores.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
      	// if(window.matchMedia("(max-width:767px)").matches){//maximo 767px
		
      	// 	 swal({
		//       	title: "El usuario ha sido actualizado",
		//       	type: "success",
		//       	confirmButtonText: "¡Cerrar!"
		//     	}).then(function(result) {
		        
		//         	if (result.value) {

		//         	window.location = "usuarios";//recarge otra vez la pagina

		//         }

		//       });


		// }
      }

  	})

  	if(estadoProveedor == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('INACTIVO');
		$(this).attr('estadoProveedor',1);
		  
		swal("Proveedor inactivo!", "En espera!", "error")
  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('VIGENTE');
		$(this).attr('estadoProveedor',0);
		  
		swal("Proveedor vigente!","Exitosamente!", "success")

  	}

})