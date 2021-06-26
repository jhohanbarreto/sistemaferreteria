<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Categorias Gastos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Categoria gastos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoriaGastos">
          
          Agregar categoria

        </button>

      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Categoria</th>
            <th>Acciones</th> <!--para las opciones de editar y eliminar-->

          </tr> 

          </thead>

          <tbody>
          <?php 
            $item = null;
            $valor = null;

            $categorias = ControladorCategoriaGastos::ctrMostrarCategoriaGasto($item,$valor);
            //var_dump($categorias);
            foreach ($categorias as $key => $value) {
              echo ' <tr>
              <td>'.($key + 1).'</td>
              <td class = "text-uppercase">'.$value["categoria"].'</td>
              <td>
                <div class="btn-group">

                  <!--data-toggle="modal" data-target="#modalEditarCategoria"->es para crear la ventana flotate -->
                  <!--btnEditarCategoria" idCategoria ="'.$value["id_categoriaGastos"].'"   para crear en javascrip boton btnEditarCategooria-->
                  
                  <button class="btn btn-warning btnEditarCategoriaGastos" idCategoriaGastos ="'.$value["id_categoriaGastos"].'" 
                  data-toggle="modal" data-target="#modalEditarCategoriaGastos"><i class="fa fa-pencil"></i></button>';

                  if($_SESSION["perfil"] == "Administrador"){

                  echo '<button class="btn btn-danger btnEliminarCategoriaGastos" idCategoriaGastos ="'.$value["id_categoriaGastos"].'"><i class="fa fa-times"></i></button>';
                          //idCategoria ="'.$value["id"].'"  pasarlocomo atributo como get
                  }

                echo '</div>  

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

 

<div id="modalAgregarCategoriaGastos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">


        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoria Gastos</h4>

        </div>



        <div class="modal-body">

          <div class="box-body">

            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoriaGasto" placeholder="Ingresar categoria" id="nuevaCategoriaGasto" required>

              </div>

            </div>
          </div>

        </div>
 

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Agregar categoria</button>

        </div>
        <?php 
        $crearCategoriaGastos = new ControladorCategoriaGastos();
        $crearCategoriaGastos->ctrCrearCategoriasGastos();
        
        ?>
      </form>

    </div>

  </div>

</div>

 

<div id="modalEditarCategoriaGastos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">


        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoria</h4>

        </div>


        <div class="modal-body">

          <div class="box-body">

            
            <div class="form-group">

            <label>
                Ingresar categoria
                <span class="text-danger">*</span>
              </label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoriaGastos" id="editarCategoriaGastos" required>
                <input type="hidden"  name="idCategoriaGastos" id="idCategoriaGastos" required>

              </div>

            </div>
          </div>

        </div>


        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>
        <?php 
        $editarCategoriaGastos = new ControladorCategoriaGastos();
        $editarCategoriaGastos->ctrEditarCategoriasGastos();
        
        ?>

      </form>

    </div>

  </div>

</div>
<?php 
      $borrarCategoriaGastos = new ControladorCategoriaGastos();
      $borrarCategoriaGastos->ctrBorrarCategoriaGastos();
        
?>