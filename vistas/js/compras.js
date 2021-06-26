/*=============================================
VARIABLE LOCAL STORAGE(FITRO SI BIENEN ESAS VARIABLE EN LOCALSTORE) 
=============================================*/
if (localStorage.getItem("capturarRango") != null) {
	$("#daterange-btn3 span").html(localStorage.getItem("capturarRango"));
}else{
	$("#daterange-btn3 span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

/*=============================================
CARGAR LA TABLA DINAMICA DE COMPRAS XD
=============================================*/

		// $.ajax({
		//     url: "ajax/datatable-ventas.ajax.php",
		//     success:function(respuesta){
		//         console.log("respuesta",respuesta); //vara ver lo que nos trae datatable-productos.ajax.php
		//     }
		// })

		$('.tablaCompras').DataTable( {
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
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA PROFORMA
=============================================*/
$(".tablaCompras tbody").on("click", "button.agregarProducto", function(){

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
          	var precio = respuesta["precio_compra"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	// if(stock == 0){

      		// 	swal({
			//       title: "No hay stock disponible",
			//       type: "error",
			//       confirmButtonText: "¡Cerrar!"
			//     });
			// 	//boton regrese al color azul
			//     $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			//     return;

          	// }
			//ahora tenemos que agregar producto
          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+

	          '<div class="col-xs-6" style="padding-right:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+

	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon">S/</i></span>'+

				  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
				  

	            '</div>'+

	          '</div>'+

	        '</div>')



		    sumarTotalPreciosCompra()
			
	      //agregarImpuesto()

		   listarProductosCompra()

				//poner formato a al precio del producto
	        $(".nuevoPrecioProducto").number(true, 2);
            

          }
    })
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
//se activa siempre que la tabla se vuelve a cargar
$(".tablaCompras").on("draw.dt", function(){
	//console.log("tablaProforma");
	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})

/*=============================================
QUITAR PRODUCTOS DE LA PROFORMA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];//definir
//quitar los datos almacenamiento local
localStorage.removeItem("quitarProducto");

$(".formularioCompra").on("click", "button.quitarProducto", function(){

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
		$("#nuevoTotalCompra").val(0);
		$("#totalVenta").val(0);//para mantener el formato y madar a bd
		$("#nuevoTotalCompra").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosCompra()

    	// AGREGAR IMPUESTO

        //agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosCompra()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/
//para que no se carge los productos varias veces cuando seleccionamos
var numProducto = 0;

$(".btnAgregarProductoCompra").click(function(){

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

	              '<span class="input-group-addon">S/</i></span>'+

	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+

	            '</div>'+

	          '</div>'+

	        '</div>');


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

			 sumarTotalPreciosCompra()

    		// AGREGAR IMPUESTO

	        //agregarImpuesto()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})

/*=============================================
SELECCIONAR PRODUCTO PARA EL DISOSITIVO
=============================================*/

$(".formularioCompra").on("change", "select.nuevaDescripcionProducto", function(){

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

			$(nuevoPrecioProducto).val(respuesta["precio_compra"]);
			  //para que precioReal sea constante para la multiplicacion
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_compra"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductosCompra()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD PARA DISPOSITIVOS
=============================================*/

$(".formularioCompra").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);
	var nuevoStock = $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	

	//SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosCompra()

	//AGREGAR IMPUESTO

    //agregarImpuesto()

    //AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosCompra()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosCompra(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

	$("#nuevoTotalCompra").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);//para mantener el formato y madar a bd
	//lo llenaremos cuando se efectue
	$("#nuevoTotalCompra").attr("total",sumaTotalPrecio);


}

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalCompra").number(true, 2);

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/
//se va ejecutar cuando hay suma resta
function listarProductosCompra(){

	var listaProductosCompra = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){


		listaProductosCompra.push({ "id_producto" : $(descripcion[i]).attr("idProducto"),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}
	//console.log("listaProductosCompra",listaProductosCompra);
	$("#listaProductosCompra").val(JSON.stringify(listaProductosCompra));

}

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProductoCompra(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaCompras tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaCompras').on( 'draw.dt', function(){

	quitarAgregarProductoCompra();

})

/*=============================================
PARA EL BOTON EDITAR COMPRA
=============================================*/

$(".tablas").on("click",".btnEditarCompra",function(){
	//console.log("idVenta",idVenta);
	var idCompra = $(this).attr("idCompra");
	window.location = "index.php?ruta=editar-compra&idCompra="+idCompra;
})

/*=============================================
BORRAR COMPRA
=============================================*/
$(".tablas").on("click", ".btnEliminarCompra", function(){

	var idCompra = $(this).attr("idCompra");
  
	swal({
		  title: '¿Está seguro de borrar la compra?',
		  text: "¡Si no lo está puede cancelar la accíón!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar compra!'
		}).then(function(result){
		  if (result.value) {
			
			  window.location = "index.php?ruta=administrar-Compras&idCompra="+idCompra;
		  }
  
	})
  
})

/*=============================================
IMPRIMIR COMPRA
=============================================*/

$(".tablas").on("click", ".btnImprimirCompra", function(){
	var codigoCompra = $(this).attr("codigoCompra");
	//solicitamos a windoewss q me abra una nueva ventana
	//para pasarlo como GET-> ?codigo="
	window.open("extensiones/tcpdf/pdf/compra.php?codigo="+codigoCompra, "_blank");
})


/*=============================================
PARA AUMENTAR STOCK CON UN CLICK
=============================================*/

var clicked = false;

$(".tablas tbody").on("click", "button.btnAumentarStock", function(){

	var idCompra = $(this).attr("idCompra");
	var estadoCompras = $(this).attr("estadoCompras");
	//console.log(idCompra);
	var datos = new FormData();
	datos.append("idCompra", idCompra);
	datos.append("activarVentas", estadoCompras);
	
	$.ajax({
	
	url:"ajax/compras.ajax.php",
	method: "POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType:"json",
	  success:function(respuesta){
		  
	  //console.log("respuesta",respuesta);


			var compras = JSON.parse(respuesta["compras"]);

			var almacen =[];
			var almacenId =[];
			var union = [];
			//console.log("compras",compras);
			$.each(compras,function(i,value){

				//console.log(value["descripcion"]);

				var datosProducto = new FormData();
				datosProducto.append("idCambiarproducto",value["id_producto"]);
				//console.log("respuestaCambio",value["descripcion"]);
				$.ajax({
		
					url:"ajax/productos.ajax.php",
					method: "POST",
					data: datosProducto,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success:function(respuestaCambio){
						
						if (value["id_producto"] == respuestaCambio["id_producto"] ) {
							almacenId = respuestaCambio["id_producto"];
							almacen = (parseInt(respuestaCambio["stock"]) + parseInt(value["cantidad"]));
							
							
						}
						// $("#nuevaCantidad").val(JSON.stringify(almacen));
						//union = [almacenId,almacen];
						// console.log(almacenId);
						// console.log(almacen);
						
						var datosstock = new FormData();
						datosstock.append("activarStock", almacen);
						datosstock.append("idProducto", almacenId);

						$.ajax({

							url:"ajax/productos.ajax.php",
							method: "POST",
							data: datosstock,
							cache: false,
							contentType: false,
							processData: false,
							success: function(respuesta){


							}

						})
						// window.location = "index.php?ruta=administrar-Compras&union="+union;
					}
		
				})
			
				}); 

			
	
			
	
	  }
	
	})


	
	if(estadoCompras == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Stock Aumentado');
	  $(this).attr('estadoCompras',1);
		
	  

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Aumentar Stock');
	  $(this).attr('estadoCompras',0);
	  swal({
			
		type: "success",
		title: "¡El stock se actualizado correctamente!",
		showConfirmButton: true,
		confirmButtonText: "Cerrar"

		}).then(function(result){

			if(result.value){
			
				window.location = "administrar-Compras";

			}

		});


	}


	
	})

	$('#daterange-btn3').daterangepicker(
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
		  $('#daterange-btn3 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	
		  var fechaInicial = start.format('YYYY-MM-DD');
	
		  var fechaFinal = end.format('YYYY-MM-DD');
	
		  var capturarRango = $("#daterange-btn3 span").html();
	
			 localStorage.setItem("capturarRango", capturarRango);
	
			 window.location = "index.php?ruta=reporte-compras&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	
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
	
			  window.location = "index.php?ruta=reporte-compras&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	
		  }
	
	  })