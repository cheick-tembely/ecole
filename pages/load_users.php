<?php
include '../includes/connection.php';


// Vérifier si le paramètre de requête "school" est présent
if (isset($_GET['school'])) {
    $schoolName = $_GET['school'];

    // Requête pour sélectionner tous les utilisateurs de l'école avec leur niveau
    $query = "SELECT u.*, n.niveau AS niveau
              FROM utilisateur u
              INNER JOIN niveau n ON u.id_niveau = n.id_niveau 
              WHERE u.nom_ecole = '$schoolName'";
    $result = mysqli_query($db, $query);

    // Vérifier si la requête a réussi
    if ($result && mysqli_num_rows($result) > 0) {
        // Début du tableau HTML
        echo '<h2>Liste des utilisateurs de ' . $schoolName . '</h2>';
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nom</th>';
        echo '<th>Prénom</th>';
        echo '<th>Niveau</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Affichage des utilisateurs dans une liste avec leur niveau
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['nom_user'] . '</td>';
            echo '<td>' . $row['prenom_user'] . '</td>';
            echo '<td>' . $row['niveau'] . '</td>'; // Utilisation de l'alias 'niveau'
            echo '</tr>';
        }

        // Fin du tableau HTML
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo 'Aucun utilisateur trouvé pour cette école.';
    }
} else {
    echo 'Paramètre de requête "school" manquant.';
}

// Fermer la connexion à la base de données
mysqli_close($db);
?>
