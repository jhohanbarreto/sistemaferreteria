<?php 
    $item =null;
    $valor =null;
    $compras = ControladorCompras::ctrMostrarCompra($item,$valor);
    $proveedores = ControladorProveedores::ctrMostrarProveedores($item,$valor);

    //para capturarlos vendedores
    $arrayVendedores = array();
    foreach ($compras as $key => $valueCompras) {
        foreach ($proveedores as $key => $valueProveedores) {
            if ($valueProveedores["id_proveedor"] == $valueCompras["id_proveedor"]) {
                array_push($arrayVendedores,$valueProveedores["nombre_proveedor"]);
                //var_dump($arrayVendedores);
                $arraylistaVendedor = array($valueProveedores["nombre_proveedor"]=>$valueCompras["total"]);
                //var_dump($arraylistaVendedor);

                foreach ($arraylistaVendedor as $key => $value) {
                $sumaTotalVendedores[$key] += $value;

            }
            
            }

        }
    }
    #Evitar repetir nombres
    $noRepetirNombres = array_unique($arrayVendedores);
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Proveedores</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart1" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [
          <?php 
            foreach ($noRepetirNombres as $value) {
                echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";
                }
        ?>
      ],
      barColors: ['#00a65a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['compras'],
      preUnits: 'S/',
      hideHover: 'auto'
    });
</script>