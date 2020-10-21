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
                
                $("#editarCliente2").val(respuesta["id"]);
                $("#editarCliente2").html(respuesta["nombre_razon_social"]);

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
                
                $("#editarEquipo").val(respuesta["id"]);
                $("#editarEquipo").html(respuesta["tipo"]);

            }

        })

      	 $("#idPedido").val(respuesta["id"]);
         $("#editarFecha").val(respuesta["fecha"]);
         $("#editarProblema").val(respuesta["problema"]);
          
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
