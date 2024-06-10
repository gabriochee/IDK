<?php
require('fpdf.php');

$user = 'root';
$pass = 'root';
$dsn = 'mysql:host=localhost;dbname=newsletter';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    
    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id_user = :id');
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
        die('Utilisateur non trouvé.');
    }

    // creation du PDF
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

    foreach ($userData as $key => $value) {
        $pdf->Cell(50,10, ucfirst(str_replace('_', ' ', $key)), 1);
        $pdf->Cell(0,10, $value, 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'utilisateur_'.$userId.'.pdf'); // 'D' pour force download
}
?>
