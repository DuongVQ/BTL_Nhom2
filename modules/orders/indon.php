<?php

require("../../modules/orders/tfpdf/tfpdf.php");
include_once "../../config.php";

$pdf = new tFPDF();
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 14);

$pdf->setFillColor(193, 299, 252);

$id = $_GET['id'];
$result = $con->query("SELECT *, products.name AS pname, order_details.price_product AS oprice 
                                            FROM products, order_details 
                                            WHERE products.id=order_details.product_id AND order_id='$id'");

$pdf->Write(10, 'Đơn hàng của bạn gồm có:');
$pdf->Ln(10);

$width_cell = array(10, 20, 80, 20, 30, 30);

$pdf->Cell($width_cell[0], 10, 'ID', 1, 0, 'C', true);
$pdf->Cell($width_cell[1], 10, 'Mã hàng', 1, 0, 'C', true);
$pdf->Cell($width_cell[2], 10, 'Tên sản phẩm', 1, 0, 'C', true);
$pdf->Cell($width_cell[4], 10, 'Giá', 1, 0, 'C', true);
$pdf->Cell($width_cell[3], 10, 'Số lượng', 1, 0, 'C', true);
$pdf->Cell($width_cell[5], 10, 'Tổng tiền', 1, 1, 'C', true);
$pdf->SetFillColor(235, 236, 236);
$fill = false;
$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $i++;

    // Tính chiều cao cần thiết dựa trên nội dung dài nhất
    $pnameHeight = $pdf->GetStringWidth($row['pname']) / $width_cell[2];
    $rowHeight = ceil($pnameHeight) * 10; 
    
    $pdf->Cell($width_cell[0], $rowHeight, $i, 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[1], $rowHeight, $row['id'], 1, 0, 'C', $fill);

    $x = $pdf->GetX(); 
    $y = $pdf->GetY(); 
    $pdf->MultiCell($width_cell[2], 10, $row['pname'], 1, 'C', $fill);
    $pdf->SetXY($x + $width_cell[2], $y); 
  
    $pdf->Cell($width_cell[4], $rowHeight, number_format($row['oprice']), 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[3], $rowHeight, $row['quantity'], 1, 0, 'C', $fill);
    $pdf->Cell($width_cell[5], $rowHeight, number_format($row['quantity'] * $row['oprice']), 1, 1, 'C', $fill);

    $fill = !$fill;
}
$pdf->Write(10, 'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
$pdf->Ln(10);

$pdf->Output();
?>

