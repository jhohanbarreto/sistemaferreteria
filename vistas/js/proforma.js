/*=============================================
VARIABLE LOCAL STORAGE(FITRO SI BIENEN ESAS VARIABLE EN LOCALSTORE) 
=============================================*/
if (localStorage.getItem("capturarRango") != null) {
	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));
}else{
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

/*=============================================
CARGAR LA TABLA DINAMICA DE PROFORMA XD
=============================================*/

		// $.ajax({
		//     url: "ajax/datatable-ventas.ajax.php",
		//     success:function(respuesta){
		//         console.log("respuesta",respuesta); //vara ver lo que nos trae datatable-productos.ajax.php
		//     }
		// })
        $('.tablaProforma').DataTable( {
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
$(".tablaProforma tbody").on("click", "button.agregarProducto", function(){

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
			var precio = respuesta["precio_venta"]
			

			//console.log(precio2);
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



			sumarTotalPreciosProforma()
			
	       agregarImpuesto()

		   listarProductosProforma()

				//poner formato a al precio del producto
	        $(".nuevoPrecioProducto").number(true, 2);
            

          }
    })
});
/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
//se activa siempre que la tabla se vuelve a cargar
$(".tablaProforma").on("draw.dt", function(){
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

$(".formularioProforma").on("click", "button.quitarProducto", function(){

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

    	sumarTotalPreciosProforma()

    	// AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosProforma()

	}

})
/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/
//para que no se carge los productos varias veces cuando seleccionamos
var numProducto = 0;

$(".btnAgregarProducto1").click(function(){

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

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

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

			 sumarTotalPreciosProforma()

    		// AGREGAR IMPUESTO

	        agregarImpuesto()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})

/*=============================================
SELECCIONAR PRODUCTO PARA EL DISOSITIVO
=============================================*/

$(".formularioProforma").on("change", "select.nuevaDescripcionProducto", function(){

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

	        listarProductosProforma()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioProforma").on("change", "input.nuevaCantidadProducto", function(){

	var numero = $(this).parent().parent().children("input.nuevoPrecioProducto").val();

	var numero123 = $(this).parent().parent().children("input.nuevoPrecioGuardar")
	var descuento = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoDescuento").val();
	
	var precioReal = numero - descuento;

	var precio = $(this).parent().parent().children(".ingresoTotal").children().children(".nuevoTotal");
	
	var precioFinal = precioReal * $(this).val();

	precio.val(precioFinal);
	numero123.val(precioReal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

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

	sumarTotalPreciosProforma()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosProforma()

})
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosProforma(){

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
LISTAR TODOS LOS PRODUCTOS
=============================================*/
//se va ejecutar cuando hay suma resta
function listarProductosProforma(){

	var listaProductosProforma = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var descuento = $(".nuevoDescuento");

	var precio = $(".nuevoPrecioGuardar");
	
	var precioFinal = $(".nuevoTotal");

	for(var i = 0; i < descripcion.length; i++){


		listaProductosProforma.push({ "id_producto" : $(descripcion[i]).attr("idProducto"),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "descuento" : $(descuento[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).val(),
							  "total" : $(precioFinal[i]).val()})

	}
	//console.log("listaProductosProforma",listaProductosProforma);

	$("#listaProductosProforma").val(JSON.stringify(listaProductosProforma));

}
/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaProforma tbody button.agregarProducto");

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

$('.tablaProforma').on( 'draw.dt', function(){

	quitarAgregarProducto();

})

/*=============================================
PARA EL BOTON EDITAR PROFORMA
=============================================*/

$(".tablas").on("click",".btnEditarProforma",function(){
	//console.log("idVenta",idVenta);
	var idProforma = $(this).attr("idProforma");
	window.location = "index.php?ruta=editar-proforma&idProforma="+idProforma;
})

/*=============================================
PARA EL BOTON GENERAR VENTA DESDE PROFORMA
=============================================*/

$(".tablas").on("click",".btnCrearVenta",function(){
	//console.log("idVenta",idVenta);
	var idProformaVenta = $(this).attr("idProformaVenta");

	window.location = "index.php?ruta=editar-venta&idProformaVenta="+idProformaVenta;

})


/*=============================================
BORRAR PROFORMA
=============================================*/
$(".tablas").on("click", ".btnEliminarProforma", function(){

	var idProforma = $(this).attr("idProforma");
  
	swal({
		  title: '¿Está seguro de borrar la venta?',
		  text: "¡Si no lo está puede cancelar la accíón!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar venta!'
		}).then(function(result){
		  if (result.value) {
			
			  window.location = "index.php?ruta=proforma&idProforma="+idProforma;
		  }
  
	})
  
})
/*=============================================
IMPRIMIR PROFORMA
=============================================*/

$(".tablas").on("click", ".btnImprimirProforma", function(){
	var codigoProforma = $(this).attr("codigoProforma");
	//solicitamos a windoewss q me abra una nueva ventana
	//para pasarlo como GET-> ?codigo="
	window.open("extensiones/tcpdf/pdf/proforma.php?codigo="+codigoProforma, "_blank");
})




// $('#daterange-btn').daterangepicker(
// 	{
// 	  ranges   : {
// 		'Hoy'       : [moment(), moment()],
// 		'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
// 		'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
// 		'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
// 		'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
// 		'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
// 	  },
// 	  startDate: moment(),
// 	  endDate  : moment()
// 	},
// 	function (start, end) {
// 	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  
// 	  var fechaInicial = start.format('YYYY-MM-DD');
  
// 	  var fechaFinal = end.format('YYYY-MM-DD');
  
// 	  var capturarRango = $("#daterange-btn span").html();
	 
// 		 localStorage.setItem("capturarRango", capturarRango);
  
// 		 window.location = "index.php?ruta=proforma&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
// 	}
  
//   )
  

  
//   $(".daterangepicker.opensleft.opensleft .range_inputs .cancelBtn").on("click", function(){
  
// 	  localStorage.removeItem("capturarRango");
// 	  localStorage.clear();
// 	  window.location = "proforma";
//   })
  

  
//   $(".daterangepicker.opensleft.opensleft .ranges li").on("click", function(){
  
// 	  var textoHoy = $(this).attr("data-range-key");
  
// 	  if(textoHoy == "Hoy"){
  
// 		  var d = new Date();
		  
// 		  var dia = d.getDate();
// 		  var mes = d.getMonth()+1;
// 		  var año = d.getFullYear();

// 		  if(mes < 10 && dia < 10){
  
// 			var fechaInicial = año+"-0"+mes+"-0"+dia;
// 			var fechaFinal = año+"-0"+mes+"-0"+dia;
		  
// 		  }else if(dia < 10){
  
// 			  var fechaInicial = año+"-"+mes+"-0"+dia;
// 			  var fechaFinal = año+"-"+mes+"-0"+dia;
  
// 		  }else if(mes < 10){
  
// 			var fechaInicial = año+"-0"+mes+"-"+dia;
// 			var fechaFinal = año+"-0"+mes+"-"+dia;
  
// 		  }else{
  
// 			  var fechaInicial = año+"-"+mes+"-"+dia;
// 			  var fechaFinal = año+"-"+mes+"-"+dia;
  
// 		  }	
  
// 		  localStorage.setItem("capturarRango", "Hoy");
  
// 		  window.location = "index.php?ruta=proforma&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
// 	  }
  
//   })


$(".formularioProforma").on("change", "input.nuevoDescuento", function(){
	//descuento
	//var descuento = $(this).parent().parent().parent().children(".ingresoPrecio").children(".nuevoDescuento").val();

	//precio real
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

	sumarTotalPreciosProforma()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosProforma()
})

/*=============================================
IMPRIMIR PROFORMA
=============================================*/

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#agregarClienteProforma").click(function(){

	console.log("hola mundo");

});