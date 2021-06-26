/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".btnEditarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);

	$.ajax({
		url:"ajax/categoria.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			//console.log("respuesta",respuesta);
			$("#editarCategoria").val(respuesta["categoria"]);
			$("#idCategoria").val(respuesta["id_categoria"]);
		}
	})
})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/

$(".btnEliminarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");

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
		  window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
	
		}
	
	  })
})
