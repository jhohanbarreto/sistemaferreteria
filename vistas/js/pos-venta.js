/*=============================================
CAPTURANDO LA PRECIO DEL PRODUCTO
=============================================*/
$("#nuevaPromocion, #editarnuevaPromocion").change(function(){

	var idPromocion = $(this).val();

	var datos = new FormData();
  	datos.append("idPromocion", idPromocion);

  	$.ajax({

      url:"ajax/promocion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        //console.log("respuesta",respuesta);

      		var nuevoCodigo = Number(respuesta["precio_venta"]);
			  $("#precioActualPromocion").val(nuevoCodigo);
			  $("#editarprecioActualPromocion").val(nuevoCodigo);
			  $("#nombreProducto1").val(respuesta["descripcion"]);

                
      }

  	})

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$("#promocionPorcentaje, #editarpromocionPorcentaje").change(function(){

 

		var valorPorcentaje = $("#precioActualPromocion").val();
		var valorPorcentaje2 = $("#editarprecioActualPromocion").val();
    //console.log("valorPorcentaje",valorPorcentaje);
    
    if($("#promocionPorcentaje").val()>= 0 && $("#editarpromocionPorcentaje").val()>= 0 ){
		var porcentaje = Number(valorPorcentaje) - Number($("#promocionPorcentaje").val()*valorPorcentaje/100);
		var porcentaje2 = Number(valorPorcentaje2) - Number($("#editarpromocionPorcentaje").val()*valorPorcentaje2/100);
		//console.log("porcentaje",porcentaje);
		// var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
		$("#nuevoPrecioRebajado").val(porcentaje);
		$("#editarnuevoPrecioRebajado").val(porcentaje2);
		// $("#nuevoPrecioVenta").prop("readonly",true);
		
		// //para editar
		// $("#editarPrecioVenta").val(editarPorcentaje);
    // $("#editarPrecioVenta").prop("readonly",true);
  }else{
  
		$("#promocionPorcentaje").val("");
		$("#editarpromocionPorcentaje").val("");
  }
	
})
/*=============================================
PARA GUARDAR LA FECHA
=============================================*/

$(function() {

	$('#datePromocion-btn, #editardatePromocion-btn').daterangepicker({
		autoUpdateInput: false,
		locale: {
			cancelLabel: 'Clear'
		}
	});
  
	$('#datePromocion-btn, #editardatePromocion-btn').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		$("#fechaInicio").val(picker.startDate.format('YYYY-MM-DD'));
		$("#fechaFinal").val(picker.endDate.format('YYYY-MM-DD'));
		$("#editarfechaInicio").val(picker.startDate.format('YYYY-MM-DD'));
		$("#editarfechaFinal").val(picker.endDate.format('YYYY-MM-DD'));
	});
  
	$('#datePromocion-btn, #editardatePromocion-btn').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
  
  });



/*=============================================
VALIDANDO LA IMAGEN DE PROMOCI[ON]
=============================================*/
$(".nuevaFotoPromocion").change(function(){

	var imagen = this.files[0]; 

	/*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
		//limbiar el input
		$(".nuevaFotoPromocion").val("");
		//para la alert
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
			});

	}else if(imagen["size"] > 2000000){

		$(".nuevaFotoPromocion").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
			});

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		})

	}
})

/*=============================================
EDITAR PROMOCION
=============================================*/
$(".tablas").on("click", ".btnEditarPromocion", function(){

	var idPromocion123 = $(this).attr("idPromocion");
	//console.log(idPromocion123);
	var datos = new FormData();
    datos.append("idPromocion123", idPromocion123);

    $.ajax({

      url:"ajax/promocion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
		  

		  console.log("respuesta",respuesta);
		   $("#idPromocion").val(respuesta["id_oferta"]);
      	   $("#editarnombrePromocion").val(respuesta["nombre"]);
	       $("#editarprecioActualPromocion").val(respuesta["precioReal"]);
	       $("#editarpromocionPorcentaje").val(respuesta["porcentaje"]);
	       $("#editarnuevoPrecioRebajado").val(respuesta["precioRebajado"]);
	       $("#editardescripcionPromocion").val(respuesta["descripcion"]);
		   $("#editardatePromocion-btn").val(respuesta["fecha_inicio"]+" - "+respuesta["fecha_final"]);
		   $("#fotoActualPromocion").val(respuesta["imagen"]);
		   $("#editajhohan").val(respuesta["id_producto"]);
		   $("#editajhohan").html(respuesta["producto"]);

		   if(respuesta["imagen"] != ""){
			//para mostrar la foto que biene de la base de dato
			$(".previsualizar").attr("src", respuesta["imagen"]);

		}
	  }

  	})

})
/*=============================================
ELIMINAR PROMOCION
=============================================*/
$(".tablas").on("click", ".btnEliminarPromocion", function(){

	var idPromocion = $(this).attr("idPromocion");
	
	swal({
        title: '¿Está seguro de borrar la promoción?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar promoción!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=post-venta&idPromocion="+idPromocion;
        }

  })

})

/*=============================================
CAPTURANDO LOS DATOA PARA EL ENVIO DE CORREO
=============================================*/
$("#enviarPromocion2").change(function(){

	var idPromocion2 = $(this).val();

	var datos = new FormData();
  	datos.append("idPromocion2", idPromocion2);

  	$.ajax({

      url:"ajax/promocion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        //console.log("respuesta",respuesta);

      		//var nuevoCodigo = Number(respuesta["precio_venta"]);
      		
			 $("#producto3").val(respuesta["producto"]);
			 $("#precioReal2").val(respuesta["precioReal"]);
			 $("#descuentoPorcentual").val(respuesta["porcentaje"]);
			 $("#precioRebajado2").val(respuesta["precioRebajado"]);
			 $("#fechaInicio2").val(respuesta["fecha_inicio"]);
			 $("#fechaFinal2").val(respuesta["fecha_final"]);
			 $("#mensaje").val(respuesta["descripcion"]);
			 $("#imagen").val(respuesta["imagen"]);
			 
			 

                
      }

  	})

})
$("#cliente2").change(function(){

	var idPromocion3 = $(this).val();

	var datos = new FormData();
  	datos.append("idPromocion3", idPromocion3);

  	$.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        //console.log("respuesta",respuesta);

      		//var nuevoCodigo = Number(respuesta["precio_venta"]);
      		
			 $("#email").val(respuesta["email"]);
		
			 
			 

                
      }

  	})

})