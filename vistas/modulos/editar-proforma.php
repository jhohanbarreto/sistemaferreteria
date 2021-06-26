<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear proforma
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear proforma</li>
    
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

          <form role="form" method="post" class="formularioProforma">

            <div class="box-body">
  
              <div class="box">

              <?php 
                    $item = "id_proforma";
                    $valor= $_GET["idProforma"];

                    $proforma = ControladorProforma::ctrMostrarProforma($item,$valor);
                    //var_dump($venta);
                    $itemUsuario = "id_usuario";
                    $valorUsuario = $proforma["id_usuario"];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);

                    $itemCliente = "id_cliente";
                    $valorCliente = $proforma["id_cliente"];
                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente,$valorCliente);

                    $porcentajeImpuesto = $proforma["impuesto"]*100/$proforma["neto"];
                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"];?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id_usuario"];?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    
                    <input type="text" class="form-control" id="nuevaProforma" name="editarProforma" value="<?php echo $proforma["codigo"];?>" readonly>
                   
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control selectpicker" id="seleccionarCliente" name="seleccionarCliente" data-Live-search="true" required>
                      <option value="<?php echo $cliente['id_cliente'];?>"><?php echo $cliente['nombre'];?></option>
                      <?php 
                      $item =null;
                      $valor = null;
                      $clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
                      foreach ($clientes as $key => $value) {
                        echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                      }  
                      ?>
                      
                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <div class="box">
                <div class="box-header with-border">
                <div class="row" style="padding:5px 15px">
                <div class="col-xs-5" >
                    <span>Lista de Productos</span>
                </div>
                <div class="col-xs-2">
                    <span>Cantidad</span>
                </div>
                <div class="col-xs-2">
                    <span>Descuento</span>
                </div>
                <div class="col-xs-3">
                    <span>Sub total</span>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group row nuevoProducto">


                <?php 

                $listaProducto = json_decode($proforma["compra"],true);
                foreach ($listaProducto as $key => $value) {
                  // -------------------------------------------
                    $item = "id_producto";
                    $valor = $value["id_producto"];
                    $orden ="id_producto";

  
                    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);
                    //var_dump($respuesta);
                    $stockAntiguo = $respuesta["stock"] + $value["cantidad"];

                    $precio = $respuesta["precio_venta"];
                    $cantidad = $value["cantidad"];
                    
                    echo '<div class="row" style="padding:5px 15px">
            
                  
            
                    <div class="col-xs-5" style="padding-right:0px">
            
                    <div class="input-group">
            
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id_producto"].'"><i class="fa fa-times"></i></button></span>
            
                      <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id_producto"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
            
                    </div>
            
                    </div>
            
        
            
                    <div class="col-xs-2 ingresoCantidad" style="padding-right:0px">
            
                     <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" step="any" value="'.$cantidad.'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
            
                    </div>
            
                    <div class="col-xs-2 ingresoPrecio">
                        <div class="input-group">

                          <input type="number" step="any" class="form-control nuevoDescuento" name="nuevoDescuento" min="0" value="'.$value["descuento"].'" required>
                            
                        </div>
                    </div>

                    <input type="hidden" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" value="'.$respuesta["precio_venta"].'" readonly required>
                    <input type="hidden" class="form-control nuevoPrecioGuardar" value="'.$respuesta["precio_venta"].'" required>
                    <div class="col-xs-2 ingresoTotal" style="padding-left:0px">
                    <div class="input-group">
                      <span class="input-group-addon">S/</span>
                    
                        <input class="form-control nuevoTotal" name="nuevoTotal" id="nuevoTotal" value="'.$value["total"].'" style="width:80px" readonly>					
            
                      </div>
                    </div>
            
            
            
            
                  </div>';
                  }
                ?>
                </div>
                <input type="hidden" id="listaProductosProforma" name="listaProductosProforma">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                      <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>
                              <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" value="<?php echo $proforma["impuesto"];?>">
                              <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto" value="<?php echo $proforma["neto"];?>">
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon">S/</i></span>

                            <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $proforma["neto"];?>" value="<?php echo $proforma["total"];?>" readonly required>
                            <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $proforma["total"];?>">
                        
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

            <button type="submit" class="btn btn-primary pull-right">Guardar proforma</button>


          </div>

          <?php
            $guardarProforma = new ControladorProforma();
            $guardarProforma->ctrEditarProforma();

          ?>

        </form>

        

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaProforma" width="100%">
              
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
