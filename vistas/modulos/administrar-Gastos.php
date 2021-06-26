<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar gastos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar gastos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPGasto" id="agregarGasto">
          
          Agregar un gasto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>
          
            <tr>
              
              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoria</th>
              <th>Monto</th>
              <th>FechaAgregado</th>
              <th>Acciones</th>

            </tr> 

          </thead>

              <?php 
                $item = null;
                $valor = null;
                
                $gastos = ControladorGastos::ctrMostrarGasto($item,$valor);
                //var_dump($productos);
                foreach ($gastos as $key => $value) {
          
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["codigo"].'</td>
                          <td>'.$value["descripcion"].'</td>';
        
                          $item = "id_categoriagastos";
                          $valor = $value["id_categoriagastos"];
        
                          $categoria = ControladorCategoriaGastos::ctrMostrarCategoriaGasto($item, $valor);
        
                         echo '<td>'.$categoria["categoria"].'</td>
                          <td>'.$value["monto"].'</td>
                          <td>'.$value["fecha"].'</td>
                          <td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btnEditarGasto" data-toggle="modal" data-target="#modalEditarGasto" idGasto="'.$value["id_gasto"].'"><i class="fa fa-pencil"></i></button>
                                
                                <button class="btn btn-danger btnEliminarGasto" idGasto="'.$value["id_gasto"].'" idcodigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

                                

                              </div>  

                          </td>
        
                        </tr>';
        
                }
        
                ?>
        
            


       </table>
      
      <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarPGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL PRODUCTO
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL PRODUCTO
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
            <!-- ENTRADA PARA LA CATEGORIA -->

            <div class="form-group">
                <label>
                  Categoría
                  <span class="text-danger">*</span>
                </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="js-example-placeholder-single js-states form-control input-lg selectpicker" id="nuevaGasto" name="nuevaGasto" data-Live-search="true" required>
                  
                  <option value="">Selecionar categoría</option>
                  <?php

                  $item =null;
                  $valor = null;

                  $categorias =  ControladorCategoriaGastos::ctrMostrarCategoriaGasto($item,$valor);
                    foreach ($categorias as $key => $value) {
                      echo '<option value="'.$value["id_categoriaGastos"].'">'.$value["categoria"].'</option>';
                    }
                  
                  ?>

                </select>

              </div>

            </div>


            <div class="form-group">
                <label>
                  Codigo
                  <span class="text-danger">*</span>
                </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Codigo" readonly required>

              </div>

            </div>


             <div class="form-group">

                <label>
                  Descripción
                  <span class="text-danger">*</span>
                </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" id="nuevaDescripcion" placeholder="Ingresar Descripcion" required>

              </div>

            </div>

            

            <div class="form-group row">
              <div class="col-xs-12 col-sm-6">
                <label>
                  Monto
                  <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-addon">S/</i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoMonto" min="0" placeholder="Ingresar monto" required>
                </div>
              </div>
            </div>
                
                <!-- <br>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal-red porcentaje" checked>
                      Utilizar Porcentaje
                    </label>
                  </div>
                </div>
                <div class="col-xs-6" style ="padding:0">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div> -->

              


             <!-- <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la foto 2 MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div> -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>
          <?php
            
            $crearGastos = new ControladorGastos();
            $crearGastos->ctrIngresoGasto();
          
          
          ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
            <label>
              Categoria
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
            <label>
                Codigo
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              <label>
                Descripción
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

            <div class="form-group row">
              <div class="col-xs-12 col-sm-6">
                <label>
                  Monto
                  <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-addon">S/</i></span> 
                  <input type="number" class="form-control input-lg" name="editarnuevoMonto" id="editarnuevoMonto" min="0" placeholder="Ingresar monto" required>
                </div>
              </div>
            </div>
              


            <!-- ENTRADA PARA SUBIR FOTO -->

            <!-- <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

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

          $editarGasto = new ControladorGastos();
          $editarGasto -> ctrEditarGasto();

        ?>      

    </div>

  </div>

</div>
<?php

  $eliminarGasto = new ControladorGastos();
  $eliminarGasto -> ctrEliminarGasto();

?>  

