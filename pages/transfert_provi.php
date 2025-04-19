<?php
include '../includes/connection.php';
include '../includes/sidebar_provi.php';

// Requête SQL pour récupérer la liste des transferts
$query = "SELECT * FROM transfert_ecole";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='card shadow mb-4'>";
    echo "<div class='card-header py-3'>";
    echo "<h4 class='m-2 font-weight-bold text-primary'>Liste des Transferts d'École</h4>";
    echo "</div>";
    echo "<div class='card-body'>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Ancienne École</th>";
    echo "<th>Nouvelle École</th>";
    echo "<th>Motif</th>";

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['ancienne_ecole'] . "</td>";
        echo "<td>" . $row['nouvelle_ecole'] . "</td>";
        echo "<td>" . $row['motif'] . "</td>";
       
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Aucun transfert trouvé.";
}

mysqli_close($db);

include '../includes/footer.php';

?>
