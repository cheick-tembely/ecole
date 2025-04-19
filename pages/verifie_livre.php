<?php
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';

// Récupération de la valeur de recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Requête SQL pour récupérer la liste des livres en fonction de la recherche
$query_livres = "SELECT e.*, l.nom AS nom_livre, e.date_retour, l.nom 
                 FROM emprunts e
                 RIGHT JOIN livre l ON e.id_livre = l.id_livre
                 WHERE l.nom LIKE '%$search%' and e.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')and l.champ_visible=1 "; // Filtrage par nom du livre

$result_livres = mysqli_query($db, $query_livres) or die(mysqli_error($db));

echo '<form method="GET" action="">';
echo '<input type="text" name="search" placeholder="Rechercher un livre" value="' . htmlentities($search) . '">';
echo '<input type="submit" value="Rechercher">';
echo '</form>';

echo '<table class="table table-bordered" id="livresTable" width="100%" cellspacing="0">';
echo '<thead><tr><th>Nom du Livre</th><th>Statut</th></tr></thead>';
echo '<tbody>';

while ($row_livre = mysqli_fetch_assoc($result_livres)) {
    $id_livre = $row_livre['id_livre'];
    $nom_livre = $row_livre['nom_livre']; // Nom du livre à afficher dans la table
    $date_retour = $row_livre['date_retour'];
    $date_emprunt = $row_livre['date_emprunt']; // Date d'emprunt du livre

    // Vérification de la disponibilité du livre en fonction de la date d'emprunt et de retour
    if ($date_emprunt == null || strtotime($date_retour) <= strtotime(date('Y-m-d'))) {
        $statut = 'Disponible';
    } else {
        $statut = 'Non disponible';
    }

    echo '<tr>';
    echo '<td>'. $nom_livre .'</td>';
    echo '<td>'. $statut .'</td>';
    echo '</tr>';
}

echo '</tbody></table>';


