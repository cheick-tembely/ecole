<?php
require('fpdf.php');

// Connexion à la base de données avec PDO
$pdo = new PDO("mysql:host=localhost;dbname=pointage_db", "root", "");

$id_professeur = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_professeur) {
    // Déterminer le mois et l'année précédents
    $mois_precedent = date('m', strtotime('-1 month'));
    $annee_precedente = date('Y');

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $query_professeur = "SELECT * FROM professeur WHERE id_professeur = :id_professeur";
    $stmt_professeur = $pdo->prepare($query_professeur);
    $stmt_professeur->execute(['id_professeur' => $id_professeur]);
    $professeur = $stmt_professeur->fetch(PDO::FETCH_ASSOC);

    if ($professeur) {
        // Création de l'objet PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Titre du document
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Facture', 0, 1, 'C');

        // Professeur
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Professeur: ' . $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur'], 0, 1);

        // Tableau des détails de la facture
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Matière', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Début', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Fin', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Volume horaire', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Prix unitaire', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

        // Requête préparée pour les pointsage
        $query = "SELECT p.*, m.libelle_matiere 
                  FROM pointage p
                  JOIN matiere m ON p.id_matiere = m.id_matiere
                  WHERE p.id_professeur = :id_professeur
                  AND MONTH(p.date_debut) = :mois_precedent
                  AND YEAR(p.date_debut) = :annee_precedente";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'id_professeur' => $id_professeur,
            'mois_precedent' => $mois_precedent,
            'annee_precedente' => $annee_precedente
        ]);

        $total_a_payer = 0;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date_debut = new DateTime($row['date_debut']);
            $date_fin = new DateTime($row['date_fin']);
            $volume_horaire = $date_debut->diff($date_fin)->format('%H:%I');
            $prix_unitaire = 10000;
            $total = $volume_horaire * $prix_unitaire;

            $total_a_payer += $total;

            $pdf->Cell(40, 10, $row['libelle_matiere'], 1, 0, 'C');
            $pdf->Cell(40, 10, $row['date_debut'], 1, 0, 'C');
            $pdf->Cell(40, 10, $row['date_fin'], 1, 0, 'C');
            $pdf->Cell(40, 10, $volume_horaire, 1, 0, 'C');
            $pdf->Cell(40, 10, $prix_unitaire, 1, 0, 'C');
            $pdf->Cell(40, 10, $total, 1, 1, 'C');
        }

        // Total à payer
        $pdf->Cell(240, 10, 'Total à Payer :', 1, 0, 'R');
        $pdf->Cell(40, 10, $total_a_payer, 1, 1, 'C');

        // Nom du fichier de sortie
        $file_name = 'Facture_' . $professeur['nom_professeur'] . '_' . $professeur['prenom_professeur'] . '.pdf';

        // Envoi du fichier PDF au navigateur
        $pdf->Output($file_name, 'D');
    } else {
        echo "Aucune information trouvée pour ce professeur.";
    }
} else {
    echo "Aucun ID de professeur spécifié.";
}
?>
