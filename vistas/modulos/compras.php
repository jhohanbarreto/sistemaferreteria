<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Realizar compra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Realizar compra</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioCompra">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoComprador" name="nuevoComprador" value="<?php echo $_SESSION["nombre"];?>" readonly>
                    <input type="hidden" name="idComprador" value="<?php echo $_SESSION["id_usuario"];?>">
                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <?php
                      $item = null;
                      $valor = null;
                      $compra = ControladorCompras::ctrMostrarCompra($item,$valor);
                      //var_dump($proforma);
                      if(!$compra){
                        echo '<input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" value="10001" readonly>';
                      }else{
                        foreach ($compra as $key => $value) {
                        }
                        //var_dump($value);
                        $codigo = $value["codigo"] + 1;
                        echo '<input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" value="'.$codigo.'" readonly>';
                      }
                      ?>
                    </div>
                  
                  </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control selectpicker" id="seleccionarProveedor" name="seleccionarProveedor" data-Live-search="true" required>
                      <option value="">Seleccionar proveedor</option>
                      <?php

                        $item = null;
                        $valor = null;

                        $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                        //var_dump($comprador);

                        foreach ($proveedor as $key => $value) {

                          echo '<option value="'.$value["id_proveedor"].'">'.$value["nombre_proveedor"].'</option>';
                        }
                        ?>
                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">
                </div>
                <input type="hidden" id="listaProductosCompra" name="listaProductosCompra">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoCompra">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon">S/</i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar compra</button>

          </div>

        </form>

        <?php
            $guardarCompra = new ControladorCompras();
            $guardarCompra->ctrCrearCompra();

            ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaCompras" width="100%">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Codigo </th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


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
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreProveedor" id="nuevoNombreProveedor" placeholder="Ingresar proveedor" required>

              </div>

            </div>

         


            <input type="hidden"  name="nuevoCodigoProveedor" id="nuevoCodigoProveedor" readonly>

            <!-- ENTRADA PARA EL REPRESENTANTE -->
            
            <div class="form-group">
            
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreRepresentante" id="nuevoNombreRepresentante" placeholder="Representante">

              </div>

            </div>

            <!-- ENTRADA PARA LA CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCorreoProveedor"  id="nuevaCorreoProveedor" placeholder="Ingresar Correo">

              </div>

            </div>

           

             <!-- ENTRADA PARA DNI -->

            <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoDniProveedor" id="nuevoDniProveedor" min="0" placeholder="Ingresar DNI">

                  </div>

                </div>

                <!-- ENTRADA PARA RUC -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoRucProveedor" id="nuevoRucProveedor" min="0" placeholder="Ingresar RUC">

                  </div>
                
                </div>
            </div>


            <!-- ENTRADA PARA CELULAR -->

            <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevaNumeroProveedor" id="nuevaNumeroProveedor" min="0" placeholder="Celular">

                  </div>

                </div>

                <!-- ENTRADA PARA TELEFONO -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoTelefono" id="nuevoTelefono" min="0" placeholder="telefono">

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
