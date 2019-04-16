<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Gestión Académica

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Gestión Académica</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <!-- BOTON AGREGAR CLASE -->
        <div class="box-header with-border">

              <button class="btn btn-primary btnImprimirMatriculaGlobal">

                Imprimir Matricula Global

              </button>

            </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th style="width:10px">Id</th>
           <th>Alumno</th>
           <th>Modalidad</th>
           <th>Orientacion</th>
           <th>Clase</th>
           <th >Seccion</th>
           <th style="width:50px">Período Académico</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

	//Keren & Yeimi XD was here! y Estoy probando varias cosas (Att: Yeimi. Te quiero Keren ;* // A vos Tambien Nico. XD)



        $matricula = ControladorMatricula::ctrMostrarmatricula();

       foreach ($matricula as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["IDMAT"].'</td>
                  <td>'.$value["Alum"].'</td>
                  <td>'.$value["DMOD"].'</td>
                  <td>'.$value["DORI"].'</td>
                  <td>'.$value["DCLASE"].'</td>
                  <td>'.$value["DSEC"].'</td>
                  <td>'.$value["DPER"].'</td>';


                  echo '  <td>

                     <div class="btn-group">

                     <button class="btn btn-danger btnEliminarMatricula" idMatricula="'.$value["IDMAT"].'"><i class="fa fa-times"></i></button>
                     <button class="btn btn-success btnCobroMatricula" idAlumno="'.$value["IDA"].'"data-toggle="modal" data-target="#modalEditarCobroMatricula"><i class="fa fa-cart-arrow-down"></i></button>
                     <button class="btn btn-info btnImprimirMatricula" idAlumno="'.$value["IDA"].'"><i class="fa fa-print"></i></button>


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


<!--=====================================
MODAL COBRO DE MATRICULA
======================================-->

<div id="modalEditarCobroMatricula" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00a65a; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cobro de Matrícula</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL ID ALUMNO -->
            <div class="form-group">
               <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                   <input type="text" class="form-control input-lg" id="editarAlumno" name="editarAlumno" readonly value="">
               </div>
             </div>

            <!-- ENTRADA PARA EL PRIMER NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombre1" id="editarNombre1" value="" pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]*$|" readonly value="">
              </div>
            </div>


            <!-- ENTRADA PARA EL PRIMER APELLIDO -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarApellido1" id="editarApellido1" value="" pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]*$|" readonly value="">
              </div>
            </div>

          <!-- ENTRADA PARA EL VALOR A COBRAR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <?php
                  $respuesta = ControladorPrecio::ctrPrecio();
                  foreach ($respuesta as $key => $precio)
                  {
                   if($precio = 300)
                    {$precio['Precio'];}
                  }
                 ?>
                <input type="text" value="<?= $precio?>" class="form-control input-lg" name="nuevoTotalMatricula" id="nuevoTotalMatricula"  readonly value="">
              </div>
            </div>


          </div>
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button"
                  class="btn btn-default pull-left"
                  data-dismiss="modal">Salir</button>
          <button type="submit"
                  class="btn btn-primary">Cobro Realizado</button>
        </div>

        <?php
         $editarCobroMensual = new ControladorCobroMatricula();
         $editarCobroMensual -> ctrCrearCobroMatricula();

        ?>

      </form>
    </div>
  </div>
</div>


<?php

  $borrarMatricula = new ControladorMatricula();
  $borrarMatricula -> ctrBorrarMatricula();

?>
