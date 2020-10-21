<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Pedidos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Pedidos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPedido">
          
          Agregar Pedido

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Usuario</th>
           <th>Equipo</th> 
           <th>Cliente</th> 
           <th>Fecha de Registro</th>
           <th>Problema</th>          

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $pedidos = ControladorPedidos::ctrMostrarPedidos($item, $valor);

          for($i = 0; $i < count($pedidos); $i++){
            
            $item3 = "id";
            $valor3 = $pedidos[$i]["id_usuario"];
            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);

            $item2 = "id";
            $valor2 = $pedidos[$i]["id_equipo"];
            $equipo = ControladorEquipos::ctrMostrarEquipos($item2, $valor2);

            $item = "id";
            $valor = $pedidos[$i]["id_cliente"];
            $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);


            echo '<tr>

                    <td>'.($i+1).'</td>

                    <td>'.$cliente["nombre_razon_social"].'</td>

                    <td>'.$equipo["tipo"].' '.$equipo["marca"].' '.$equipo["modelo"].'</td>                    

                    <td>'.$usuario["nombre"].'</td>

                    <td>'.$pedidos[$i]["fecha"].'</td>

                    <td>'.$pedidos[$i]["problema"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarPedido" data-toggle="modal" data-target="#modalEditarPedido" idPedido="'.$pedidos[$i]["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPedido" idPedido="'.$pedidos[$i]["id"].'"><i class="fa fa-times"></i></button>';

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

<!--=====================================
MODAL AGREGAR PEDIDO
======================================-->

<div id="modalAgregarPedido" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pedido</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA FECHA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFecha" required>

              </div>

            </div> 

            <!-- USUARIO QUE HACE EL PEDIDO -->
            
            <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoUser" name="nuevoUser" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

            </div> 

            <!-- ENTRADA PARA EL cliente -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoCliente2" name="nuevoCliente2" required>
                  
                  <option value="">Selecionar Cliente</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                  //$id_valor_cliente = "";

                  foreach ($clientes as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_razon_social"].'</option>';
                    //$id_valor_cliente = $value["id"];

                  }

                  ?>
  
                </select>

              </div>

            </div>

             <!-- ENTRADA PARA EL equipo-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoEquipo" name="nuevoEquipo" required>
                  
                  <option value="">Selecionar Equipo</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                  //$id_valor_cliente = "";

                  foreach ($equipos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["tipo"].' '.$value["marca"].' '.$value["modelo"].'</option>';
                    //$id_valor_cliente = $value["id"];

                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA el EMAIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProblema" placeholder="Ingresar Problema del Equipo" required>

              </div>

            </div> 
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Pedido</button>

        </div>

      </form>

      <?php

        $crearPedido = new ControladorPedidos();
        $crearPedido -> ctrCrearPedido();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarPedido" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA FECHA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="date" class="form-control input-lg" id="editarFecha" name="editarFecha" required>

                <input type="hidden" id="idPedido" name="idPedido">

              </div>

            </div> 

            <!-- USUARIO QUE HACE EL PEDIDO -->
            
            <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarUser" name="editarUser" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

            </div> 

            <!-- ENTRADA PARA EL cliente -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarCliente2" name="editarCliente2" readonly readonly required>
                  
                  <option id="editarCliente"></option>
  
                </select>

              </div>

            </div>

             <!-- ENTRADA PARA EL equipo-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarEquipo" name="editarEquipo" readonly required>
                  
                  <option id="editarEquipo"></option>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA el EMAIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" id="editarProblema" name="editarProblema" placeholder="Ingresar Problema del Equipo" required>

              </div>

            </div> 

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

        $editarPedido = new ControladorPedidos();
        $editarPedido -> ctrEditarPedido();

      ?>

    

    </div>

  </div>

</div>

<?php

  $borrarPedido = new ControladorPedidos();
  $borrarPedido -> ctrBorrarPedido();

?>


