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
    $this->SetFont('Arial','B',8);
    $this->Cell(2,10,'Bites Multi Global Farm');
     $this->Cell(30,6);
    $this->Cell(30,6);
     $this->SetFont('Arial','',6);
    $this->Cell(20,2,'X close','','','',false,"http://localhost/store/home/pos");
    // Line break
    $this->Ln(4);
    $this->Cell(5,10,'Address: Gado Nasko Road 2-2,','C');
    $this->Ln(3);
     $this->Cell(4,6);
     $this->Cell(7,10,'Kubwa, FCT-Abuja','C');
     $this->Ln(4);
    $this->SetFont('Arial','',6);
     $this->Cell(50,10,'Tel: 08035909133, 09123929217,','C');
    $this->Ln(3);
    $this->Cell(4,6);
    $this->Cell(50,10,' 08130169861','C');
    $this->Ln(10);
    $this->Cell(4,6);
     $this->Cell(25,10,'Receipt',1,0,'C');
    $this->Ln(10);
    $this->SetFont('Arial','B',6);
     $this->Cell(22,10,'Date/Time:'.date("d/m/y - h-s-ia"));
    $this->Ln(8);
  
    $this->SetFont('Arial','',5);
    if(isset($_GET['tid'])){
    $tiddy = $_GET['tid'];
    $tidd = fetchrectidd($tiddy);
    }else{
    $tidd = fetchrecordpt();
    }
        $this->SetFont('Arial','B',7);
    $this->Cell(11,4,'invoice:');
    foreach($tidd as $tid){
        $this->SetFont('Arial','',);
    $this->Cell(5,4,$tid['tid']);
        $tid = $tid['tid'];
    }
    // Line break
    $this->Ln(2);
//    $this->SetFont('Arial','B',12);
//     foreach($header as $col)
//        $this->Cell(35,7,$col,1);
//    $this->Ln();
    
   // $data = mysqli_fetch_array(fetchrecord());
    $county = 0;
    $data = fetchrectid($tid);
    foreach($data as $d){
    $this->SetFont('Arial','',8);
        $this->Ln(3);
    $this->Cell(5,6,$d['productname']);
        $this->Ln(4);
    $this->Cell(55,6,$d['qty'].' x N'.number_format($d['productprice']).' = N'.$d['qty'] * $d['productprice']);
    $sum = $d['qty'] * $d['productprice'];
    $county = $county + $sum;
    $this->Ln(4);
    }
     $this->Ln(3);
    $this->SetFont('Arial','B',10);
    $this->Cell(35,10,'Total =  N'.number_format($county),);
    $this->Ln(5);
    $this->SetFont('Arial','',7);
     $this->Cell(5,10,'Payment Method: '.$d['pmethod'],'C');
    $this->Ln(4);
    $this->SetFont('Arial','',7);
     $this->Cell(50,10,'Cashier: '.$d['username'],'C');
     $this->Ln(4);
   
    $this->SetFont('Arial','',5);
     $this->Cell(50,10,'THANKS FOR YOUR PATRONAGE','C');
     $this->Ln(3);
     $this->Cell(4,6);
    $this->Cell(80,10,'PLEASE, CALL AGAIN','C');
     $this->Ln(5);
     $this->SetFont('Arial','B',8);
    $this->Cell(80,10,' _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _','C');
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