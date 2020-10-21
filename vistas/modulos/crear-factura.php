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
      
      Agregar Factura
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Agregar Factura</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      </div>

      <form role="form" method="post" class="formularioVenta">

        <div class="box-body">
          
          <!-- USUARIO QUE HACE EL PEDIDO -->
          
          <div class="form-group">
              
            <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

              <input type="text" class="form-control input-lg" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

              <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

            </div>

          </div> 

          <!-- ENTRADA PARA fecha -->

          <div class="form-group">
            
              <div class="input-group">
            
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFecha" required>

              </div>

          </div>

          <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 

              <select class="form-control input-lg" id="newEquipo" name="newEquipo" required>
                
                <option value="">Selecionar Equipo</option>

                <?php

                $item = null;
                $valor = null;

                $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

                for($i = 0; $i < count($servicios); $i++){

                  $item2 = "id";
                  $valor2 = $servicios[$i]["id_pedido"];
                  $pedidos = ControladorPedidos::ctrMostrarPedidos($item2, $valor2);

                  $item3 = "id";
                  $valor3 = $pedidos["id_equipo"];
                  $equipos = ControladorEquipos::ctrMostrarEquipos($item3, $valor3);
                  
                  echo '<option value="'.$equipos["id"].'">'.$equipos["tipo"].' '.$equipos["marca"].' '.$equipos["modelo"].'</option>';
                }

                ?>

              </select>

            </div>

          </div>

          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
              <table class="table table-bordered table-hover" id="invoiceItem"> 
          
                  <tr>
                    <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                    <th width="15%">Cantidad</th>
                    <th width="38%">Descripción</th>   
                    <th width="15%">Precio</th>               
                    <th width="15%">Total</th>
                  </tr>    

                  <tr>
                    <td><input class="itemRow" type="checkbox"></td>
                    <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off" value="1" min="1"></td>
                    <td><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></td>
                    <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                    <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off" readonly></td>
                  </tr>   

              </table>

            </div>

          </div>             

          <div class="row">

            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

              <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
              <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
            
            </div>

          </div>
            
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">

            <span class="form-inline">

              <div class="form-group">

                <label>Subtotal: &nbsp;</label>

                <div class="input-group">

                    <div class="input-group-addon currency">$</div>
                    <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
                
                </div>

              </div>

              <div class="form-group">

                <label>Tasa Impuesto: &nbsp;</label>

                <div class="input-group">

                  <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tasa de Impuestos">
                  <div class="input-group-addon">%</div>
                
                </div>
              
              </div>

              <div class="form-group">
                  
                <label>Monto Inpuesto: &nbsp;</label>
                
                <div class="input-group">
                
                  <div class="input-group-addon currency">$</div>
                  <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Monto de Impuesto">
              
                </div>

              </div> 

              <div class="form-group">

                <label>Total: &nbsp;</label>

                <div class="input-group">
                    <div class="input-group-addon currency">$</div>
                    <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">

                </div>

              </div>

              <div class="form-group">

                <label>Cantidad pagada: &nbsp;</label>

                <div class="input-group">

                    <div class="input-group-addon currency">$</div>
                    <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada">

                </div>

              </div>

              <div class="form-group">

                  <label>Cantidad debida: &nbsp;</label>

                  <div class="input-group">

                    <div class="input-group-addon currency">$</div>
                    <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Cantidad debida">

                  </div>

              </div>

            </span>

          </div>                  
              
        </div>

      </form>

    </div>

  </section>

</div>

