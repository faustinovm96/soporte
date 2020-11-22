/*=============================================
TRAER DATOS AL FORMULARIO PARA EDITAR
=============================================*/
$(".tablas").on("click", ".btnEditarEquipo", function(){

	var idEquipo = $(this).attr("idEquipo");

	var datos = new FormData();
    datos.append("idEquipo", idEquipo);

    $.ajax({

      url:"ajax/equipos.ajax.php",
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

      	 $("#idEquipo").val(respuesta["id"]);
	       $("#editarTipo").val(respuesta["tipo"]);
         $("#editarMarca").val(respuesta["marca"]);
	       $("#editarModelo").val(respuesta["modelo"]);
         //$("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);       
	       //$("#editarTelefono").val(respuesta["telefono"]);
         $("#editarSerie").val(respuesta["numero_serie"]);
         $("#editarAccesorio").val(respuesta["accesorios"]);       
          
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarEquipo", function(){

	var idEquipo = $(this).attr("idEquipo");
	
	swal({
        title: '¿Está seguro de borrar el Equipo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar equipo!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=equipos&idEquipo="+idEquipo;
        }

  })

})

