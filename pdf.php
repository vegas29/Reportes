,<?php
require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de fallos',1,0,'C');
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
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
require('conexion.php');
$consultaone = "SELECT * FROM reportes WHERE id_reporte = '1'";
$resultados = mysqli_query($con, $consultaone);


$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',16);


while($fila = mysqli_fetch_row($resultados)){
    $pdf->Cell(90,10, $row['equipo_reporte'], 1, 0, 'C', 0);
    $pdf->Cell(90,10, $row['zona_reporte'], 1, 0, 'C', 0);
    $pdf->Cell(90,10, $row['descripcion_reporte'], 1, 0, 'C', 0);
}
$pdf->Output();
?>