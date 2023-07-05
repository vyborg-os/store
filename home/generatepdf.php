<?php
require('fpdf183/fpdf.php');
//include_once('controller.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
function LoadDataNew($header)
{
    require_once('../model/controller.php');
    //$this->Image('logo.png',10,6,30);
    // Title
    $this->SetFont('Arial','B',16);
    $this->Cell(50,10,'Bites Multi Global Farm','C');
     $this->Cell(30,6);
    $this->Cell(30,6);
     $this->SetFont('Arial','',12);
    $this->Cell(20,2,'X close','','','',false,"http://localhost/store/home/pos");
    // Line break
    $this->Ln(8);
    $this->Cell(30,6);
    $this->Cell(10,6);
    $this->Cell(50,10,'Address: Gado Nasko Road 2-2, Kubwa, FCT-Abuja','C');
     $this->Ln(8);
    $this->Cell(30,6);
    $this->Cell(15,6);
    $this->SetFont('Arial','B',12);
     $this->Cell(50,10,'Tel: 08035909133, 09123929217, 08130169861','C');
    $this->Ln(20);
    $this->Cell(30,6);
    $this->Cell(30,6);
     $this->Cell(70,10,'Purchase Receipt',1,0,'C');
    $this->Ln(20);
    $this->SetFont('Arial','B',11);
    $this->Cell(30,6);
    $this->Cell(30,6);
     $this->Cell(30,6);
    $this->Cell(30,6);
     $this->Cell(22,10,'Date/Time:');
    $this->SetFont('Arial','',11);
     $this->Cell(44,10,date("d/m/y - h-s-ia"));
    $this->Ln(3);
  
    $this->SetFont('Arial','',11);
    if(isset($_GET['tid'])){
    $tiddy = $_GET['tid'];
    $tidd = fetchrectidd($tiddy);
    }else{
    $tidd = fetchrecordpt();
    }
        $this->SetFont('Arial','B',11);
    $this->Cell(30,4,'Transaction ID:');
    foreach($tidd as $tid){
        $this->SetFont('Arial','',11);
    $this->Cell(40,4,$tid['tid']);
        $tid = $tid['tid'];
    }
    // Line break
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
     foreach($header as $col)
        $this->Cell(35,7,$col,1);
    $this->Ln();
    
   // $data = mysqli_fetch_array(fetchrecord());
    $county = 0;
    $data = fetchrectid($tid);
    foreach($data as $d){
    $this->SetFont('Arial','',12);
    $this->Cell(35,6,$d['productname'],1);
    $this->Cell(35,6,'N'.number_format($d['productprice']),1);
    $this->Cell(35,6,$d['qty'],1);
    $this->Cell(35,6,$d['productsize'],1);
    $sum = $d['qty'] * $d['productprice'];
    $this->Cell(35,6,'N'.number_format($sum),1);
    $county = $county + $sum;
    $this->Ln();
    }
    $this->SetFont('Arial','B',12);
    $this->Cell(35,6);
    $this->Cell(35,6);
    $this->Cell(35,6);
    $this->Cell(35,6,'Total Amount ',1);
    $this->Cell(35,6,'N'.number_format($county),1);
    $this->Ln(8);
     $this->Cell(50,10,'Payment Method: '.$d['pmethod'],'C');
    $this->Cell(30,6);
    $this->Cell(15,6);
    $this->SetFont('Arial','B',12);
     $this->Cell(50,10,'Cashier: '.$d['username'],'C');
     $this->Ln(8);
   
    $this->SetFont('Arial','B',12);
     $this->Cell(50,10,'THANKS FOR YOUR PATRONAGE','C');
     $this->Ln(5);
    $this->Cell(50,10,'PLEASE, CALL AGAIN','C');
}

    
// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}


}

$pdf = new PDF();
// Column headings
$header = array('ProdName', 'Price', 'Qty','Size','Est');
// Data loading
//$data = $pdf->LoadDataNew();
//$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->LoadDataNew($header);
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
///$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output();

?>