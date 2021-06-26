<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar compras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar compras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="compras">

          <button class="btn btn-primary">
            
            Agregar compra

          </button>

        </a>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código compra</th>
           <th>Proveedor</th>
           <th>Comprador</th>
   
           <th>Total</th> 
           <th>Fecha</th>
           <th>Estado</th> 
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        //   if(isset($_GET["fechaInicial"])){

        //     $fechaInicial = $_GET["fechaInicial"];
        //     $fechaFinal = $_GET["fechaFinal"];

        //   }else{

        //     $fechaInicial = null;
        //     $fechaFinal = null;

        //   }

            $item = null;
            $valor = null;

          $respuesta = ControladorCompras::ctrMostrarCompra($item, $valor);

          foreach ($respuesta as $key => $value) {
           

            echo '<tr>
 
                   <td>'.($key+1).'</td>
 
                   <td>'.$value["codigo"].'</td>';
 
                   $itemProveedor = "id_proveedor";
                   $valorProveedor = $value["id_proveedor"];
 
                   $respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);
 
                   echo '<td>'.$respuestaProveedor["nombre_proveedor"].'</td>';
 
                   $itemUsuario = "id_usuario";
                   $valorUsuario = $value["id_usuario"];
 
                   $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
 
                   echo '<td>'.$respuestaUsuario["nombre"].'</td>
 
                   <td>S/ '.number_format($value["total"],2).'</td>
 
                   <td>'.$value["fecha"].'</td>';

                  if ($value["estado"] != 0) {

                    echo'<td><button class="btn btn-danger btn-s btnAumentarStock"  id="activarxd" idCompra="'.$value["id_compra"].'" estadoCompras="0" disabled="disabled" >Stock Aumentado</button></td>';

                    
                  }else{
                    
                    echo'<td><button class="btn btn-success btn-s btnAumentarStock" id="activarxd" idCompra="'.$value["id_compra"].'" estadoCompras="1" >Aumentar Stock</button></td>';
                  }
                   

 
                   echo'<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-info btnImprimirCompra" codigoCompra="'.$value["codigo"].'"><i class="fa fa-print"></i></button>';

                       if ($value["estado"] == 0) {

                        echo'<button class="btn btn-warning btnEditarCompra" idCompra="'.$value["id_compra"].'"><i class="fa fa-pencil"></i></button>';
                      }else{
                        echo'<button class="btn btn-warning btnEditarCompra" idCompra="'.$value["id_compra"].'" disabled="disabled"><i class="fa fa-pencil"></i></button>';
    
                      }

 
 
                       echo '<button class="btn btn-danger btnEliminarCompra" idCompra="'.$value["id_compra"].'"><i class="fa fa-times"></i></button>
 
                     </div>  
 
                   </td>
 
                 </tr>';
             }

        ?>
               
        </tbody>

       
      </div>

    </div>

  </section>

</div>

</table>




<?php
  $eliminarCompra = new ControladorCompras();
  $eliminarCompra->ctrEliminarCompra();

?>



