<?php

require_once "conexion.php";

class ModeloSeccion{

  /*=============================================
  MOSTRAR Seccion
  =============================================*/

  static public function MdlMostrarSecciones($tabla, $item, $valor){


      $stmt = ConexionBD::Abrir_Conexion()->prepare("SELECT SEC.Id_Seccion as IDSEC, SEC.DescripSeccion AS DSEC, CONCAT(USU.PrimerNombre,' ',USU.PrimerApellido) AS MAE, SEC.HraClase as SHRA, SEC.AulaClase AS AU, PER.Id_PeriodoAcm AS DPER FROM tbl_usuarios USU, tbl_secciones SEC, tbl_periodoacademico PER WHERE (USU.Id_usuario=SEC.Id_usuario) AND (SEC.Id_Seccion=SEC.Id_Seccion) AND(PER.Id_PeriodoAcm=SEC.Id_PeriodoAcm)");

      $stmt -> execute();

      return $stmt -> fetchAll();

    $stmt -> Cerrar_Conexion();

    $stmt = null;

  }


    /*=============================================
  IMPRIMIR SECCIONES
  =============================================*/

  static public function MdlImprimirSecciones($tabla, $d){


      $stmt = ConexionBD::Abrir_Conexion()->prepare("SELECT SEC.Id_Seccion as IDSEC, SEC.DescripSeccion AS DSEC, CONCAT(USU.PrimerNombre,' ',USU.PrimerApellido) AS MAE, SEC.HraClase as SHRA, SEC.AulaClase AS AU, PER.Id_PeriodoAcm AS DPER FROM tbl_usuarios USU, tbl_secciones SEC, tbl_periodoacademico PER WHERE (USU.Id_usuario=SEC.Id_usuario) AND (SEC.Id_Seccion=SEC.Id_Seccion) AND(PER.Id_PeriodoAcm=SEC.Id_PeriodoAcm)");

      $stmt -> execute();

      return $stmt -> fetchAll();

    $stmt -> Cerrar_Conexion();

    $stmt = null;

  }



  /*=============================================
  REGISTRO DE SECCION
  =============================================*/

  static public function mdlIngresarSeccion($tabla, $datos){



    $stmt = ConexionBD::Abrir_Conexion()->prepare("INSERT INTO $tabla(DescripSeccion, HraClase, AulaClase, Id_PeriodoAcm, Id_usuario) VALUES (:descripseccion, :horaclase, :aulaclase, :periodoacm, :idusuario);");


    $stmt->bindParam(":descripseccion", $datos["DescripSeccion"], PDO::PARAM_STR);
    $stmt->bindParam(":horaclase", $datos["HraClase"], PDO::PARAM_STR);
    $stmt->bindParam(":aulaclase", $datos["AulaClase"], PDO::PARAM_STR);
    $stmt->bindParam(":periodoacm", $datos["Id_PeriodoAcm"], PDO::PARAM_STR);
    $stmt->bindParam(":idusuario", $datos["Id_usuario"], PDO::PARAM_STR);




    if($stmt->execute()){

      return "ok";

    }else{

      return "error";
      echo "<script type='text/javascript'>alert('neles')</script>";
    }


    //$stmt = null;

  }

  /*=============================================
  REGISTRO DE CLASE-SECCION
  =============================================*/

  static public function mdlIngresarClaseSeccion($tabla, $datos){

    $stmtA = ConexionBD::Abrir_Conexion()->prepare("SELECT MAX(SEC.Id_Seccion) AS IDSEC FROM tbl_secciones SEC");
    $stmtA->execute();
    $resultadoA = $stmtA->fetchAll(PDO::FETCH_BOTH);
    $idult = $resultadoA[0]['IDSEC'];

    $stmt = ConexionBD::Abrir_Conexion()->prepare("INSERT INTO $tabla (Id_Clase, Id_Seccion)
                                                  VALUES (:idclase, :idseccion)");

    
    $stmt->bindParam(":idclase", $datos["Id_Clase"], PDO::PARAM_STR);
    $stmt->bindParam(":idseccion", $idult, PDO::PARAM_STR);



    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

      echo "<script type='text/javascript'>alert('neles')</script>";

    }

    $stmt->close();

    $stmt = null;

  }

 /*=============================================
  CARGAR SELECT
  =============================================*/
  static public function mdlCargarSelect($tabla){

    $stmt = ConexionBD::Abrir_Conexion()->prepare("SELECT * FROM $tabla");
    $stmt -> execute();

    return $stmt -> fetchall();

    }




}

$funcion = filter_input(INPUT_GET, 'caso');

switch ($funcion) {
  case 'updateseccion':
    fcn_actualizaseccion();
    break;
}

function fcn_actualizaseccion(){

  $idseccion = filter_input(INPUT_POST, 'id_Seccion');
  $descseccion = filter_input(INPUT_POST, 'DescripSeccion');
  $hraclase = filter_input(INPUT_POST, 'HraClase');
  $aulaclase = filter_input(INPUT_POST, 'AulaClase');
  $idperiodoacm = filter_input(INPUT_POST, 'Id_PeriodoAcm');
  $idusuario = filter_input(INPUT_POST, 'Id_usuario');
  $idclase = filter_input(INPUT_POST, 'Id_Clase');

  $stmt = ConexionBD::Abrir_Conexion()->prepare("UPDATE tbl_secciones SET DescripSeccion = '".$descseccion."', HraClase = '".$hraclase."', AulaClase = '".$aulaclase."', Id_PeriodoAcm = ".$idperiodoacm.", Id_usuario = ".$idusuario." WHERE Id_Seccion = ".$idseccion.";");
  if($stmt->execute()){

    $stmt1 = ConexionBD::Abrir_Conexion()->prepare("UPDATE tbl_clases_secciones SET Id_Clase = ".$idclase." WHERE Id_Seccion = ".$idseccion.";");

    if($stmt1->execute()){
      echo json_encode('1');
    }

  }else{
    echo json_encode('0');
  }

}
