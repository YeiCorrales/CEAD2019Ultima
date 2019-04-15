<?php

class ControladorSecciones{

  /*=============================================
  MOSTRAR SECCION
  =============================================*/

  static public function ctrMostrarSeccion($item, $valor){

    $tabla = "tbl_secciones";

    $respuesta = ModeloSeccion::MdlMostrarSecciones($tabla, $item, $valor);

    return $respuesta;
  }


  /*=============================================
	REGISTRO DE SECCION
	=============================================*/

	static public function ctrCrearSeccion(){

		$nuevoD = isset($_POST['nuevoDescripSeccion']) ?: null;

	    if(isset($nuevoD) && $nuevoD !== null){

				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripSeccion"])){

					$tabla = "tbl_secciones";


					$secciones = array("DescripSeccion" => strtoupper($_POST["nuevoDescripSeccion"]),
	                           "HraClase" => $_POST["HrsClas"],
							               "AulaClase"	=> $_POST["nuevaAula"],
	    					             "Id_PeriodoAcm" => $_POST["nuevoPeriodo"],
						                 "Id_usuario" => $_POST["nuevoMaestro"]);


					$respuesta = ModeloSeccion::mdlIngresarSeccion($tabla, $secciones);


					if($respuesta == "ok"){

						echo '<script>

						swal({

							type: "success",
							title: "¡La Seccion ah sido guardada correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "seccion";

							}

						});


						</script>';
						//echo "<script>alert('ESTO ES OKKK!!!!');</script>";


					}


				}else{

					echo '<script>

						swal({

							type: "error",
							title: "¡El nombre de la Seccion no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "seccion";

							}

						});


					</script>';
					//echo "<script>alert('LALALALALAAL');</script>";

				}
				//echo '<script>alert("HELOOOO!!");</script>';

			}


	}

/*=============================================
  REGISTRO EN LA TABLA CLASE-SECCION
  =============================================*/

  static public function ctrCrearClaseSeccion(){

    if(isset($_POST["nuevadescedit"])){

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevadescedit"])){

        $tabla = "tbl_clases_secciones";


        $datos = array("Id_Clase" => $_POST["nuevoclaseedit"],
                       "Id_Seccion" => $_POST["idseccionedit"]);


        $respuesta = ModeloClases::mdlIngresarClaseSeccion($tabla, $datos);
       }
    }

  }

  /*=============================================
 EDITAR SECCIONES
 =============================================*/

	static public function ctrEditarSeccion(){

		if(isset($_POST["nuevoDescripSeccion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripSeccion"])){

				$tabla = "tbl_secciones";


				$datos = array("DescripSeccion" => strtoupper($_POST["nuevoDescripSeccion"]),
                       "HraClase" => $_POST["HrsClas"],
						"AulaClase"	=> $_POST["nuevaAula"],
    					 "Id_PeriodoAcm" => $_POST["nuevoPeriodo"],
					     "Id_usuario" => $_POST["nuevoMaestro"]);


				$respuesta = ModeloSeccion::mdlIngresarSeccion($tabla, $datos);
				echo '<script>alert('.$secciones['Id_usuario'].');</script>';
				if($respuesta == "ok"){

					echo '<script>

					swal({

 "success",
						ttle: "¡La Seccion sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "seccion";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre de la Seccion no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "seccion";

						}

					});


				</script>';

			}


		}


	}


  /*=============================================
	BORRAR MODALIDAD
	=============================================*/

	static public function ctrBorrarSeccion(){

		if(isset($_GET["idSeccion"])){


			$tabla = "tbl_secciones";
			$datos = $_GET["idSeccion"];

			$respuesta = ModeloSecciones::mdlBorrarSeccion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Modalidad ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "seccion";

								}
							})

				</script>';

			}

		}

	}


/*=============================================
	MOSTRAR CLASE
	=============================================*/

	static public function ctrCargarClase(){

		$tabla = "tbl_Clases";

		$respuesta = ModeloSeccion::mdlCargarSelect($tabla);

		return $respuesta;

	}

/*=============================================
	MOSTRAR PERIODO ACADEMICO
	=============================================*/

	static public function ctrCargarPeriodo(){

		$tabla = "tbl_periodoacademico";

		$respuesta = ModeloSeccion::mdlCargarSelect($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR MAESTRO
	=============================================*/

	static public function ctrCargarMaestro(){

		$tabla = "tbl_usuarios";

		$respuesta = ModeloSeccion::mdlCargarSelect($tabla);

		return $respuesta;

	}

}
