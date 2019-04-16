var aid;
var nombrealumno;
param={
    "":""
};

$.ajax({
    type: "POST",
    url: "../acead/modelos/alumnos.modelo.php?caso=cargahistorial",
    data: param,
    dataType: 'json',
    success: function(data){


        $.each(data, function(i, item){
           // alert(item.NC);
            //aqui va el codigo para insertar los datos en la tabla
            $('#tblhistorial tbody').append('<TR><td style="display:none;">'+item.IDA+'</td><td>'+item.EST+'</td><td>'+item.ID+'</td><td>'+item.NC+'</td><td>'+item.NF+'</td><td>'+item.STATUS+'</td><td><button class="btn btn-warning" id="printhistorial" name="printhistorial"><i class="fa fa-print"></i></button></td></TR>');
        });
    },
    error: function(xhr, status){
        /*alert("ERROR: " + xhr + " >> " + status);*/
    }
});


$('#tblhistorial tbody').on('click', '#printhistorial',function(){
    var obj =$(this).parent().parent();
    aid = $('td', obj).eq(0).text();
    nombrealumno = $('td', obj).eq(1).text();
   // alert(aid);
    if(aid=='' || aid==0 || aid==null || aid==undefined){
        alert('Error!!!!!')
    }else{
        window.open("../acead/extensiones/tcpdf/examples/historial.php?id_alumno="+aid+"&nombrealumno="+nombrealumno, "_blank");
    }
});
