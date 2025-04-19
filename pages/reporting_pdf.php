<?php
include '../includes/connection.php';

require('fpdf/fpdf.php');

// Vérifier si la clé 'id' est définie dans $_GET
if(isset($_GET['id'])) {
    // Préparer la requête SQL avec une requête préparée
    $query2 = 'SELECT id_pointage, pr.nom_professeur, pr.prenom_professeur
               FROM professeur pr
               JOIN pointage p ON p.id_professeur = pr.id_professeur
               WHERE id_pointage = ? LIMIT 1';

    // Préparer la requête
    $stmt = mysqli_prepare($db, $query2);
    // Lier le paramètre
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    // Exécuter la requête
    mysqli_stmt_execute($stmt);
    // Obtenir le résultat
    $result2 = mysqli_stmt_get_result($stmt);

    // Créer une nouvelle instance de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);

    $pdf->Cell(40,10,'L\'ensemble des fiches pour le Professeur : ');

    while ($row = mysqli_fetch_assoc($result2)) { 
        $pdf->Cell(40,10,$row['nom_professeur']);
    }

    $pdf->Ln();

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(40,10,'Nom',1);
    $pdf->Cell(40,10,'Prenom',1);
    $pdf->Cell(40,10,'Classe',1);
    $pdf->Cell(40,10,'Matiere',1);
    $pdf->Cell(40,10,'Debut',1);
    $pdf->Cell(40,10,'Fin',1);
    $pdf->Cell(40,10,'Statut',1);
    $pdf->Cell(40,10,'Commentaire',1);
    $pdf->Cell(40,10,'Volume horaire',1);
    $pdf->Cell(40,10,'Prix',1);
    $pdf->Cell(40,10,'Total',1);

    $pdf->Ln();

    $query = 'SELECT id_pointage, pr.nom_professeur, pr.prenom_professeur, a.volume, p.date_debut, p.date_fin, p.statut, p.commentaire, m.libelle_matiere, c.code_classe 
              FROM professeur pr, pointage p, classe c, matiere m, attribution a 
              WHERE p.id_professeur = pr.id_professeur 
              AND p.id_matiere = m.id_matiere 
              AND c.id_classe = p.id_classe 
              AND a.id_professeur = pr.id_professeur 
              AND id_pointage = ?';

    // Préparer la requête
    $stmt = mysqli_prepare($db, $query);
    // Lier le paramètre
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
    // Exécuter la requête
    mysqli_stmt_execute($stmt);
    // Obtenir le résultat
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40,10,$row['nom_professeur'],1);
        $pdf->Cell(40,10,$row['prenom_professeur'],1);
        $pdf->Cell(40,10,$row['code_classe'],1);
        $pdf->Cell(40,10,$row['libelle_matiere'],1);
        $pdf->Cell(40,10,$row['date_debut'],1);
        $pdf->Cell(40,10,$row['date_fin'],1);
        $pdf->Cell(40,10,$row['statut'],1);
        $pdf->Cell(40,10,$row['commentaire'],1);
        $pdf->Cell(40,10,$row['volume'],1);
        $pdf->Cell(40,10,'10000',1); // Prix statique
        $pdf->Cell(40,10,$row['volume'] * 10000,1); // Total calculé
        $pdf->Ln();
    }

    $pdf->Output();

    // Fermer la connexion à la base de données
    mysqli_close($db);
} else {
    // Si la clé 'id' n'est pas définie dans $_GET, afficher un message d'erreur
    echo "Erreur : Identifiant non défini.";
}
?>
