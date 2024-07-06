<?php
require('fpdf.php');
require_once('db_lib.php');

if(isset($_POST['export'])){
    $userId = $_POST['export'];
    
    $stmt = $bdd->prepare('SELECT id_user, nom, prenom, date_naissance, sexe, pseudo, mail, date_inscription, statut_newsletter, telephone FROM utilisateur WHERE id_user = :id');
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Utilisateur non trouvé.');
    }

    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial','B',15);
            $this->Cell(80);
            $this->Cell(30,10,'Details de l\'utilisateur',0,0,'C');
            $this->Ln(20);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);

    $pdf->SetFillColor(200,220,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $w = array(50, 140);
    $header = array('Champ', 'Valeur');
    
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');

    $fill = false;
    foreach ($userData as $key => $value) {
        $pdf->Cell($w[0],10, ucfirst(str_replace('_', ' ', $key)), 1, 0, 'L', $fill);
        $pdf->Cell($w[1],10, $value, 1, 0, 'L', $fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    ob_end_clean();
    $pdf->Output('D', 'utilisateur.pdf'); 
}
?>