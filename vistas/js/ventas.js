/*=============================================
VARIABLE LOCAL STORAGE(FITRO SI BIENEN ESAS VARIABLE EN LOCALSTORE)
=============================================*/
if (localStorage.getItem("capturarRango") != null) {
	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));
}else{
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}
/*=============================================
CARGAR LA TABLA DINAMICA DE VENTAS XD
=============================================*/

		// $.ajax({
		//     url: "ajax/datatable-ventas.ajax.php",
		//     success:function(respuesta){
		//         console.log("respuesta",respuesta); //vara ver lo que nos trae datatable-productos.ajax.php
		//     }
		// })

		$('.tablaVentas').DataTable( {
			"ajax": "ajax/datatable-ventas.ajax.php",
			"deferRender": true,
			"retrieve": true,
			"processing": true,
			 "language": {

					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}

			}

		} );
/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA AEA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	//console.log("idProducto",idProducto);
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
			//console.log("respuesta",respuesta);
			//almacenar
      	    var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });
				//boton regrese al color azul
			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}
			//ahora tenemos que agregar producto
			$(".nuevoProducto").append(
  
				'<div class="row" style="padding:5px 15px">'+
  
				'<!-- Descripción del producto -->'+
  
				'<div class="col-xs-5" style="padding-right:0px">'+
  
				  '<div class="input-group">'+
  
					'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
  
					'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
  
				  '</div>'+
  
				'</div>'+
  
				'<!-- Cantidad del producto -->'+
  
				'<div class="col-xs-2 ingresoCantidad" style="padding-right:0px">'+
  
				   '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" step="any" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
  
				'</div>' +
  
				'<!-- Precio del producto -->'+
  
				'<div class="col-xs-2 ingresoPrecio">'+
					'<div class="input-group">'+

						'<input type="number" step="any" class="form-control nuevoDescuento" name="nuevoDescuento" min="0" value="0" required>'+
						  
					  '</div>'+
				'</div>'+

				'<input type="hidden" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
				'<input type="hidden" class="form-control nuevoPrecioGuardar" value="'+precio+'" required>'+
				  
				'<!-- Totales -->'+
				  
				'<div class="col-xs-2 ingresoTotal" style="padding-left:0px">'+
					'<div class="input-group">'+
					  
						'<span class="input-group-addon">S/</i></span>'+
						'<input class="form-control nuevoTotal" name="nuevoTotal" id="nuevoTotal" value="'+precio+'" style="width:80px" readonly>'+					
  
					'</div>'+
				'</div>'+
  
  
  
  
			  '</div>')



	        sumarTotalPrecios()

	        agregarImpuesto()

	        listarProductos()


	        $(".nuevoPrecioProducto").number(true, 2);

      	}

     })

});





/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){
	//console.log("tabla");
	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


var idQuitarProducto = [];//definir
localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR ->con el id nos ayudaremos a remover o adicionar la clase
	=============================================*/
	//capturaremos un a variable quitarProducto
	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];

	}else{//biene con informacion
		//concatenar
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}
	//push->almacenar la propiedad idProducto
	idQuitarProducto.push({"idProducto":idProducto});
	//setItem->vamos a subir a localStorage con json convertiendo a string  stringify(idQuitarProducto)
	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);//para mantener el formato y madar a bd
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/
//para que no se carge los productos varias veces cuando seleccionamos
var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,//datos que bamos a enviar
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",//tipo de dato que vamos recivir
      	success:function(respuesta){
      	    //console.log("respuesta",respuesta);
      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+

	          '<div class="col-xs-6" style="padding-right:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+

	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+

	            '</div>'+

	          '</div>'+

	        '</div>');

			sumarTotalPrecios()
	        // AGREGAR LOS PRODUCTOS AL SELECT

	         respuesta.forEach(funcionForEach);//vamos hacer un recorrido
			// function funcionForEach(item,index){
			// 	$(".nuevaDescripcionProducto").append(
			// 		'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
			// 	)
			// }
	         function funcionForEach(item, index){
				//para que nos vote alert en e=stock cero
	         	if(item.stock != 0){//que si el stock es cero no aparecera

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)

		         }

	         }

	         // SUMAR TOTAL DE PRECIOS

    		

    		// AGREGAR IMPUESTO

	        agregarImpuesto()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();
	//console.log("nombreProducto",nombreProducto);

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");
	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//console.log("nuevoPrecioProducto",nuevoPrecioProducto);

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,//datos que bamos a enviar
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",//tipo de dato que vamos recivir
      	success:function(respuesta){
      	    //console.log("respuesta",respuesta);
			  $(nuevaDescripcionProducto).attr("idProducto", respuesta["id_producto"]);

			$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
			  //para agregar al nuevo stock
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);

			$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
			  //para que precioReal sea constante para la multiplicacion
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var numero = $(this).parent().parent().children("input.nuevoPrecioProducto").val();

	var numero123 = $(this).parent().parent().children("input.nuevoPrecioGuardar")
	var descuento = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoDescuento").val();
	
	var precioReal = numero - descuento;

	var precio = $(this).parent().parent().children(".ingresoTotal").children().children(".nuevoTotal");
	
	var precioFinal = precioReal * $(this).val();

	precio.val(precioFinal);
	numero123.val(precioReal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	console.log(nuevoStock)

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/
		//regresar el value a 1
		$(this).val(0);
		//tambien regrearemos el precio
		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);
		//tambien para que muestre la suma de las candidades selecionadas
		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoTotal");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);//para mantener el formato y madar a bd
	//lo llenaremos cuando se efectue
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);

	//$("#totalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=============================================
