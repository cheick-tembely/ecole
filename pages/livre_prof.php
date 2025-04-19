<?php
// Inclusion des fichiers de connexion et de la barre latérale
include '../includes/connection.php';
include '../includes/sidebar_prof.php';

// Récupération de la liste des livres avec leur statut de disponibilité
$query_livres = "SELECT l.nom AS nom_livre, e.date_retour
                 FROM livre l
                 LEFT JOIN emprunts e ON l.id_livre = e.id_livre
                 WHERE l.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."' LIMIT 1)";


$result_livres = mysqli_query($db, $query_livres) or die(mysqli_error($db));

echo '<div class="table-responsive">';
echo '<table class="table table-bordered table-striped" id="livresTable" width="100%" cellspacing="0">';
echo '<thead>';
echo '<tr><th scope="col">Nom du Livre</th><th scope="col">Statut</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row_livre = mysqli_fetch_assoc($result_livres)) {
    $nom_livre = $row_livre['nom_livre']; // Nom du livre à afficher dans la table
    $date_retour = $row_livre['date_retour'];

    // Vérification de la disponibilité du livre en fonction de la date de retour
    $date_actuelle = date('Y-m-d');
    if ($date_retour != null && strtotime($date_retour) > strtotime($date_actuelle)) {
        $statut = 'Non disponible';
    } else {
        $statut = 'Disponible';
    }

    echo '<tr>';
    echo '<td>'. $nom_livre .'</td>';
    echo '<td>'. $statut .'</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Inclusion du fichier de pied de page

