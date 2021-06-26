<?php 
error_reporting(0);
//preguntar si estamos enviando un avariable con fecha inicial
if(isset($_GET["fechaInicial"])){


    $fechaInicial = $_GET["fechaInicial"];

    $fechaFinal = $_GET["fechaFinal"];

}else{

    $fechaInicial = null;
    $fechaFinal = null;

}

  $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
//   var_dump($respuesta);
  //para poder almacenar la fechas que queremos xd
  $arrayFechas = array();

  $arrayVentas = array();

  $sumaPagosMes = array();

  foreach ($respuesta as $key => $value) {

                //var_dump($value["fecha"]);
        #CAPTUREMOS SOLO EL ANIO Y EL MES y dia
        $fecha = substr($value["fecha"],0,7);
                // var_dump($fecha);

            array_push($arrayFechas,$fecha);
        #CAPTUREMOS LAS VENTAS
        $arrayVentas = array($fecha=>$value["total"]);
        //var_dump($arrayVentas);

            foreach ($arrayVentas as $key => $value) {
                $sumaPagosMes[$key] += $value; 
            }
    }
    //var_dump($sumaPagosMes);
    $noRepetirFechas = array_unique($arrayFechas);
    //var_dump($noRepetirFechas);
    //var_dump($arrayFechas);
?>
  <!--PARA PODER UTILIZAR EL GRAFICO-->

<!--GRAFICO DE VENTAS-->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Grafico de ventas</h3>
    </div>
    <div class="bx-body border-radius-nome nuevoGraficoVentas">
        <div class="chart" id="line-chart-ventas" style="height:250px"></div> 
    </div>

</div>
<script>

	
    var line = new Morris.Line({
       element          : 'line-chart-ventas',
       resize           : true,
       data             : [
   
       <?php
   
       if($noRepetirFechas != null){
   
           foreach($noRepetirFechas as $key){
   
               echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";
   
   
           }
   
           echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";
   
       }else{
   
          echo "{ y: '0', ventas: '0' }";
   
       }
   
       ?>
   
       ],
       xkey             : 'y',
       ykeys            : ['ventas'],
       labels           : ['ventas'],
       lineColors       : ['#efefef'],
       lineWidth        : 2,
       hideHover        : 'auto',
       gridTextColor    : '#fff',
       gridStrokeWidth  : 0.4,
       pointSize        : 4,
       pointStrokeColors: ['#efefef'],
       gridLineColor    : '#efefef',
       gridTextFamily   : 'Open Sans',
       preUnits         : 'S/ ',
       gridTextSize     : 10
     });
   
   </script>