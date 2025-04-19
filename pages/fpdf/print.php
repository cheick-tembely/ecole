<?php

require("../fonctions.php");

// Assurez-vous de spécifier la base de données dans le DSN
$pdo = new PDO("mysql:host=localhost;dbname=ecole-gest", "root", "");

// Si vous souhaitez activer les exceptions pour les erreurs PDO (recommandé)
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Votre requête SQL
$identite_stagiaire = $pdo->query("SELECT id_pointage, pr.nom_professeur, pr.prenom_professeur, p.date_debut, p.date_fin, c.libelle_classe, m.libelle_matiere, statut FROM pointage p, professeur pr, matiere m, classe c WHERE p.id_professeur = pr.id_professeur AND p.id_matiere = m.id_matiere AND c.id_classe = p.id_classe AND id_pointage = " . $_GET['id']);

if ($identite_stagiaire !== false) {
    $stagiaire = $identite_stagiaire->fetch();

    $nom_prenom = strtoupper($stagiaire['nom_professeur'] . "  " . $stagiaire['prenom_professeur']);
    $date_naiss = strtoupper($stagiaire['date_debut']);
    $date_fin = strtoupper($stagiaire['date_fin']);
    $lieu_naiss = strtoupper($stagiaire['libelle_classe']);
    $cin = strtoupper($stagiaire['libelle_matiere']);
    $date_insc = strtoupper($stagiaire['statut']);

    require('fpdf.php');
    require_once 'dompdf/autoload.inc.php';

    // Création du PDF
    $pdf = new FPDF('P', 'mm', 'A5');
    $pdf->AddPage();
    $pdf->Image('../ecole-gest.jpg', 10, 5, 50, 20);
    $pdf->Ln(18);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, "Fiche de pointage du professeur: $nom_prenom", 'TB', 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $h = 7;
    $retrait = "      ";
    $pdf->Write($h, $retrait . "Professeur : ");
    $pdf->SetFont('', 'BIU');
    $pdf->Write($h, $nom_prenom . "\n");
    $pdf->SetFont('', '');
    $pdf->Write($h, $retrait . "Date Debut : " . $date_naiss . "\n");
    $pdf->Write($h, $retrait . "Date Fin : " . $date_fin . "\n");
    $pdf->Write($h, $retrait . "Classe : " . $lieu_naiss . "\n");
    $pdf->Write($h, $retrait . "Matiere : " . $cin . " \n");
    $pdf->Write($h, $retrait . "Statut du Pointage : " . $date_insc . " \n");

    $pdf->Cell(20);
    $pdf->Cell(80, 8, "Le directeur général de l'établissement", 1, 1, 'C');
    $pdf->Cell(20);
    $pdf->Cell(80, 5, "M. TEMBELY CHEICKNA", 'LR', 1, 'C');
    $pdf->Cell(20);
    $pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
    $pdf->Cell(20);
    $pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
    $pdf->Cell(20);
    $pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
    $pdf->Cell(20);
    $pdf->Cell(80, 5, ' ', 'LRB', 1, 'C');

    // Afficher le PDF
    $pdf->Output('', '', true);
} else {
    echo "Erreur: La requête SQL a échoué.";
}

?>
