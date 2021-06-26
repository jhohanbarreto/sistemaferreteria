<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar proforma
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proforma</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-proforma">

          <button class="btn btn-primary">
            
            Agregar proforma

          </button>

        </a>
          <!-- <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span>
                <i class="fa fa-calendar"></i> Rango de fecha
            </span>
                <i class="fa fa-caret-down"></i>
          </button> -->

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código proforma</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Neto</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Generar venta</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $respuesta = ControladorProforma::ctrMostrarProforma($item, $valor);

          foreach ($respuesta as $key => $value) {
           

           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id_cliente";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id_usuario";
                  $valorUsuario = $value["id_usuario"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>S/ '.number_format($value["neto"],2).'</td>

                  <td>S/ '.number_format($value["total"],2).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td><button class="btn btn-success btn-s btnCrearVenta" idProformaVenta="'.$value["id_proforma"].'">Generar Venta</button></td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirProforma" codigoProforma="'.$value["codigo"].'"><i class="fa fa-print"></i></button>

                      <button class="btn btn-warning btnEditarProforma" idProforma="'.$value["id_proforma"].'"><i class="fa fa-pencil"></i></button>';

                      
                      if($_SESSION["perfil"] == "Administrador"){
                      echo '<button class="btn btn-danger btnEliminarProforma" idProforma="'.$value["id_proforma"].'"><i class="fa fa-times"></i></button>';
                      }
                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorProforma();
      $eliminarVenta -> ctrEliminarProforma();
      //$eliminarVenta1 -> ctrEliminarProforma1();

      ?>
       

      </div>

    </div>

  </section>

</div>




