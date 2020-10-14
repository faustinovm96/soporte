/*=============================================
TRAER DATOS AL FORMULARIO PARA EDITAR
=============================================*/
$(".tablas").on("click", ".btnEditarServicio", function(){

  var idServicio = $(this).attr("idServicio");

  var datos = new FormData();
    datos.append("idServicio", idServicio);

    $.ajax({

      url:"ajax/servicios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

          var datosPedido = new FormData();
          datosPedido.append("idPedido",respuesta["id_pedido"]);

           $.ajax({

              url:"ajax/pedidos.ajax.php",
              method: "POST",
              data: datosPedido,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  var datosEquipo = new FormData();
                  datosEquipo.append("idEquipo",respuesta["id_equipo"]);

                   $.ajax({

                      url:"ajax/equipos.ajax.php",
                      method: "POST",
                      data: datosEquipo,
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType:"json",
                      success:function(respuesta){
                          
                          $("#editarPedido").val(respuesta["id"]);
                          $("#editarPedido").html(respuesta["tipo"]+' '+respuesta["marca"]+' '+respuesta["modelo"]);

                      }

              })

              }

          })

          var datosTecnico = new FormData();
          datosTecnico.append("idTecnico",respuesta["id_tecnico"]);

           $.ajax({

              url:"ajax/tecnicos.ajax.php",
              method: "POST",
              data: datosTecnico,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarTecnico").val(respuesta["id"]);
                  $("#editarTecnico").html(respuesta["nombre"]);

              }

          })
      
         $("#idServicio").val(respuesta["id"]);
         $("#editarCausa").val(respuesta["causas"]);
         $("#editarCorreccion").val(respuesta["correcciones"]);
         $("#editarCosto").val(respuesta["costo"]);
         $("#editarEstado").val(respuesta["estado"]);
         $("#editarEstado").html(respuesta["estado"]);

         //$("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);       
         //$("#editarTelefono").val(respuesta["telefono"]);
        // $("#editarCelular").val(respuesta["celular"]);
         //$("#editarEmail").val(respuesta["email"]);       
          
    }

    })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarServicio", function(){

  var idServicio = $(this).attr("idServicio");
  
  swal({
        title: '¿Está seguro de borrar el servicio?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar servicio!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=servicio&idServicio="+idServicio;
        }

  })

})