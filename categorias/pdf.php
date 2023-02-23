<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    // el this se usa porque estamos haciendo referencia a la clase de pdf

    // Logo
    $this->Image('../imgs/icono.jpg',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'Reporte de ventas',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(35, 10, 'Codigo compra',1,0,'C', 0);
    $this->Cell(35, 10, 'Codigo producto',1,0,'C', 0);
    $this->Cell(20, 10, 'Cantidad',1,0,'C', 0);
    $this->Cell(35, 10, 'Fecha de compra',1,0,'C', 0);
    $this->Cell(35, 10, 'Nombre Cliente',1,0,'C', 0);
    $this->Cell(20, 10, 'Total',1,1,'C', 0);
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
}
require_once '../logica/conexion.php';
$consulta= "SELECT * FROM `ventas`";
$resultado= $conex->query($consulta);

$pdf = new PDF();
// para mostrar el numero de paginas 
$pdf-> AliasNbPages(); 
// añadimos una pagina
$pdf->AddPage();
// tipo de fuente y tamaño de la letra 
$pdf->SetFont('Arial','',10);

while($row = $resultado->fetch_assoc()){
    // ancho, alto, datos de row, borde, sin salto de linea, centrado y sin relleno
    $pdf->Cell(35, 10, $row['id_compra'],0,0,'C', 0);
    $pdf->Cell(35, 10, $row['id_producto'],0,0,'C', 0);
    $pdf->Cell(20, 10, $row['cantidad'],0,0,'C', 0);
    $pdf->Cell(35, 10, $row['fecha_compra'],0,0,'C', 0);
    $pdf->Cell(35, 10, $row['nombre_cliente'],0,0,'C', 0);
    $pdf->Cell(20, 10, $row['pago_total'],0,1,'C', 0);
}
// esta crea una celda con el alto, el ancho, la negrilla (B) y la fuente, se le puede meter borde y salto de linea
// $pdf->Cell(40,10,utf8_decode('¡Hola, Mundo!'));
$pdf->Output();

?>