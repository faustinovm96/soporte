/*=============================================
TRAER DATOS AL FORMULARIO PARA EDITAR
=============================================*/
$(".tablas").on("click", ".btnEditarPedido", function(){
  var resultado = "";

	var idPedido = $(this).attr("idPedido");

	var datos = new FormData();
    datos.append("idPedido", idPedido);

    $.ajax({

      url:"ajax/pedidos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        var datosCliente = new FormData();
        datosCliente.append("idCliente",respuesta["id_cliente"]);

         $.ajax({

            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: datosCliente,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                
                $("#editarCliente").val(respuesta["id"]);
                $("#editarCliente").html(respuesta["nombre_razon_social"]);

            }

        })

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

              var equipo = respuesta["tipo"] + ' ' + respuesta["marca"] +  ' '  + respuesta["modelo"]
                
                $("#editarEquipo").val(respuesta["id"]);
                $("#editarEquipo").html(equipo);

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

      	 $("#idPedido").val(respuesta["id"]);
         $("#editarFecha").val(respuesta["fecha"]);
         $("#editarProblema").val(respuesta["problema"]);
         $("#editarCausa").val(respuesta["causas"]);
         $("#editarSolucion").val(respuesta["solucion"]);
         $("#editarEstado").val(respuesta["estado"]);
         $("#editarEstado").html(respuesta["estado"]);
          
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarPedido", function(){

	var idPedido = $(this).attr("idPedido");
	
	swal({
        title: '¿Está seguro de borrar el Pedido?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar pedido!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=pedidos&idPedido="+idPedido;
        }

  })

})
