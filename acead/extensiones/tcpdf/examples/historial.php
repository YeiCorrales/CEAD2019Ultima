<?php

//============================================================+
// File name   : reportecalificaciones.php
// Begin       : 2019-04-06
// Last Update : 2019-04-06
//
// Description : REcibe los valores del JS a traves de ajax y JQUERY
//
// Author: Nicolle Varela
//
//============================================================+

require_once '../../../controladores/calificaciones.controlador.php';
require_once '../../../modelos/calificaciones.modelo.php';

class imprimirFactura{

public $alumno;
public $nombrealumno;
public $cuerpotabla;

public function traerImpresionReporte(){

 $this->cuerpotabla = '';
 $contador = 1;
//Aqui se recibe la informacion de las calificaciones a imprimir
$d = $this->alumno;
$nombrealumno = $this->nombrealumno;
$ct = $this->cuerpotabla;
$respuestaReporte = ControladorCalificaciones::ctrMostrarHistorial($d);

//$ct = '<tr><td>11</td><td>Hola a todos</td><td>bb</td><td>cc</td></tr>';
if(isset($respuestaReporte)){
//while($datos = $respuestaReporte->fetch_array()){
////$this->cuerpotabla += '<tr><td>'.$contador.'</td><td>'.$datos['nombre'].'</td><td>'.$datos['NF'].'</td><td>'.$datos['OBS'].'</td></tr>';
//
//}
//$ct = '<tr><td>'.$contador.'</td><td>aa</td><td>bb</td><td>cc</td></tr>';
foreach($respuestaReporte as $item){
//$this->cuerpotabla += '<tr><td>'.$contador.'</td><td>'.$item->nombre.'</td><td>'.$item->NF.'</td><td>'.$item->OBS.'</td></tr>';
$ct .= '<tr><td>'.$contador.'</td><td>'.$respuestaReporte[$contador-1]['NC'].'</td><td>'.$respuestaReporte[$contador-1]['DS'].'</td><td>'.$respuestaReporte[$contador-1]['DP'].'</td><td>'.$respuestaReporte[$contador-1]['NF'].'</td><td>'.$respuestaReporte[$contador-1]['STATUS'].'</td></tr>';
$contador++;
}
}else{
$ct = '<tr><td>'.$contador.'</td><td>aa</td><td>bb</td><td>cc</td></tr>';
}
//$nombreAlumno = $respuestaReporte["nombre"];
//$notaFinal = $respuestaReporte["NF"];
//$observacion = $respuestaReporte["OBS"];



require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF
      <table>
        <tr>
            <td style="width:150px;"><img src="images/acead_logo.jpg" height="80px"></td>
            <td style="width:390px;">
                <div style="font-size:9px; text-align: right; line-height: 15px;">
                    <label style="font-style: bold; color: #33470a;">Academia de música CEAD</label>
                    <br>Dirección: Col. Col. San Ignacio, 5ta calle, cotiguo a Gasolinera TEXACO
                    <br>Telefono: 2239-2330
                    <br>e-mail: sistemas@adcead.org
                </div>
            </td>
        </tr>
      </table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF
   <br>
   <table>
        <tr>
            <td>alumno: $nombrealumno</td>
        </tr>
    </table><br>
    <h2>Historial Academico</h2><br>

    <table style="font-size: 10px; padding: 5px 10px;" border="1">
        <thead>
            <tr style="text-align: center; font-size: 12px; color: #4409d5;">
                <th>Nº</th>
                <th>Clase</th>
                <th>Seccion</th>
                <th>Periodo</th>
                <th>Nota</th>
                <th>OBS</th>
            </tr>
        </thead>
        <tbody>
            $ct
        </tbody>
    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

//----SALIDA DEL PDF
$pdf->Output('historial.pdf', 'I');

}

}

$reporte = new imprimirFactura();
$reporte->alumno = $_GET['id_alumno'] ?: null;
$reporte->nombrealumno = $_GET['nombrealumno'] ?: null;

$reporte->traerImpresionReporte();
?>
