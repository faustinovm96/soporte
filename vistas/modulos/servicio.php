<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper" style="background-color: white">

  <section class="content-header">
    
    <h1 style="color: #3c8dbc">
      
      Administrar Servicios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
      
      <li class="active">Administrar Servicios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border" style="border: 0;">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio" style="font-size: 16px;">
          
          <i class="fa fa-plus-circle"></i> <b>Agregar</b>

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th style="text-align: center;">Descripción del Servicio</th>
           <th style="text-align: center;">Costo</th>

           <th style="text-align: center;">Acciones</th>

         </tr> 

        </thead>

        <tbody>

          <?php

        $item = null;
        $valor = null;

        $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

       for($i = 0; $i < count($servicios); $i++){

          echo ' <tr>
                  <td style="text-align: center;">'.($i+1).'</td>
                  <td>'.$servicios[$i]["descripcion"].'</td>
                  <td>'.number_format($servicios[$i]["costo"]).'</td>';   


                  echo '
                  <td style="text-align: center;">

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarServicio" idProducto="'.$servicios[$i]["id"].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarServicio" idServicio="'.$servicios[$i]["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR equipo
======================================-->

<div id="modalAgregarServicio" class="modal fade" data-backdrop="static" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->

          <h4 class="modal-title">Agregar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA la marca-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tasks"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripcion del servicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA el modelo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cart-plus"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar costo del servicio" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary">Guardar Servicio</button>

        </div>

      </form>

    <?php

          $crearServicio = new ControladorServicios();
          $crearServicio -> ctrCrearServicio();

        ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarServicio" class="modal fade" data-backdrop="static" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->

          <h4 class="modal-title">Editar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL TIPO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tasks"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

                <input type="hidden" id="idProducto" name="idProducto">

              </div>

            </div>

            <!-- ENTRADA PARA el costo-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cart-plus"></i></span> 

                <input type="number" class="form-control input-lg" id="editarCosto" name="editarCosto" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

            $editarServicio = new ControladorServicios();
            $editarServicio -> ctrEditarServicio();

        ?> 
        
      </form>   

    </div>

  </div>

</div>

<?php

  $borrarServicio = new ControladorServicios();
  $borrarServicio -> ctrBorrarServicio();

?> 