PARA SELECCIONAR TIPO DE COMPROBANTE
=============================================*/
$("#nuevoComprobante").change(function(){


	listarComprobante()

})

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			'<div class="col-xs-4">'+ 

			'<div class="input-group">'+ 

				'<span class="input-group-addon">S/</i></span>'+ 

				'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

			'</div>'+

		'</div>'+

		'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			'<div class="input-group">'+

				'<span class="input-group-addon">S/</i></span>'+

				'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="Vuelto" readonly required>'+

			'</div>'+

		'</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
		$('#nuevoCambioEfectivo').number( true, 2);

      	// Listar método en la entrada si elegimos efectivo
		  listarMetodos()

	}else if(metodo == "Por-partes"){
	
		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			'<div class="col-xs-4">'+ 

			'<div class="input-group">'+ 

				'<span class="input-group-addon">S/</i></span>'+ 

				'<input type="text" class="form-control" id="nuevoValorAdelanto" name="nuevoValorAdelanto" placeholder="Adelanto" required>'+

			'</div>'+

		'</div>'+

		'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			'<div class="input-group">'+

				'<span class="input-group-addon">S/</i></span>'+

				'<input type="text" class="form-control" id="nuevoCambioPendiente" name="nuevoCambioPendiente" value="0" placeholder="Pendiente" readonly required>'+

			'</div>'+

		'</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorAdelanto').number( true, 2);
		$('#nuevoCambioPendiente').number( true, 2);

      	// Listar método en la entrada si elegimos efectivo
		  listarMetodos()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

			'<div class="col-xs-6" style="padding-left:0px">'+
                        
			'<div class="input-group">'+
				 
			  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
				   
			  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
			  
			'</div>'+

		  '</div>')
		}
})
/*=============================================
SELECCIONAR FACTURA
=============================================*/

//var numProducto = 0;

