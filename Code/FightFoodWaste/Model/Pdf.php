<?php 
require_once __DIR__ . '/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output('filename.pdf', 'I');
// $pdf->Output('I','filename.pdf');
// Class PDF extends FPDF{

//     // Header de la page
//     function Header(){
//         // Titre Facture
//         $this->SetFont('Arial', 'B', 20); // police
//         $this->Cell(80); // deplacement vers la droite
//         $this->Cell(30,10,'FACTURE', 1, 0,'C'); // Ecriture

//         // Logo + Titre FightFoodWaste
//         $this->Image(__DIR__ . '/../public/images/logo.png');
//         $this->SetFont('Arial', 'B', 15); // police
//         $this->Cell(30,10,'Fight Food Waste', 1, 0,'C'); // Ecriture

//         $this->Ln(20); // line break   
//     }

//     // Footer de la page
//     function Footer(){
//         $this->SetY(-15); // position à -1.5 cm du bas de la page
//         $this-SetFont('Arial', '', 8); //police
//         $this->Cell(0, 10, 'Page'.$this->PageNo(). '/{nb}', 0, 0, 'C'); // Numero de page
//     }
// }
// $pdf = new PDF();
// $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
// $pdf->Output();

?>