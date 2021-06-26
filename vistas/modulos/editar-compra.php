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

                <?php 
                        $item = "id_compra";
                        $valor= $_GET["idCompra"];

                        $compra = ControladorCompras::ctrMostrarCompra($item,$valor);
                        //var_dump($compra);
                        $itemUsuario = "id_usuario";
                        $valorUsuario = $compra["id_usuario"];
                        $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);

                        $itemCliente = "id_proveedor";
                        $valorCliente = $compra["id_proveedor"];
                        $proveedor = ControladorProveedores::ctrMostrarProveedores($itemCliente,$valorCliente);

                    ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoComprador" name="nuevoComprador" value="<?php echo $vendedor["nombre"];?>" readonly>
                    <input type="hidden" name="idComprador" value="<?php echo $vendedor["id_usuario"];?>">
                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    
                    <input type="text" class="form-control" id="nuevaCompra" name="editarCompra" value="<?php echo $compra["codigo"];?>" readonly>
                   
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control selectpicker" id="seleccionarProveedor" name="seleccionarProveedor" data-Live-search="true" required>
                      <option value="<?php echo $proveedor['id_proveedor'];?>"><?php echo $proveedor['nombre_proveedor'];?></option>
                      <?php 
                      $item =null;
                      $valor = null;
                      $proveedores = ControladorProveedores::ctrMostrarProveedores($item,$valor);
                      foreach ($proveedores as $key => $value) {
                        echo '<option value="'.$value["id_proveedor"].'">'.$value["nombre_proveedor"].'</option>';
                      }  
                      ?>
                      
                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                      <?php 

                $listaProducto = json_decode($compra["compras"],true);
                foreach ($listaProducto as $key => $value) {
                  // -------------------------------------------
                    $item = "id_producto";
                    $valor = $value["id_producto"];
                    $orden ="id_producto";

  
                    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);
  
                    $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                    
                    echo '<div class="row" style="padding:5px 15px">
              
                          <div class="col-xs-6" style="padding-right:0px">
              
                            <div class="input-group">
                  
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id_producto"].'"><i class="fa fa-times"></i></button></span>
  
                              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id_producto"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
  
                            </div>
  
                          </div>
  
                          <div class="col-xs-3">
                
                            <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
  
                          </div>
  
                          <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
  
                            <div class="input-group">
  
                              <span class="input-group-addon">S/</i></span>
                     
                              <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
     
                            </div>
                 
                          </div>
  
                        </div>';
                  }
                ?>

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

                              <input type="text" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" value="<?php echo $compra["total"];?>" readonly required>
                              <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $compra["total"];?>">    
                              
                        
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
            $editarCompra = new ControladorCompras();
            $editarCompra->ctrEditarCompra();

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
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

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

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento">

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÃ‰FONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telÃ©fono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÃ“N -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direcciÃ³n">

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>
