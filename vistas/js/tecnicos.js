/*=============================================
EDITAR
=============================================*/
$(".tablas").on("click", ".btnEditarTecnico", function(){

  var idTecnico = $(this).attr("idTecnico");

  var datos = new FormData();
    datos.append("idTecnico", idTecnico);

    $.ajax({

      url:"ajax/tecnicos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
         $("#idTecnico").val(respuesta["id"]);
         $("#editarDocumento").val(respuesta["documento"]);
         $("#editarNombre").val(respuesta["nombre"]);
         $("#editarDireccion").val(respuesta["direccion"]);
         $("#editarCelular").val(respuesta["celular"]);
         $("#editarEmail").val(respuesta["email"]);     
          
    }

    })

})

/*=============================================
ELIMINAR
=============================================*/
$(".tablas").on("click", ".btnEliminarTecnico", function(){

  var idTecnico = $(this).attr("idTecnico");
  
  swal({
        title: '¿Está seguro de borrar el tecnico?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar tecnico!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=tecnicos&idTecnico="+idTecnico;
        }

  })

})