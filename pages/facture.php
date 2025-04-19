<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements

include '../includes/connection.php';
include '../includes/sidebar.php';

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
        <div class="invoice">
            <div class="invoice-header">
                <h2>Facture</h2>
                <div class="invoice-details">
                    <p><strong>Professeur:</strong> <?php echo $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur']; ?></p>
                    <a href="fpdf/prof_print.php?id=<?php echo $id_professeur; ?>" class="btn btn-primary bg-gradient-primary">Télécharger EXCEL</a>
                </div>
            </div>
            <div class="invoice-table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Matière</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Volume horaire</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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

                            echo '<tr>';
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
<?php
    } else {
        echo "<p>Aucune information trouvée pour ce professeur.</p>";
    }
} else {
    echo "<p>Aucun ID de professeur spécifié.</p>";
}

include '../includes/footer.php';
?>
