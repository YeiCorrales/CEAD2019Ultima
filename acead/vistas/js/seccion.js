var idSecc;
var idClase, descSeccion, hrSecc, aulaSecc, idPeriodo, idUser;

$('button[name=btneditarSecc]').on('click', function(evt){
	evt.preventDefault();
});

$('#TablaSecciones tbody').on('click', '.btnEditarSeccion', function(){
	
	var obj = $(this).parent().parent().parent();
	idSecc = $('td', obj).eq(1).text();

	$('#idseccionedit').val(idSecc);	

});

$('button[name=btneditarSecc]').on('click', function(){
	//SE USA UN AJAX PARA ENVIAR LOS DATOS AL CONTROLADOR
	//Se obtienen los datos de los controles del formulario
	idClase = $('select[name=nuevoclaseedit]').val();
	idPeriodo = $('select[name=nuevoperiodoedit]').val();
	idUser = $('select[name=nuevomaestroedit]').val();
	descSeccion = $('input[name=nuevadescedit]').val();
	hrSecc = $('input[name=hrsclaseedit]').val();
	aulaSecc = $('input[name=nuevaaulaedit]').val();

	var params = {
		"id_Seccion": idSecc,
		"DescripSeccion": descSeccion,
		"HraClase": hrSecc,
		"AulaClase": aulaSecc,
		"Id_PeriodoAcm": idPeriodo,
		"Id_usuario": idUser,
		"Id_Clase": idClase
	};

	//alert(idSecc +'-'+ descSeccion +'-'+ hrSecc +'-'+ aulaSecc +'-'+ idPeriodo +'-'+ idUser +'-'+ idClase);

	$.ajax({ //definicion de ajax por metodo post
       type: "POST",
        url: "../acead/modelos/secciones.modelo.php?caso=updateseccion",
        data: params,
        dataType: 'json',
        success: function(msj){  //si el modelo devuelve un resultado exitoso
        	//alert(msj);
        	if(msj == '1' || msj == 1){
        		//alert('swal({type: "success", title: "¡La Seccion ah sido guardada correctamente!", showConfirmButton: true, confirmButtonText: "Cerrar", closeOnConfirm: false }).then((result)=>{if(result.value){ window.location = "seccion"; }});');
        		swal({

							type: "success",
							title: "¡La Seccion ah sido actualizada correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "seccion";

							}

						});
        	}else{
        		swal({

							type: "error",
							title: "¡No se pudo actualizar la sección! Revise los datos de envío!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "seccion";

							}

						});
        	}
            //alert("ID: " + msj);
            /*cambiaPassUsuario(msj, contrasena);
            alert("Password actualizado correctamente!!");
            window.location.href="acceso";*/
        },
        error: function(xhr, status){ //si el modelo devuelve un resultado fallido
            //alert(xhr.response + " -- " + status);
        }
  });

});