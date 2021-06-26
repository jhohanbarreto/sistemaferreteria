<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Promociones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Promociones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalEnviarPromocion">
          
          Enviar Promoción
        </button>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPromocion">
          
          Agregar promoción
      

        </button>

        

      </div>
      

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Descripción</th>
           <th>PrecioReal</th>
           <th>Promocion</th>
           <th>Preciorebajado</th>
           <th>Fecha inicio</th> 
           <th>Total final</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
        <?php
          $item = null;
          $valor = null;
          date_default_timezone_set('America/Lima');
          $hoy = date("Y-m-d");
          $promocion = ControladorPromocion::ctrMostrarPomocion($item, $valor);
          //var_dump($promocion);

          foreach ($promocion as $key => $value) {
            
          echo'<tr>

            <td>'.($key + 1).'</td>

            <td>'.$value["nombre"].'</td>

            <td>'.$value["descripcion"].'</td>

            <td>'.'S/ '.$value["precioReal"].'</td>

            <td>'.$value["porcentaje"].' %'.'</td>

            <td>'.'S/ '.$value["precioRebajado"].'</td>

            <td>'.$value["fecha_inicio"].'</td>

            <td>'.$value["fecha_final"].'</td>

            <td>';
            if ($hoy <= $value["fecha_final"]) {
              echo'<button class="btn btn-success btn-s">Activo</button>
            </td>';
            }else{
              echo'<button class="btn btn-danger btn-s">Desactivado</button>
            </td>';
            }
          
            echo'<td>

              <div class="btn-group">
                  
                <button class="btn btn-warning btnEditarPromocion" data-toggle="modal" data-target="#modalEditarPromocion" idPromocion="'.$value["id_oferta"].'"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger btnEliminarPromocion" idPromocion="'.$value["id_oferta"].'"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>';
          }
        
          ?>
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR AGREGAR PROMOCION
======================================-->

<div id="modalAgregarPromocion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">
    <!-- enctype="multipart/form-data" ->esto es para que muestre la direccion de la imagen -->
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Promoción</h4>

        </div>


        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nombrePromocion"id="nombrePromocion" placeholder="Ingresar nombre" required>

              </div>

            </div>
          
            <!-- ENTRADA PARA EL PRODUCTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg selectpicker" name="nuevaPromocion" id="nuevaPromocion" data-Live-search="true" >
                <option value="">Selecionar producto</option>
                 <?php

                    $item = null;
                    $valor = null;

                    $descuento = ControladorProductos::ctrMostrarProductos123($item, $valor);
                    foreach ($descuento as $key => $value) {
                      echo '<option value="'.$value["id_producto"].'">'.$value["descripcion"].'</option>';
                    }

                  ?>

                </select>

              </div>

            </div>
            
            <div class="form-group">
              
              <div class="input-group">
              
            
                <input type="hidden" class="form-control input-lg" name="nombreProducto1" id="nombreProducto1" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO DEL PRODUCTO-->

            <div class="form-group row">

              <div class="col-xs-4">

                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" name="precioActualPromocion" id="precioActualPromocion" placeholder="Precio" readonly required>
                  

                </div>

              </div>

              <!-- ENTRADA PARA PORCENTAJE -->

              <div class="col-xs-4">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg promocionPorcentaje" min="0" name="promocionPorcentaje" id="promocionPorcentaje" placeholder="Porcentaje" required>

                   

                  </div>

                </div>

              <!-- ENTRADA PARA PRECIO REBAJADO -->

              <div class="col-xs-4">

                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoPrecioRebajado" id="nuevoPrecioRebajado" placeholder="Precio de venta" required>

                </div>
              </div>
            </div>


            
            
            <div class="form-group row">

              <!-- ENTRADA DESCRIPCION -->
            

              <div class="col-xs-7">

                <div class="form-group green-border-focus">
                  <textarea class="form-control input-lg" id="descripcionPromocion" name="descripcionPromocion" rows="4" placeholder="Descripción"></textarea>
                </div>

              </div>

              <!-- ENTRADA FECHA DE INICIO -->
              <div class="col-xs-5">

                <div class="input-group">
                    <br>
                  
                  <input class="form-control input-lg" type="text" id="datePromocion-btn" name="datePromocion-btn" placeholder="Ingrese la fecha" required>
                  <input type="hidden" name="fechaInicio" id="fechaInicio">
                  <input type="hidden" name="fechaFinal" id="fechaFinal">

                </div>

              </div>
             
            
          
            </div>
         <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

                <input type="file" class="nuevaFotoPromocion" name="nuevaFotoPromocion">

                <p class="help-block">Peso máximo de la foto 2MB</p>

                <img src="vistas/img/promocion/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>
            
          </div>
          

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary">Guardar promocion</button>

        </div>
        <?php

        $crearPromocion = new ControladorPromocion();
        $crearPromocion -> ctrCrearPromocion();

        ?>
      </form>
     
    </div>

  </div>

</div>


<!--=====================================
EDITAR PROMOCION
======================================-->


