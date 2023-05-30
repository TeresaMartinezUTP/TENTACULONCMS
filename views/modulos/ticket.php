<?php
require "../../views/Fpdf/fpdf.php";
require "../../model/conexion.php";

$pdf = new FPDF('P', 'mm', array(80, 150)); // Tamaño tickt 80mm x 150 mm (largo aprox)

if (isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];
    $headers = Conexion::conectar()->prepare("SELECT * FROM venta v LEFT join local_mesas l ON v.id_mesa=l.id_mesa
    LEFT JOIN clientes_frecuentes cf ON cf.id_cliente_frecuente=v.id_cliente_frecuente
    WHERE v.id_venta='$ticket'");
    $headers->execute();
    $headers  = $headers->fetch(PDO::FETCH_ASSOC);

    $details = Conexion::conectar()->prepare("SELECT tv.id_localplato,tv.id_localbebida, p.nombre_plato, b.descripcion,b.marca,tv.cantidad,tv.precio_venta,tv.total FROM detalle_venta tv 
    LEFT JOIN platos p ON p.id_plato=tv.id_localplato 
    LEFT JOIN bebidas b ON b.id_bebida=tv.id_localbebida 
    WHERE tv.id_venta='$ticket'");
    $details->execute();
    $details  = $details->fetchAll(PDO::FETCH_ASSOC);

    $footer = Conexion::conectar()->prepare("SELECT FORMAT(SUM(total),2) AS subtotal,
    FORMAT(SUM(total) * 0.18,2) AS igv,
     FORMAT((SUM(total) * 0.18) + SUM(total),2) As total FROM detalle_venta 
     WHERE id_venta='$ticket'");
    $footer->execute();
    $footer  = $footer->fetch(PDO::FETCH_ASSOC);
}
$pdf->AddPage();

// CABECERA
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(60, 4, utf8_decode('TENTACULÓN'), 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(60, 4, 'C.I.F.: 01234567A', 0, 1, 'C');
$pdf->Cell(60, 4, 'C/ Arturo Soria, 1', 0, 1, 'C');
$pdf->Cell(60, 4, 'C.P.: 28028 Madrid (Madrid)', 0, 1, 'C');
$pdf->Cell(60, 4, '999 888 777', 0, 1, 'C');
$pdf->Cell(60, 4, 'alfredo@lacodigoteca.com', 0, 1, 'C');

// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60, 4, 'Factura Simpl.: F2019-000001', 0, 1, '');
$pdf->Cell(60, 4, 'Fecha: ' . $headers['fecha_hora'], 0, 1, '');
//$pdf->Cell(60, 4, 'Metodo de pago: Tarjeta', 0, 1, '');

// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Descripcion', 0);
$pdf->Cell(5, 10, 'Ud', 0, 0, 'R');
$pdf->Cell(10, 10, 'Precio', 0, 0, 'R');
$pdf->Cell(15, 10, 'Total', 0, 0, 'R');
$pdf->Ln(8);
$pdf->Cell(60, 0, '', 'T');
$pdf->Ln(0);

// PRODUCTOS
for ($i = 0; $i < count($details); $i++) {
    if ($details[$i]['id_localplato'] != null && $details[$i]['id_localbebida'] == null) {
        $namepro = $details[$i]['nombre_plato'];
    } else  if ($details[$i]['id_localplato'] == null && $details[$i]['id_localbebida'] != null) {
        $namepro = $details[$i]['marca'].' '.$details[$i]['descripcion'];
    }
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->MultiCell(30, 4, utf8_decode($namepro), 0, 'L');
    $pdf->Cell(35, -5, $details[$i]['cantidad'], 0, 0, 'R');
    $pdf->Cell(10, -5, number_format(round($details[$i]['precio_venta'], 2), 2, ',', ' '), 0, 0, 'R');
    $pdf->Cell(15, -5, number_format(round($details[$i]['total'], 2), 2, ',', ' '), 0, 0, 'R');
    $pdf->Ln(3);
}



// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(6);
$pdf->Cell(60, 0, '', 'T');
$pdf->Ln(2);
$pdf->Cell(25, 10, 'SUBTOTAL', 0);
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($footer['subtotal'] , 2), 2, ',', ' '), 0, 0, 'R');
$pdf->Ln(3);
$pdf->Cell(25, 10, 'DESCUENTO', 0);
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($headers['descuento'], 2), 2, ',', ' '), 0, 0, 'R');

$cargo=0;
if ($headers['atencion']=="Delivery") {
    $cargo=$headers['cargo'];
    $pdf->Ln(3);
    $pdf->Cell(25, 10, 'CARGO', 0);
    $pdf->Cell(20, 10, '', 0);
    $pdf->Cell(15, 10, number_format(round($headers['cargo'], 2), 2, ',', ' '), 0, 0, 'R');
}

$pdf->Ln(3);
$pdf->Cell(25, 10, 'TOTAL', 0);
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($footer['subtotal']-$headers['descuento']-$cargo, 2), 2, ',', ' '), 0, 0, 'R');

// PIE DE PAGINA
$pdf->Ln(10);
$pdf->Cell(60, 0, 'GRACIAS POR ', 0, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(60, 0, 'SU PREFERENCIA', 0, 1, 'C');

$pdf->Output('ticket.pdf', 'i');
