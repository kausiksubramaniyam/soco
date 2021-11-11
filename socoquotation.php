<?php
include 'fpdf184/fpdf.php';

$server="localhost";
$user="root";
$pass="Activa29#$";
$db="soco";

$conn=mysqli_connect($server,$user,$pass,$db);

if(!$conn){
	die("Connection Failed:".mysqli_connect_error());
}
$tablename=$_POST["brand"];
$code=$_POST["code"];
$type=$_POST["typ"];
$sql="SELECT * FROM $tablename WHERE colorcode=$code";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($row['width']==36){
	$price=2*$row['price']*$_POST["quantity"];
	echo "PRICE".$price."TQ";
	ob_start();
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image("download.jpeg");
	$pdf->SetFont('Arial', 'B', 18);
	$pdf->Cell(0,50,'Approximate Quotation',0,1,'C');
	$pdf->Cell(0,0,'Name of Organization: '.$_POST['orgname'],0,1,'L');
    $pdf->Cell(0,20,'Brand: '.$tablename,0,1,'L');
    $pdf->Cell(0,10,'Type: '.$type,0,1,'L');
    $pdf->Cell(0,10,'Category: '.$_POST['category'],0,1,'L');
    $pdf->Cell(0,10,'Color Code: '.$code,0,1,'L');
    $pdf->Cell(0,10,'Quantity: '.$_POST['quantity'],0,1,'L');
    $pdf->Cell(0,10,'Fabric width: '.$row['width'].' inch',0,1,'L');
	$pdf->Cell(0,10,'Estimated Price:'.$price,0,1,'C');
	$pdf->Output();
	ob_end_flush();
}
elseif ($row['width']==58) {
	$price=1.4*$row['price']*$_POST["quantity"];
	echo "PRICE".$price."TQ";
} 

?>
