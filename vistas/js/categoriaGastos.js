/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".btnEditarCategoriaGastos").click(function(){
    var idCategoriaGastos = $(this).attr("idCategoriaGastos");
    //console.log(idCategoriaGastos)
	var datos = new FormData();
	datos.append("idCategoriaGastos",idCategoriaGastos);

	$.ajax({
		url:"ajax/categoriaGastos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			console.log("respuesta",respuesta);
			$("#editarCategoriaGastos").val(respuesta["categoria"]);
			$("#idCategoriaGastos").val(respuesta["id_categoriaGastos"]);
		}
	})
})

/*=============================================
ELIMINAR CATEGORIA GASTOS
=============================================*/

$(".btnEliminarCategoriaGastos").click(function(){
	var idCategoriaGastos = $(this).attr("idCategoriaGastos");

	swal({
		title: '¿Está seguro de borrar el categoria?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning', //warning alerta
		showCancelButton: true, //botton acept
		confirmButtonColor: '#3085d6',//color
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar categoria!'
		 
	
	  }).then((result)=>{ 
	
		if(result.value){//result es verdadero
		  window.location = "index.php?ruta=categoriaGastos&idCategoriaGastos="+idCategoriaGastos;
	
		}
	
	  })
})
