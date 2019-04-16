<div class="content-wrapper">

  <section class="content-header">
    <h1>      PAGO DE MENSUALIDAD   </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Pagos de Mensualdiad</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">

      <div class="box-body">
       <table class="table table-bordered table-striped dt-responsive tablas">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th style="width:10px">Id</th>
           <th>Primer Nombre</th>
           <th>Segundo Nombre</th>
           <th>Primer Apellido</th>
           <th>Segundo Apellido</th>
           <th>Acciones</th>
           </tr>
        </thead>
        <tbody>

        <?php
        $item = null;
        $valor = null;
        $alumnos = ControladorPagomes::ctrMostrarAlumnosPagomes($item, $valor);
       foreach ($alumnos as $key => $value)
       {
         echo ' <tr>
                 <td>'.($key+1).'</td>
                 <td>'.$value["Id_Alumno"].'</td>
                 <td>'.$value["PrimerNombre"].'</td>
                 <td>'.$value["SegundoNombre"].'</td>
                 <td>'.$value["PrimerApellido"].'</td>
                 <td>'.$value["SegundoApellido"].'</td>
                     ';
                 echo '  <td>
                    <div class="btn-group">
                    <button class="btn btn-info btnfacturames" idAlumno="'.$value["Id_Alumno"].'">
                    <i class="fa fa-print"></i></button>
                    </div>
                    <button class= "btn btn-warning btnAgregarPagoMensual" idAlumno= "'.$value["Id_Alumno"].'" data-toggle=  "modal" data-target=  "#modalPagoMensual"><i class="fa fa-money"></i></button>
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



<?php
//include 'matricula1.php';
 ?>

<!--=====================================
MODAL EDITAR ALUMNO
======================================-->
<div id="modalPagoMensual" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#f39c12; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Pago Mensual</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

<!-- (4-id Alumno) ENTRADA PARA EL ID ALUMNO -->
            <div class="form-group">
               
                   <input type="hidden" type="text" class="form-control input-lg" id="editarAlumno" name="editarAlumno" readonly value="">
                
             </div>

<!-- (2) ENTRADA PARA EL PRIMER NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombre1" id="editarNombre1" value=""  style="text-transform: uppercase" readonly value="">
              </div>
            </div>

<!-- (4) ENTRADA PARA EL PRIMER APELLIDO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarApellido1" id="editarApellido1" value="" style="text-transform: uppercase" readonly value="">
              </div>
            </div>


<!-- () ENTRADA PARA EL ID DE DESCUENTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescuento" id="editarDescuento" value="" style="text-transform: uppercase" readonly value="">
              </div>
            </div>

<!-- (4) ENTRADA PARA ID MATRICULA
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarApellido1" id="editarApellido1" value="" style="text-transform: uppercase" readonly value="">
              </div>
            </div> -->


<!-- ENTRADA PARA EL VALOR A COBRAR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input  type="text" class="form-control input-lg" name="nuevoCobroMensual" id="nuevoCobroMensual" value="" placeholder="800"  required>
                </div>
            </div>


<!--(3 - Mes Pago) ENTRADA PARA EL MES A COBRAR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                 <select class="form-control input-lg" name="mesesapagar" id="mesesapagar" required>
                    <option value="" required>Seleccionar Mensualidad a pagar</option>
                  <option value="mesuno" > Primera Mensualidad </option>
                  <option value="mesdos" > Segunda Mensualidad </option>
                  <option value="mestres"> Tercera Mensualidad   </option>
                </select>
              </div>
            </div>


 </div>
</div>

<!--===================================== PIE DEL MODAL    ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Agregar pago </button>
        </div>
        <?php
          //$editarAlumno = new ControladorPagomes();
          //$editarAlumno -> ctrEditarPagomes();
          $editarAlumno = new ControladorPagomes();
          $editarAlumno -> ctrMensualidadPago();

        ?>
        <script src="vistas/js/ctrespacios.js"></script>

      </form>
    </div>
  </div>
</div>


<?php
//  $borrarAlumno = new ControladorAlumnos();
//  $borrarAlumno -> ctrBorrarAlumno();
?>