$("#nuevoComprobante").change(function(){
	//numProducto ++;
	var metodoComprobante = $(this).val();
	//var resultadoGlobal="";
	//console.log(metodoComprobante);

	var datos = new FormData();
	datos.append("metodoComprobante",metodoComprobante);
	$.ajax({
			url:"ajax/ventas.ajax.php",
			method:"POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",

			success:function(respuesta){

				//console.log(metodoComprobante);
				//resultadoGlobal=respuesta;

				var codigo = respuesta["codigo"]	
				//return resultadoGlobal;

				if(respuesta["tipo_comprobante"] == "Factura"){

					
							//console.log("false");
							$(".cajasMetodoRuc").html(

								'<div class="col-xs-4">'+ 

								'<div class="input-group">'+ 

								

									'<input type="text" class="form-control" id="ruc" name="ruc" placeholder="Ingrese el numero RUC" required>'+

								'</div>'+

							'</div>'+

							'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

								'<div class="input-group">'+

									

									'<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'+(Number(codigo)+1)+'" readonly>'+

								'</div>'+

							'</div>'

							)
									



								
	
				}else if(respuesta["tipo_comprobante"] == "Boleta"){
					

					$(".cajasMetodoRuc").html(

						'<div class="col-xs-5" style="float:right">'+
                        
						'<div class="input-group">'+
							 
						  '<input type="number" min="0" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'+(Number(codigo)+1)+'"  readonly>'+
							   
						  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						  
						'</div>'+
			
					  '</div>')


						
				}else{
					if(metodoComprobante == "Factura"){
						$(".cajasMetodoRuc").html(

							'<div class="col-xs-4">'+ 

								'<div class="input-group">'+ 

								

								'<input type="text" class="form-control" id="ruc" name="ruc"  placeholder="Ingrese numero RUC" required>'+

								'</div>'+

							'</div>'+

							'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

								'<div class="input-group">'+

									

								'<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="70001" readonly >'+

								'</div>'+

							'</div>'

							)


					}else if(metodoComprobante == "Boleta"){
						$(".cajasMetodoRuc").html(
							'<div class="col-xs-6" style="float:right">'+
                        
						'<div class="input-group">'+
							 
						  '<input type="number" min="0" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001"  readonly>'+
							   
						  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						  
						'</div>'+
			
					  '</div>')

					}else{
						$(".cajasMetodoRuc").html(

							'<div class="col-xs-4" >'+

								'<div class="input-group">'+

									'<input type="hidden" class="form-control" id="ruc" name="ruc"  placeholder="Ingrese el numero RUC" required>'+

								'</div>'+

							'</div>')
					}

				}	
				}
					
			})
			
	

})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
//change->cambie su select
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})


/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
//change->cambie su select
$(".formularioVenta").on("change", "input#nuevoValorAdelanto", function(){

	var efectivo = $(this).val();

	var cambio =  Number($('#nuevoTotalVenta').val()) - Number(efectivo);

	console.log(cambio)

	var nuevoCambioPendiente = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioPendiente');


	nuevoCambioPendiente.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
	 listarMetodos()


})


$("#idVendedora").click(function(){
	//console.log("idVenta",idVenta);
	var idProformaVenta = $(this).attr("value");

	var datos = new FormData();
    datos.append("idProformaVenta", idProformaVenta);
	//window.location = "index.php?ruta=editar-venta&idProformaVenta="+idProformaVenta;

	  $.ajax({

     	url:"ajax/proforma.ajax.php",
      	method: "POST",
      	data: datos,//datos que bamos a enviar
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",//tipo de dato que vamos recivir
      	success:function(respuesta){
      	   

      	}

      })
})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/
//se va ejecutar cuando hay suma resta
function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioGuardar");
	
	var precioFinal = $(".nuevoTotal");

	for(var i = 0; i < descripcion.length; i++){


		listaProductos.push({ "id_producto" : $(descripcion[i]).attr("idProducto"),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).val(),
							  "total" : $(precioFinal[i]).val()})

	}
	console.log("listaProductos",listaProductos);
	$("#listaProductos").val(JSON.stringify(listaProductos));
	//console.log("listaProductos",JSON.stringify(listaProductos));
}
/*=============================================
LISTAR MÉTODO DE PAGO(para poder guardar el metodo de pago en la bd)
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else if($("#nuevoMetodoPago").val() == "Por-partes"){

		$("#listaMetodoPago").val("Por-partes");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}





/*=============================================
LISTAR Tipo de Comprobante(para poder guardar en la bd)
=============================================*/

function listarComprobante(){

	var listaComprobante = "";

	if($("#nuevoComprobante").val() == "Boleta"){

		$("#listarComprobante").val("Boleta");

	}else{

		$("#listarComprobante").val("Factura");
		$("#ruc").val($("#nuevoCodigoRuc").val());
	}
}



function quitarAgregarProducto(){

	var idProductos = $(".quitarProducto");

	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	for(var i = 0; i < idProductos.length; i++){

		var boton = $(idProductos[i]).attr("idProducto");

		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}

}



$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarProducto();

})


$(".tablas").on("click", ".btnImprimirFactura", function(){
	var codigoVenta = $(this).attr("codigoVenta");
	//solicitamos a windoewss q me abra una nueva ventana
	//para pasarlo como GET-> ?codigo="
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
})



