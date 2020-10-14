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
      
      Administrar Servicio Técnico
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Servicio Técnico</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">
          
          Agregar Servicio

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Problema del equipo</th>
           <th>Técnico</th>
           <th>Causas</th>
           <th>Correcciones</th>
           <th>Costo</th>
           <th>Estado</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          <?php

        $item = null;
        $valor = null;

        $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

       for($i = 0; $i < count($servicios); $i++){
         
            $item = "id";
            $valor = $servicios[$i]["id_pedido"];
            $pedido = ControladorPedidos::ctrMostrarPedidos($item, $valor);

            $item1 = "id";
            $valor1 = $servicios[$i]["id_tecnico"];
            $tecnico = ControladorTecnicos::ctrMostrarTecnicos($item1, $valor1);

          echo ' <tr>
                  <td>'.($i+1).'</td>
                  <td>'.$pedido["problema"].'</td>
                  <td>'.$tecnico["nombre"].'</td>
                  <td>'.$servicios[$i]["causas"].'</td>
                  <td>'.$servicios[$i]["correcciones"].'</td>
                  <td>'.$servicios[$i]["costo"].'</td>
                  <td>'.$servicios[$i]["estado"].'</td>';          

                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarServicio" idServicio="'.$servicios[$i]["id"].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-pencil"></i></button>

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

<div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Servicio</h4>

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

                <select class="form-control input-lg" id="nuevoPedido" name="nuevoPedido" required>
                  
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

            <!-- ENTRADA PARA SELECCIONAR TECNICO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoTecnico" name="nuevoTecnico" required>
                  
                  <option value="">Selecionar Técnico</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $tecnicos = ControladorTecnicos::ctrMostrarTecnicos($item, $valor);

                  for($i = 0; $i < count($tecnicos); $i++){
                    
                    echo '<option value="'.$tecnicos[$i]["id"].'">'.$tecnicos[$i]["nombre"].'</option>';
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

            <!-- ENTRADA PARA la marca-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCorreccion" placeholder="Ingresar correcciones aplicadas" required>

              </div>

            </div>

            <!-- ENTRADA PARA el modelo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar costo del servicio" required>

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

          $crearServicio = new ControladorServicios();
          $crearServicio -> ctrCrearServicio();

        ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Servicio</h4>

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

                <select class="form-control input-lg" name="editarPedido" readonly required>
                  
                  <option id="editarPedido"></option>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR TECNICO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" name="editarTecnico" readonly required>
                  
                  <option id="editarTecnico"></option>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCausa" name="editarCausa" required>

                <input type="hidden" id="idServicio" name="idServicio">

              </div>

            </div>

            <!-- ENTRADA PARA la marca-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCorreccion" name="editarCorreccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA el costo-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" id="editarCosto" name="editarCosto" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU Estado -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarEstado">
                  
                  <option value="" id="editarEstado"></option>

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

  $borrarServicio = new ControladorServicios();
  $borrarServicio -> ctrBorrarServicio();

?> 


