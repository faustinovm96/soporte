/*=============================================
TRAER DATOS AL FORMULARIO PARA EDITAR
=============================================*/
$(".tablas").on("click", ".btnEditarSoporte", function(){

  var equipo = "";
  var pedido = "";

  var idSoporte = $(this).attr("idSoporte");

  var datos = new FormData();
    datos.append("idSoporte", idSoporte);

    $.ajax({

      url:"ajax/soporte.ajax.php",
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

              pedido = respuesta["fecha"] + " => ";

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
                        
                        equipo = respuesta["tipo"] + " " +respuesta["marca"]+ " " + respuesta["modelo"];
                        
                        pedido = equipo;

                        console.log(pedido);

                        $("#editarPedido").val(respuesta["id"]);
                        $("#editarPedido").html(pedido);
                    }

                })

            }

          })
         
         $("#editarCausa").val(respuesta["causas"]);
         $("#editarSolucion").val(respuesta["solucion"]);
         $("#editarEstado").val(respuesta["estado"]);
         $("#editarEstado").html(respuesta["estado"]);
         $("#idSoporte").val(respuesta["id"]);
           
      }

    })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarSoporte", function(){

  var idSoporte = $(this).attr("idSoporte");
  
  swal({
        title: '¿Está seguro de borrar el Soporte?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=soporte&idSoporte="+idSoporte;
        }

  })

})