$('#daterange-btn').daterangepicker(
	{
	  ranges   : {
		'Hoy'       : [moment(), moment()],
		'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
		'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
		'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
		'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

	  var fechaInicial = start.format('YYYY-MM-DD');

	  var fechaFinal = end.format('YYYY-MM-DD');

	  var capturarRango = $("#daterange-btn span").html();

		 localStorage.setItem("capturarRango", capturarRango);

		 window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

  )



  $(".daterangepicker.opensleft.opensleft .range_inputs .cancelBtn").on("click", function(){

	  localStorage.removeItem("capturarRango");
	  localStorage.clear();
	  window.location = "ventas";
  })



  $(".daterangepicker.opensleft.opensleft .ranges li").on("click", function(){

	  var textoHoy = $(this).attr("data-range-key");

	  if(textoHoy == "Hoy"){

		  var d = new Date();

		  var dia = d.getDate();
		  var mes = d.getMonth()+1;
		  var año = d.getFullYear();

		  if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		  }else if(dia < 10){

			  var fechaInicial = año+"-"+mes+"-0"+dia;
			  var fechaFinal = año+"-"+mes+"-0"+dia;

		  }else if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		  }else{

			  var fechaInicial = año+"-"+mes+"-"+dia;
			  var fechaFinal = año+"-"+mes+"-"+dia;

		  }

		  localStorage.setItem("capturarRango", "Hoy");

		  window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	  }

  })
  
/*=============================================
PARA EL CAMBIO DE PRECIO CON EL SELECT
=============================================*/
$(".formularioVenta").on("change", "input.nuevoDescuento", function(){
	var numero = $(this).parent().parent().parent().children("input.nuevoPrecioProducto").val();

	var numero123 = $(this).parent().parent().parent().children("input.nuevoPrecioGuardar")

	var cantidad = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

	//console.log(numero)

	//precio actualizado

	var precioActulizado = numero - $(this).val()

	var precio = $(this).parent().parent().parent().children(".ingresoTotal").children().children(".nuevoTotal");

	var precioFinal = cantidad * precioActulizado;

	precio.val(precioFinal);

	numero123.val(precioActulizado);

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()
})
/*=============================================
PARA EL CAMBIO DE ESTADO
=============================================*/
// $(document).on("click", ".btnActivarEstadoVentas", function(){

// 	var idVentas = $(this).attr("idVentas");
// 	//console.log(idTrabajo);
// 	var estadoVentas = $(this).attr("estadoVentas");
	
    
//    // console.log(estadoTrabajo);

// 	var datos = new FormData();
//  	datos.append("activarId", idVentas);
//   	datos.append("activarVentas", estadoVentas);

//   	$.ajax({

// 	  url:"ajax/ventas.ajax.php",
// 	  method: "POST",
// 	  data: datos,
// 	  cache: false,
//       contentType: false,
//       processData: false,
//       success: function(respuesta){
//       	// if(window.matchMedia("(max-width:767px)").matches){//maximo 767px
		
//       	// 	 swal({
// 		//       	title: "El usuario ha sido actualizado",
// 		//       	type: "success",
// 		//       	confirmButtonText: "¡Cerrar!"
// 		//     	}).then(function(result) {
		        
// 		//         	if (result.value) {

// 		//         	window.location = "usuarios";//recarge otra vez la pagina

// 		//         }

// 		//       });


// 		// }
//       }

//   	})


// })

/*=============================================
PARA PAGAR LA DEUDA
=============================================*/
$(".tablas").on("click", "button.btnActivarEstadoVentas", function(){

	var idVentas = $(this).attr("idVentas");
	console.log(idVentas);
	var estadoVentas = $(this).attr("estadoVentas");
	
    
   // console.log(estadoTrabajo);

	var datos = new FormData();
 	datos.append("activarId", idVentas);
  	

  	$.ajax({

	  url:"ajax/ventas.ajax.php",
	  method: "POST",
	  data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){


		$("#nuevoTotalDeuda").val(respuesta["total"]);
		$("#nuevoAdelantoDeuda").val(respuesta["adelanto"]);
		$("#nuevoPendienteDeuda").val(respuesta["pendiente"]);
		$("#llevandoId").val(respuesta["id_venta"]);
		//console.log(respuesta["id_venta"]);

      	
      }

  	})


})

/*=============================================
PARA PAGAR UN ADELANTO DE LA DEUDA
=============================================*/
//change->cambie su select
$(".formularioDeuda").on("change", "input#nuevoPagoDeuda", function(){

	var efectivo = $(this).val();

	var cambio =  Number($('#nuevoPendienteDeuda').val()) - Number(efectivo);

	$('#nuevoRestanteDeuda').val(cambio)

	

})