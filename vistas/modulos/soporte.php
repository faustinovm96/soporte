<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Soporte Técnico
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Soporte Técnico</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSoporte">
          
          Agregar +
        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Pedido</th>
           <th>Causas</th>
           <th>Solución Propuesta</th>

           <th>Estado</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          <?php

        $item = null;
        $valor = null;

        $soportes = ControladorSoportes::ctrMostrarSoportes($item, $valor);

       for($i = 0; $i < count($soportes); $i++){
         
            $item = "id";
            $valor = $soportes[$i]["id_pedido"];
            $pedido = ControladorPedidos::ctrMostrarPedidos($item, $valor);

          echo ' <tr>
                  <td>'.($i+1).'</td>
                  <td>'.$pedido["problema"].'</td>
                  <td>'.$soportes[$i]["causas"].'</td>
                  <td>'.$soportes[$i]["solucion"].'</td>
                  <td>'.$soportes[$i]["estado"].'</td>';          

                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarSoporte" idSoporte="'.$soportes[$i]["id"].'" data-toggle="modal" data-target="#modalEditarSoporte"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarSoporte" idSoporte="'.$soportes[$i]["id"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarSoporte" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Soporte Técnico</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="seleccionarPedido" name="seleccionarPedido" required>
                  
                  <option value="">Selecionar Pedido</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $pedidos = ControladorPedidos::ctrMostrarPedidos($item, $valor);

                  for($i = 0; $i < count($pedidos); $i++){

                    $item = "id";
                    $valor = $pedidos[$i]["id_equipo"];

                    $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);
                    
                    echo '<option value="'.$pedidos[$i]["id"].'">'.$pedidos[$i]["fecha"].': '.$equipo["tipo"].' '.$equipo["marca"].' '.$equipo["modelo"].': '.$pedidos[$i]["problema"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA las causas-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCausa" placeholder="Ingresar causas del problema" required>

              </div>

            </div>

            <!-- ENTRADA PARA la solución-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaSolucion" placeholder="Ingresar soluciones propuestas" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR el estado -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoEstado">
                  
                  <option value="">Selecionar Estado</option>

                  <option value="Pendiente">Pendiente</option>

                  <option value="Taller">Taller</option>

                  <option value="Terminado">Terminado</option>

                </select>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Equipo</button>

        </div>

      </form>

    <?php

          $crearSoporte = new ControladorSoportes();
          $crearSoporte -> ctrCrearSoporte();

        ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarSoporte" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Soporte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR PEDIDO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" name="editarPedido" required>
                  
                  <option id="editarPedido"></option>

                  <option value="">Selecionar Pedido</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $pedidos = ControladorPedidos::ctrMostrarPedidos($item, $valor);

                  for($i = 0; $i < count($pedidos); $i++){

                    $item = "id";
                    $valor = $pedidos[$i]["id_equipo"];

                    $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);
                    
                    echo '<option value="'.$pedidos[$i]["id"].'">'.$pedidos[$i]["fecha"].': '.$equipo["tipo"].' '.$equipo["marca"].' '.$equipo["modelo"].': '.$pedidos[$i]["problema"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCausa" name="editarCausa" required>

                <input type="hidden" id="idSoporte" name="idSoporte">

              </div>

            </div>

            <!-- ENTRADA PARA solucion-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarSolucion" name="editarSolucion" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU Estado -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarEstado">
                  
                  <option id="editarEstado"></option>

                  <option value="Pendiente">Pendiente</option>

                  <option value="En Taller">En Taller</option>

                  <option value="Terminado">Terminado</option>

                </select>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

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

  $borrarSoporte = new ControladorSoportes();
  $borrarSoporte -> ctrBorrarSoporte();

?> 


