/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR EL CODIGO
=============================================*/
$("#nuevaGasto").change(function(){
    var idCategoria = $(this).val();
    
	//console.log("idCategoria",idCategoria);
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url:"ajax/administrar-Gastos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

            console.log("respuesta",respuesta);

			if (!respuesta) {
				var nuevoCodigo =idCategoria +"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}else{
				// console.log("respuesta",respuesta);
		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
		//console.log("respuesta",nuevoCodigo);
		$("#nuevoCodigo").val(nuevoCodigo);

			}

		
		}
	});
})

/*=============================================
EDITAR GASTOS
=============================================*/

$(".tablas tbody").on("click", "button.btnEditarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	//console.log(idGasto);
	var datos = new FormData();
	datos.append("idGasto", idGasto);
	
	$.ajax({
	
	url:"ajax/administrar-Gastos.ajax.php",
	method: "POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType:"json",
	  success:function(respuesta){
		  
	  //console.log("respuesta",respuesta);
			var datosCategoria = new FormData();
			datosCategoria.append("idCategoriaGastos",respuesta["id_categoriagastos"]);
	
			$.ajax({
	
				url:"ajax/categoriaGastos.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){
					//console.log("respuesta",respuesta);
					// -------------------------
					$("#editarCategoria").val(respuesta["id_categoriaGastos"]);
					$("#editarCategoria").html(respuesta["categoria"]);
	
				}
	
			})
	
			$("#editarCodigo").val(respuesta["codigo"]);
	
			$("#editarDescripcion").val(respuesta["descripcion"]);
	
			
			$("#editarnuevoMonto").val(respuesta["monto"]);
	
			
	
	  }
	
	})
	
	})

/*=============================================
ELIMINAR GASTO
=============================================*/
$(".tablas tbody").on("click", "button.btnEliminarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	var codigo = $(this).attr("codigo");
	
	
		swal({
	
			title: '¿Está seguro de borrar el tipo de gasto?',
			text: "¡Si no lo está puede cancelar la accíón!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, borrar el gasto!'
			}).then(function(result){
			if (result.value) {
	
				window.location = "index.php?ruta=administrar-Gastos&idGasto="+idGasto+"&codigo="+codigo;
	
			}
	
	
		})
	
	})
