<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a>
          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span>
                <i class="fa fa-calendar"></i> Rango de fecha
            </span>
                <i class="fa fa-caret-down"></i>
          </button>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Total</th>
           <th>Pendiente</th>
           <th>Fecha</th>
           <th>Comprobante</th>
           <th>Estado</th>
           <th>Acciones</th>
           

         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

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

                  <td>'.$value["metodo_pago"].'</td>

                  <td>S/ '.number_format($value["total"],2).'</td>';

                  if($value["pendiente"] <= 0){
                    echo'<td class="btn btn-success">S/ '.$value["pendiente"].'</td>';

                  }else{

                    echo '<td class="btn btn-danger">S/ '.$value["pendiente"].'</td>';
                  }

                  



                  echo '<td>'.$value["fecha"].'</td>

                  <td>'.$value["tipo_comprobante"].'</td>';
                  

                  if($value["pendiente"] <= 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivarEstadoVentas" idVentas="'.$value["id_venta"].'"  estadoVentas="0" disabled="disabled">CANCELADO</button></td>';
      
                  }else{
      
                    echo '<td><button class="btn btn-danger btn-xs btnActivarEstadoVentas" idVentas="'.$value["id_venta"].'" estadoVentas="1" data-toggle="modal" data-target="#modalEditarCategoria">PAGAR</button></td>';
      
                  }

                  echo '<td>

                  <div class="btn-group">';

                    if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                      echo '<button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
                      <i class="fa fa-print"></i></button>';

                    }
                      

                      //echo '<button class="btn btn-warning btnEditarVenta" 
                     // idVenta="'.$value["id_venta"].'"><i class="fa fa-pencil"></i></button>';

                      //if($_SESSION["perfil"] == "Administrador"){

                        //echo '<button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id_venta"].'"><i class="fa fa-times"></i></button>';

                      //}

                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>
       <?php 
        // $eliminarVenta = new ControladorVentas();
        // $eliminarVenta->ctrEliminarVenta();

        ?>
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL PAGAR LA DEUDA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" class="formularioDeuda">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pagar Deuda</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA la deuda -->

            <?php
            // $valor = null;
            // $item = null;
            // $respuesta = ControladorVentas::ctrMostrarVentas($valor,$item);


            ?>
            

            <div class="form-group row">
              
              <div class="col-xs-6">  
              <label>
                Total
                <span class="text-danger"></span>
              </label> 
                <div class="input-group">
                  <span class="input-group-addon">S/ </i></span> 
                  <input type="number" step="any" class="form-control input-lg" id="nuevoTotalDeuda" name="nuevoTotalDeuda" readonly required>
                </div>
              </div>
              <div class="col-xs-6"> 
              <label>
                Adelanto
                <span class="text-danger"></span>
              </label>  
                <div class="input-group">
                  <span class="input-group-addon">S/ </i></span>
                  <input type="number" step="any" class="form-control input-lg" id="nuevoAdelantoDeuda" name="nuevoAdelantoDeuda" placeholder="Aumentar stock" readonly>
            
                </div>
              </div>
            </div>

            <input type="hidden" class="form-control input-lg" id="llevandoId" name="llevandoId">
             <!-- PENDIENTE -->

            <div class="form-group row">
              
              <div class="col-xs-6">  
              <label>
                Pendiente
                <span class="text-danger"></span>
              </label> 
                <div class="input-group">
                  <span class="input-group-addon">S/ </i></span> 
                  <input type="number" step="any" class="form-control input-lg" id="nuevoPendienteDeuda" name="nuevoPendienteDeuda" readonly required>
                </div>
              </div>
              <div class="col-xs-6"> 
              <label>
                Pago
                <span class="text-danger">*</span>
              </label>  
                <div class="input-group">
                  <span class="input-group-addon">S/</i></span>
                  <input type="number"  step="any" class="form-control input-lg" id="nuevoPagoDeuda" name="nuevoPagoDeuda" min="0" value= "0" placeholder="Aumentar stock">
            
                </div>
              </div>
            </div>
              

            
                
                <!-- ENTRADA PARA PRECIO VENTA -->
                <div class="form-group row">
                <div class="col-xs-6">
                  <label>
                  Restante
                  <span class="text-danger"></span>
                  </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon">S/</i></span> 

                    <input type="number"  step="any" class="form-control input-lg" id="nuevoRestanteDeuda" name="nuevoRestanteDeuda" step="any" readonly required>

                  </div>
                
              
                </div>
                </div>
                

                 <!-- ENTRADA PARA PRECIO COMPRA -->
                
                 <!-- <div class="form-group">
                        <label for="message-text" class="col-form-label">Descripción:</label>
                        <textarea class="form-control" id="nuevoTextDeuda" name="nuevoTextDeuda"></textarea>
                  </div> -->

                

        

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $actualizarStockVenta = new ControladorVentas();
          $actualizarStockVenta -> ctrActualizarVenta();

        ?>      

    </div>

  </div>

</div>





