<?php
error_reporting(0); // Masquer les avertissements

$pdo = new PDO("mysql:host=localhost;dbname=pointage_db;charset=utf8", "root", ""); // Spécifier l'encodage UTF-8

$id_professeur = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_professeur) {
    // Déterminer le mois et l'année précédents
    $mois_precedent = date('m', strtotime('-1 month'));
    $annee_precedente = date('Y');

    $query_professeur = "SELECT * FROM professeur WHERE id_professeur = :id_professeur";
    $stmt_professeur = $pdo->prepare($query_professeur);
    $stmt_professeur->execute(['id_professeur' => $id_professeur]);
    $professeur = $stmt_professeur->fetch(PDO::FETCH_ASSOC);

    if ($professeur) {
        $file_name = 'Facture_' . $professeur['nom_professeur'] . '_' . $professeur['prenom_professeur'] . '.csv';

        // Entête du fichier CSV
        $csv_content = "Matiere,Debut,Fin,Volume horaire,Prix unitaire,Total\n";

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

            // Ligne de données du fichier CSV
            $csv_content .= "{$row['libelle_matiere']},{$row['date_debut']},{$row['date_fin']},{$volume_horaire},{$prix_unitaire},{$total}\n";
        }

        // Ligne pour le total
        $csv_content .= "Total à Payer :$total_a_payer\n";

        // En-têtes du navigateur pour le téléchargement d'un fichier CSV
        header('Content-Type: text/csv; charset=utf-8'); // Spécifier l'encodage UTF-8
        header('Content-Disposition: attachment;filename="' . $file_name . '"');
        header('Cache-Control: max-age=0');

        // Écriture du contenu CSV dans la sortie
        echo $csv_content;
        exit;
    } else {
        echo "Aucune information trouvée pour ce professeur.";
    }
} else {
    echo "Aucun ID de professeur spécifié.";
}
?>
