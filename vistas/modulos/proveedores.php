<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar proveedor

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Proveedor</th>
           <th>Representante</th>
           <th>correo</th>
           <th>dni</th>
           <th>ruc</th>
           <th>celular</th>
           <th>N° cuenta</th>
           <th>estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);
          //var_dump($proveedores);
          foreach ($proveedores as $key => $value) {
          
          echo '<tr>
            <td>'.($key+1).'</td>
            <td>'.$value["nombre_proveedor"].'</td>
            <td>'.$value["nombre_representante"].'</td>
            <td>'.$value["correo"].'</td>
            <td>'.$value["dni"].'</td>
            <td>'.$value["ruc"].'</td>
            <td>'.$value["celular"].'</td>
            <td>'.$value["telefono"].'</td>';

            if($value["estado"] != 0){

              echo '<td><button class="btn btn-success btn-xs btnActivarProveedor" idProveedor="'.$value["id_proveedor"].'" estadoProveedor="0">VIGENTE</button></td>';

            }else{

              echo '<td><button class="btn btn-danger btn-xs btnActivarProveedor" idProveedor="'.$value["id_proveedor"].'" estadoProveedor="1">INACTIVO</button></td>';

            }

            echo '<td>

              <div class="btn-group">
                  
                <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["id_proveedor"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id_proveedor"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR PROVEEDOR
======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL PROVEEDOR -->
            
            <div class="form-group">
              <label>
                Proveedor
                <span class="text-danger">*</span>
              </label>
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreProveedor" id="nuevoNombreProveedor" placeholder="Ingresar proveedor" required>

              </div>

            </div>

         


            <input type="hidden"  name="nuevoCodigoProveedor" id="nuevoCodigoProveedor" readonly>

            <!-- ENTRADA PARA EL REPRESENTANTE -->
            
            <div class="form-group">
            <label>
                Representante
                <span class="text-danger">*</span>
              </label>
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreRepresentante" id="nuevoNombreRepresentante" placeholder="Representante">

              </div>

            </div>

            <!-- ENTRADA PARA LA CORREO -->

             <div class="form-group">
             <label>
                Correo
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCorreoProveedor"  id="nuevaCorreoProveedor" placeholder="Ingresar Correo">

              </div>

            </div>

           

             <!-- ENTRADA PARA DNI -->

            <div class="form-group row">

                <div class="col-xs-6">
                <label>
                DNI
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoDniProveedor" id="nuevoDniProveedor" min="0" placeholder="Ingresar DNI">

                  </div>

                </div>

                <!-- ENTRADA PARA RUC -->

                <div class="col-xs-6">
                <label>
                RUC
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoRucProveedor" id="nuevoRucProveedor" min="0" placeholder="Ingresar RUC">

                  </div>
                
                </div>
            </div>


            <!-- ENTRADA PARA CELULAR -->

            <div class="form-group row">

                <div class="col-xs-6">
                <label>
                Celular
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevaNumeroProveedor" id="nuevaNumeroProveedor" min="0" placeholder="Celular">

                  </div>

                </div>

                <!-- ENTRADA PARA TELEFONO -->

                <div class="col-xs-6">
                <label>
                Numero de cuenta
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoTelefono" id="nuevoTelefono" min="0" placeholder="Numero de cuenta">

                  </div>
                
                </div>
            </div>

            

            <!-- ENTRADA PARA SUBIR FOTO -->

             <!-- <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">

            </div> -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardarCodigo">Guardar proveedor</button>

        </div>

      </form>

      <?php

        $crearProveedor = new ControladorProveedores();
        $crearProveedor -> ctrCrearProveedores();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL PROVEEDOR -->
            
            <div class="form-group">
              <label>
                Nombre
                <span class="text-danger">*</span>
              </label>
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombreProveedor" id="editarNombreProveedor" placeholder="Ingresar proveedor" required>

              </div>

            </div>

            <input type="hidden"  name="editarCodigoProveedor" id="editarCodigoProveedor" readonly required>

            <!-- ENTRADA PARA EL REPRESENTANTE -->
            
            <div class="form-group">
              <label>
                Representante
                <span class="text-danger">*</span>
              </label>
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombreRepresentante" id="editarNombreRepresentante" placeholder="Representante">

              </div>

            </div>

            <!-- ENTRADA PARA LA CORREO -->

             <div class="form-group">
              <label>
                Correo
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCorreoProveedor"  id="editarCorreoProveedor" placeholder="Ingresar Correo">

              </div>

            </div>

           

             <!-- ENTRADA PARA DNI -->

            <div class="form-group row">

                <div class="col-xs-6">
                <label>
                DNI
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarDniProveedor" id="editarDniProveedor" min="0" placeholder="Ingresar DNI">

                  </div>

                </div>

                <!-- ENTRADA PARA RUC -->

                <div class="col-xs-6">
                <label>
                RUC
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarRucProveedor" id="editarRucProveedor" min="0" placeholder="Ingresar RUC">

                  </div>
                
                </div>
            </div>


            <!-- ENTRADA PARA CELULAR -->

            <div class="form-group row">

                <div class="col-xs-6">

                <label>
                Celular
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarNumeroProveedor" id="editarNumeroProveedor" min="0" placeholder="Celular">

                  </div>

                </div>

                <!-- ENTRADA PARA TELEFONO -->

                <div class="col-xs-6">
                <label>
                Numero de cuenta
                <span class="text-danger">*</span>
              </label>
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarTelefono" id="editarTelefono" min="0" placeholder="telefono">

                  </div>
                
                </div>
                <input type="hidden" name="id_proveedorCodigo" id="id_proveedorCodigo">
            </div>

            

            <!-- ENTRADA PARA SUBIR FOTO -->

             <!-- <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">

            </div> -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>

      </form>

      <?php

        $editarProveedor = new ControladorProveedores();
        $editarProveedor -> ctrEditarProveedores();

      ?>

    </div>

  </div>

</div>

<?php

$eliminarProveedor = new ControladorProveedores();
$eliminarProveedor -> ctrEliminarProveedor();

?>