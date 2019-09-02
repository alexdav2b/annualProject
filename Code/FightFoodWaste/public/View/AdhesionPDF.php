<?php 
require_once __DIR__ . '/../fpdf/fpdf.php';
Class PDF extends FPDF{

    // Header de la page
    function Header(){
        // Titre 
        $this->SetFont('Arial', 'B', 20); // police
        $this->Cell(40); // deplacement vers la droite
        $this->Cell(30,10,'FIGHT FOOD WASTE', 0, 0,'C'); // Ecriture

        // Logo + Titre FightFoodWaste
        $this->Image(__DIR__ . '/../images/logo.png', 10, 10, 20, 20);
        $this->Cell(20); // deplacement vers la droite

        // Coordonnées
        $this->Ln(20); // line break   

        $this->SetFont('Arial', 'B', 15); // police
        $this->Cell(50,10,'Fight Food Waste', 0, 0,'C'); // Ecriture

        $this->Ln(10); // line break   
        $this->SetFont('Arial', '', 12); // police
        $this->Cell(2); // deplacement vers la droite

        $this->Cell(40,10,'Adresse :', 0, 0,1); // Ecriture
    }

    // Footer de la page
    function Footer(){
        $this->SetY(-15); // position à -1.5 cm du bas de la page
        $this->SetFont('Arial', '', 8); //police
        $this->Cell(0, 10, 'Page'.$this->PageNo(). '/{nb}', 0, 0, 'C'); // Numero de page
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40 ,10, "$siteN, $siteR", 0, 0,1); // Ecriture

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "$siteA", 0, 0,1); // Ecriture

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "$siteP", 0, 0,1); // Ecriture

$pdf->Ln(15);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10,'Client', 0, 0,1); // Ecriture

$pdf->Ln(10); // line break   
$pdf->SetFont('Arial','',12);
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10,"Company : $name", 0, 0,1); // Ecriture

$pdf->Ln(10); // line break   
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "Adresse :", 0, 0,1); // Ecriture

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(2,10, "$userN, $userR", 0, 0,1); // Ecriture

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "$userA", 0, 0,1); // Ecriture

$pdf->Ln(5); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "$userP", 0, 0,1); // Ecriture

$pdf->Ln(15);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10,'Details', 0, 0,1); // Ecriture
  

$currency = iconv("UTF-16", "ISO-8859-1//TRANSLIT", '€');
$pdf->SetFont('Arial','',12);
$pdf->Ln(10); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "Prix : $prix $currency", 0,0, 1);

$pdf->Ln(10); // line break  
$pdf->Cell(2); // deplacement vers la droite
$pdf->Cell(40,10, "Libelle : Adhesion a FightFoodWaste pour la periode du $date au $lastDay.", 0,0, 1);

$pdf->Output();
?>