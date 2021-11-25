<?php
require('fpdf.php');
include_once "../../Modelo/Personas/Administrador.php";
class PDF extends FPDF
{
// Cabecera de página
private $title;

function establecerTitulo($title){
  $this->title = $title;
}


function __construct($title) {
    parent::__construct('P','mm','A3');
    $this->title = $title;
}

function Header()
{
    $title = $this->title;
    // Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(100,10,$title,1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function BasicTable($header, $data)
{
    // Cabecera
    $contador = 1;
    foreach($header as $col){
      if($contador == 2 || $contador == 1){
        $this->Cell(55,7,$col,1);
      }else $this->Cell(40,7,$col,1);
      
      $contador++;
    }   


    $this->Ln();

    // Datos
    foreach($data as $row)
    {
        $this->Cell(55,6,$row['nombres']." ".$row['apellidos'],1);
        $this->Cell(55,6,$row['correo'],1,0);
        $this->Cell(40,6,$row['direccion'],1);
        $this->Cell(40,6,$row['telefono'],1);
        $this->Cell(40,6,$row['celular'],1);
        $this->Cell(40,6,$row['usuario'],1);
        $this->Ln();
    }
}
}

if(isset($_GET['accion'])){
 $accion = $_GET['accion'];
 $rows = null;
 $rol = "";
 if($accion == "director"){
    $header = array("Nombre completo","Correo","Direccion","Telefono","Celular","Usuario");   
    $pdf = new PDF("Registros de la tabla director de sedes");  
    $rol = "Director_Sede";
 }else if($accion == "asesores"){

    $header = array("Nombre completo","Correo","Direccion","Telefono","Celular","Usuario");   
    $pdf = new PDF("Registros de la tabla asesores de sedes");  
    $rol = "Asesor_Afiliacion";
 }

 else if($accion == "gerentes"){
    $header = array("Nombre completo","Correo","Direccion","Telefono","Celular","Usuario");   
    $pdf = new PDF("Registros de la tabla gerentes de sedes");  
    $rol = "gerente_sede";
 }

 else if($accion == "clientes"){
    $header = array("Nombre completo","Correo","Direccion","Telefono","Celular","Usuario");   
    $pdf = new PDF("Registros de la tabla clientes de sedes");  
    $rol = "cliente";
 }




    $administrador = new Administrador("","","","","","","","","","","");
    $rows = $administrador->listar($rol);

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->BasicTable($header,$rows);
    $pdf->Output();

}

?>