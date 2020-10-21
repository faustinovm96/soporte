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
      
      Administrar Equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Equipos Informáticos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEquipo">
          
          Agregar Equipo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Tipo</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Serie</th>
           <th>Accesorios</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);
          

         for($i = 0; $i < count($equipos); $i++){

            $item = "id";
            $valor = $equipos[$i]["id_cliente"];

            $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
           
            echo ' <tr>
                   <td>'.($i+1).'</td>';

            

            echo '<td>'.$cliente["nombre_razon_social"].'</td>';

            

            echo  ' <td>'.$equipos[$i]["tipo"].'</td>
                    <td>'.$equipos[$i]["marca"].'</td>
                    <td>'.$equipos[$i]["modelo"].'</td>
                    <td>'.$equipos[$i]["numero_serie"].'</td>
                    <td>'.$equipos[$i]["accesorios"].'</td>';
  
                    echo '
                    
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarEquipo" idEquipo="'.$equipos[$i]["id"].'" data-toggle="modal" data-target="#modalEditarEquipo"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarEquipo" idEquipo="'.$equipos[$i]["id"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group row">

             <div class="col-xs-12">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" required>
                  
                  <option value="">Selecionar Cliente</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                  foreach ($clientes as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_razon_social"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            </div>

            <!-- ENTRADA PARA EL TIPO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipo" placeholder="Ingresar tipo del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA la marca-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA el modelo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar modelo del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA la serie-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaSerie" placeholder="Ingresar serie del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA accesorios-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoAccesorio" placeholder="Ingresar accesorio del equipo" required>

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

        <?php

          $crearEquipo = new ControladorEquipos();
          $crearEquipo -> ctrCrearEquipo();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar equipo</h4>

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

                <select class="form-control input-lg" name="editarCliente" readonly required>
                  
                  <option id="editarCliente"></option>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTipo" name="editarTipo" placeholder="Ingresar tipo de equipo" required>

                <input type="hidden" id="idEquipo" name="idEquipo">

              </div>

            </div>

            <!-- ENTRADA PARA la marca-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarMarca" name="editarMarca" placeholder="Ingresar marca del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA el modelo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarModelo" name="editarModelo" placeholder="Ingresar modelo del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA la serie-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" placeholder="Ingresar serie del equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA accesorios-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarAccesorio" name="editarAccesorio" placeholder="Ingresar accesorio del equipo" required>

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

            $editarEquipo = new ControladorEquipos();
            $editarEquipo -> ctrEditarEquipo();

        ?> 
        
      </form>   

    </div>

  </div>

</div>

<?php

  $borrarEquipo = new ControladorEquipos();
  $borrarEquipo -> ctrBorrarEquipo();

?> 


