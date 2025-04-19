<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('autoload.inc.php');
require_once('../connection.php');

use Dompdf\Dompdf;

$id_professeur = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_professeur) {
    // Déterminer le mois et l'année précédents
    $mois_precedent = date('m', strtotime('-1 month'));
    $annee_precedente = date('Y');

    $query_professeur = "SELECT * FROM professeur WHERE id_professeur = $id_professeur";
    $result_professeur = mysqli_query($db, $query_professeur) or die(mysqli_error($db));

    if (mysqli_num_rows($result_professeur) > 0) {
        $professeur = mysqli_fetch_assoc($result_professeur);

        // Créer une nouvelle instance de Dompdf
        $dompdf = new Dompdf();

        // Contenu HTML à convertir en PDF
        $html = '<!DOCTYPE html>
                <html>
                <head>
                    <title>Facture</title>
                </head>
                <body>
                    <h2>Facture</h2>
                    <p><strong>Professeur:</strong> ' . $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur'] . '</p>
                    <table border="1" cellspacing="0" cellpadding="5">
                        <tr>
                            <th>Matière</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Volume horaire</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>';

        $query = "SELECT p.*, m.libelle_matiere 
                  FROM pointage p
                  JOIN matiere m ON p.id_matiere = m.id_matiere
                  WHERE p.id_professeur = $id_professeur
                  AND MONTH(p.date_debut) = $mois_precedent
                  AND YEAR(p.date_debut) = $annee_precedente";

        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $total_a_payer = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $date_debut = new DateTime($row['date_debut']);
            $date_fin = new DateTime($row['date_fin']);
            $volume_horaire = $date_debut->diff($date_fin)->format('%H:%I');
            $prix_unitaire = 10000;
            $total = $volume_horaire * $prix_unitaire;

            $total_a_payer += $total;

            $html .= '<tr>
                        <td>' . $row['libelle_matiere'] . '</td>
                        <td>' . $row['date_debut'] . '</td>
                        <td>' . $row['date_fin'] . '</td>
                        <td>' . $volume_horaire . '</td>
                        <td>' . $prix_unitaire . '</td>
                        <td>' . $total . '</td>
                      </tr>';
        }

        // Total à payer
        $html .= '<tr>
                    <td colspan="5" align="right"><strong>Total à Payer :</strong></td>
                    <td>' . $total_a_payer . '</td>
                  </tr>';

        $html .= '</table></body></html>';

        // Charger le contenu HTML dans DOMPDF
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Nom du fichier de sortie
        $file_name = 'Facture_' . $professeur['nom_professeur'] . '_' . $professeur['prenom_professeur'] . '.pdf';

        // Générer le PDF et l'envoyer au navigateur
        $dompdf->stream($file_name, array("Attachment" => false));
    } else {
        echo "Aucune information trouvée pour ce professeur.";
    }
} else {
    echo "Aucun ID de professeur spécifié.";
}
?>