<div id="modalEditarPromocion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Promoción</h4>

        </div>


        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarnombrePromocion" id="editarnombrePromocion" placeholder="Ingresar nombre" readonly required>
                
              </div>

            </div>
          
            <!-- ENTRADA PARA EL PRODUCTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg selectpicker" name="editarnuevaPromocion" id="editarnuevaPromocion" data-Live-search="true" >

                <option id="editajhohan"></option>
                 <?php

                    $item = null;
                    $valor = null;

                    $descuento = ControladorProductos::ctrMostrarProductos123($item, $valor);
                    foreach ($descuento as $key => $value) {
                      echo '<option value="'.$value["id_producto"].'">'.$value["descripcion"].'</option>';
                    }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO DEL PRODUCTO-->

            <div class="form-group row">

              <div class="col-xs-4">

                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" name="editarprecioActualPromocion" id="editarprecioActualPromocion" placeholder="Precio" readonly required>
                  <input type="hidden" id="idPromocion" name="idPromocion">
                  

                </div>

              </div>

              <!-- ENTRADA PARA PORCENTAJE -->

              <div class="col-xs-4">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg promocionPorcentaje" min="0" name="editarpromocionPorcentaje" id="editarpromocionPorcentaje" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              <!-- ENTRADA PARA PRECIO REBAJADO -->

              <div class="col-xs-4">

                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="text" class="form-control input-lg" name="editarnuevoPrecioRebajado" id="editarnuevoPrecioRebajado" placeholder="Precio de venta" required>

                </div>
              </div>
            </div>


            
            
            <div class="form-group row">

              <!-- ENTRADA DESCRIPCION -->
            

              <div class="col-xs-8">

                <div class="form-group green-border-focus">
                  <textarea class="form-control" id="editardescripcionPromocion" name="editardescripcionPromocion" rows="4" placeholder="Descripción"></textarea>
                </div>

              </div>

              <!-- ENTRADA FECHA DE INICIO -->
              <div class="col-xs-4">

                <div class="input-group">
                
                  <input type="text" id="editardatePromocion-btn" name="editardatePromocion-btn" placeholder="Ingrese la fecha" required>
                  <input type="hidden" name="editarfechaInicio" id="editarfechaInicio">
                  <input type="hidden" name="editarfechaFinal" id="editarfechaFinal">

                </div>

              </div>
             
            

            </div>

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

                <input type="file" class="nuevaFotoPromocion" name="editarnuevaFotoPromocion">

                <p class="help-block">Peso máximo de la foto 2MB</p>

                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                <input type="hidden" name="fotoActualPromocion" id="fotoActualPromocion">

            </div>
            
          </div>
          

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>
        
      </form>
      <?php

        $editarPromocion = new ControladorPromocion();
        $editarPromocion -> ctrEditarPromocion();

        ?>
      
    </div>

  </div>

</div>

<?php

$eliminarPromocion = new ControladorPromocion();
$eliminarPromocion -> ctrEliminarPromocion();
?>



<!--=====================================
MODAL ENVIAR PROMOCION
======================================-->

<div id="modalEnviarPromocion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Enviar promoción</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
    

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <!-- <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div> -->
            <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg selectpicker" name="cliente2" id="cliente2" data-Live-search="true" >

                <option value="">Selecionar cliente</option>
                 <?php

                    $item = null;
                    $valor = null;

                    $descuento = ControladorClientes::ctrMostrarClientes($item, $valor);

                    //var_dump($descuento);
                    
                    foreach ($descuento as $key => $value) {
                      echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                    }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="email" id="email" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg selectpicker" name="enviarPromocion2" id="enviarPromocion2" data-Live-search="true" >

                <option value="">Selecionar producto</option>
                 <?php

                    $item = null;
                    $valor = null;

                    $descuento = ControladorPromocion::ctrMostrarPomocion($item, $valor);

                    //var_dump($descuento);
                    
                    foreach ($descuento as $key => $value) {
                      echo '<option value="'.$value["id_oferta"].'">'.$value["nombre"].'</option>';
                    }

                  ?>

                </select>

              </div>

            </div>
            
            
              
            
                <input type="hidden" class="form-control input-lg" name="producto3" id="producto3" required>

              
              
            
                <input type="hidden" class="form-control input-lg" name="precioReal2" id="precioReal2" required>

              
              

                <input type="hidden" class="form-control input-lg" name="descuentoPorcentual" id="descuentoPorcentual" required>


              
              
            

                <input type="hidden" class="form-control input-lg" name="precioRebajado2" id="precioRebajado2" required>


              
              
        
                <input type="hidden" class="form-control input-lg" name="fechaInicio2" id="fechaInicio2" required>

              
              
            
                <input type="hidden" class="form-control input-lg" name="fechaFinal2" id="fechaFinal2" required>
                
                
                <input type="hidden" class="form-control input-lg" name="imagen" id="imagen" required>

              

    
             <!-- ENTRADA DESCRIPCION-->
            
            <div class="form-group">
              
              <div class="input-group">
              
              <textarea class="form-control input-lg" name="mensaje" id="mensaje" placeholder="Asunto" rows="3" style="margin: 0px; width: 549px; height: 79px;" readonly></textarea>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary">Enviar Correo</button>

        </div>

      </form>

      <?php

        $editarCliente = new ControladorMensaje();
        $editarCliente -> ctrCrearMensaje();

      ?>

    </div>

  </div>

</div>



