<?php
require "../../views/Fpdf/fpdf.php";
require "../../model/conexion.php";

$pdf = new FPDF('P', 'mm', array(80, 150)); // Tamaño tickt 80mm x 150 mm (largo aprox)

if (isset($_GET['ticket'])) {
    $ticket = $_GET['ticket'];
    $headers = Conexion::conectar()->prepare("SELECT * FROM venta_parte vp 
    LEFT JOIN clientes_frecuentes cf ON cf.id_cliente_frecuente=vp.id_cliente_frecuente
    WHERE vp.id_ventaparte='$ticket'");
    $headers->execute();
    $headers  = $headers->fetch(PDO::FETCH_ASSOC);

    $details = Conexion::conectar()->prepare("SELECT dv.id_localplato,dv.id_localbebida, p.nombre_plato, b.descripcion,b.marca,dv.cantidad,dv.precio_venta, FORMAT(precio_venta * cantidad,2) as total FROM detalle_venta_parte dv 
    LEFT JOIN platos p ON p.id_plato=dv.id_localplato 
    LEFT JOIN bebidas b ON b.id_bebida=dv.id_localbebida 
    WHERE dv.id_venta_parte='$ticket'");
    $details->execute();
    $details  = $details->fetchAll(PDO::FETCH_ASSOC);

    $footer = Conexion::conectar()->prepare("SELECT FORMAT(SUM(precio_venta * cantidad),2) AS subtotal,
    FORMAT(SUM(precio_venta * cantidad) * 0.18,2) AS igv,
     FORMAT((SUM(precio_venta * cantidad) * 0.18) + SUM(precio_venta * cantidad),2) As total FROM detalle_venta_parte 
     WHERE id_venta_parte='$ticket'");
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
$pdf->Cell(60, 4, 'Fecha: ' . $headers['fecha_hora_pago'], 0, 1, '');
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

$pdf->Ln(3);
$pdf->Cell(25, 10, 'TOTAL', 0);
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($footer['subtotal']-$headers['descuento'], 2), 2, ',', ' '), 0, 0, 'R');

// PIE DE PAGINA
$pdf->Ln(10);
$pdf->Cell(60, 0, 'GRACIAS POR ', 0, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(60, 0, 'SU PREFERENCIA', 0, 1, 'C');

$pdf->Output('ticket.pdf', 'i');
