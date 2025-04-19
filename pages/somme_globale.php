<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements

include '../includes/connection.php';
include '../includes/sidebar_compt.php';

// Modifier la requête SQL pour calculer la somme totale de total a payer de tous les professeurs
$query = "SELECT SUM(total) AS total_general FROM (
            SELECT SUM(10000 * TIMESTAMPDIFF(HOUR, p.date_debut, p.date_fin)) AS total
            FROM pointage p
            WHERE p.statut = 'non payé'
            GROUP BY p.id_professeur
          ) AS total_professeurs";

$result = mysqli_query($db, $query) or die(mysqli_error($db));

if ($row = mysqli_fetch_assoc($result)) {
    $total_general = $row['total_general'];
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary">Montant Total à Payer de Tous les Professeurs</h4>
        </div>
        <div class="card-body">
            <p>Le montant total à payer de tous les professeurs est de <?php echo $total_general; ?> FCFA</p>
        </div>
    </div>
<?php
} else {
    echo "<p>Aucune donnée disponible pour le moment.</p>";
}

include '../includes/footer.php';
?>
