/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#idCliente").val(respuesta["id_cliente"]);
	       $("#editarCliente").val(respuesta["nombre"]);
	       $("#editarDocumentoId").val(respuesta["documento"]);
	       $("#editarEmail").val(respuesta["email"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
	
	swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }

  })

})

// $("#nuevoDocumentoId").change(function(){
//   $(".alert").remove();
//   //var vector = ["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"];
//   var dniJunto = document.getElementById("nuevoDocumentoId").value;
//   //var dniJuntoMayuscula = "";
//   var comprovador =0;
//   //var numerosDni =0;
//   //var letra = "";
//   //var residuo;
//   var contador = 0;
//   var dniSeparado = dniJunto.split("");

// for(contador =0; contador < dniSeparado.length ; contador++){
//   //Los primeros 8 caracteres tinen que ser numeros
//   if (contador <= 7) {
//     if (isNaN(dniSeparado[contador])) {
//       comprovador = 1;
//     }
    
//   }else{
//     comprovador =1;
//   }

// }

// //para comprobar que la longitud sea 9
// if (contador != 8) {
//   comprovador = 1;
// }
//   if (comprovador == 1){
//     $("#nuevoDocumentoId").parent().after('<div class="alert alert-warning">El DNI es incorrecto</div>');//mensaje de existencia del usuarioenla bd

// 		$("#nuevoDocumentoId").val("");
//   }

// })

$("#salir").click(function(){

  window.location = "index.php?ruta=clientes";
})


$("#nuevoDocumentoId").change(function(){

  $(".alert").remove();
  var validardni = $(this).val();
  
  var datos = new FormData();
  datos.append("validardni", validardni);
  
  $.ajax({
  url:"ajax/clientes.ajax.php",
  method:"POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  dataType: "json",
  success:function(respuesta){
    console.log("respuesta",respuesta);
    if(respuesta){ 
      
      $("#nuevoDocumentoId").parent().after('<div class="alert alert-warning">Este DNI ya existe en la base de datos</div>');//mensaje de existencia del usuarioenla bd
  
      $("#nuevoDocumentoId").val("");
  
    }
  
  }
  
  })
  var dniJunto = document.getElementById("nuevoDocumentoId").value;
  var comprovador =0;
  var contador = 0;
  var dniSeparado = dniJunto.split("");
  for(contador =0; contador < dniSeparado.length ; contador++){
    //Los primeros 8 caracteres tinen que ser numeros
    if (contador <= 7) {
      if (isNaN(dniSeparado[contador])) {
        comprovador = 1;
      }
      
    }else{
      comprovador =1;
    }
  
  }
  
  //para comprobar que la longitud sea 9
  if (contador != 8) {
    comprovador = 1;
  }
  if (comprovador == 1){
    $("#nuevoDocumentoId").parent().after('<div class="alert alert-warning">El numero de DNI es incorrecto</div>');//mensaje de existencia del usuarioenla bd

		$("#nuevoDocumentoId").val("");
  }

  })

  $("#editarDocumentoId").change(function(){

    $(".alert").remove();
    var validardni = $(this).val();
    
    var datos = new FormData();
    datos.append("validardni", validardni);
    
    $.ajax({
    url:"ajax/clientes.ajax.php",
    method:"POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){
      console.log("respuesta",respuesta);
      if(respuesta){ 
        
        $("#editarDocumentoId").parent().after('<div class="alert alert-warning">Este DNI ya existe en la base de datos</div>');//mensaje de existencia del usuarioenla bd
    
        $("#editarDocumentoId").val("");
    
      }
    
    }
    
    })
    var dniJunto = document.getElementById("editarDocumentoId").value;
    var comprovador =0;
    var contador = 0;
    var dniSeparado = dniJunto.split("");
    for(contador =0; contador < dniSeparado.length ; contador++){
      //Los primeros 8 caracteres tinen que ser numeros
      if (contador <= 7) {
        if (isNaN(dniSeparado[contador])) {
          comprovador = 1;
        }
        
      }else{
        comprovador =1;
      }
    
    }
    
    //para comprobar que la longitud sea 9
    if (contador != 8) {
      comprovador = 1;
    }
    if (comprovador == 1){
      $("#editarDocumentoId").parent().after('<div class="alert alert-warning">El numero de DNI es incorrecto</div>');//mensaje de existencia del usuarioenla bd
  
      $("#editarDocumentoId").val("");
    }
  
    })