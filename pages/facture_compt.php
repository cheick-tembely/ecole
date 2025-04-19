<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements

include '../includes/connection.php';
include '../includes/sidebar_compt.php';

$id_professeur = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_professeur) {
    // Déterminer le mois et l'année précédents
    $mois_precedent = date('m', strtotime('-1 month'));
    $annee_precedente = date('Y');

    $query_professeur = "SELECT * FROM professeur WHERE id_professeur = $id_professeur";
    $result_professeur = mysqli_query($db, $query_professeur) or die(mysqli_error($db));

    if (mysqli_num_rows($result_professeur) > 0) {
        $professeur = mysqli_fetch_assoc($result_professeur);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de Paie</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .invoice, .invoice * {
                visibility: visible;
            }
            .invoice {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="invoice" id="invoice">
        <div class="invoice-header">
            <h2>Fiche de Paie</h2>
            <div class="invoice-details">
                <p><strong>Professeur:</strong> <?php echo $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur']; ?></p>
                <button class="btn btn-primary bg-gradient-primary" onclick="imprimerSection('invoice')">Imprimer</button>
            </div>
        </div>
        <div class="invoice-table">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Volume</th>
                        <th>Prix</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT p.*, m.libelle_matiere, c.code_classe
                              FROM pointage p
                              JOIN matiere m ON p.id_matiere = m.id_matiere
                              JOIN classe c ON p.id_classe = c.id_classe
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

                        echo '<tr>';
                        echo '<td>'. $row['code_classe'].'</td>';
                        echo '<td>'. $row['libelle_matiere'].'</td>';
                        echo '<td>'. $row['date_debut'].'</td>';
                        echo '<td>'. $row['date_fin'].'</td>';
                        echo '<td>'. $volume_horaire.'</td>';
                        echo '<td>'. $prix_unitaire.'</td>';
                        echo '<td>'. $total.'</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" align="right"><strong>Total à Payer :</strong></td>
                        <td><?php echo $total_a_payer; ?> FCFA</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
    function imprimerSection(id) {
        const section = document.getElementById(id);
        const originalContent = document.body.innerHTML;

        // Isoler le contenu de la section
        document.body.innerHTML = section.outerHTML;

        // Lancer l'impression
        window.print();

        // Restaurer le contenu original
        document.body.innerHTML = originalContent;
        location.reload(); // Recharger pour restaurer les scripts
    }
    </script>
</body>
</html>
<?php
    } else {
        echo "<p>Aucune information trouvée pour ce professeur.</p>";
    }
} else {
    echo "<p>Aucun ID de professeur spécifié.</p>";
}

include '../includes/footer.php';
?>
