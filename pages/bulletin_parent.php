<?php
include '../includes/connection.php';
include '../includes/sidebar_parent.php';

// Vérifier si un utilisateur est connecté (assurez-vous d'avoir cette vérification)

// Récupérer le nom et le prénom du parent connecté
$nom_parent = $_SESSION['nom_user'];
$prenom_parent = $_SESSION['prenom_user'];

// Requête pour récupérer les informations de l'étudiant associé au parent connecté
$query_etudiant = "SELECT id_etudiant, nom, prenom, classe FROM etudiant WHERE nom_tuteur = '$nom_parent' AND prenom_tuteur = '$prenom_parent' and champ_visible=1";
$result_etudiant = mysqli_query($db, $query_etudiant) or die(mysqli_error($db));

// Vérifier si des résultats ont été retournés
if ($result_etudiant && mysqli_num_rows($result_etudiant) > 0) {
    // Affichage de la liste des étudiants associés au parent
    echo '<div class="card shadow mb-4">';
    echo '<div class="card-header py-3">';
    echo '<h4 class="m-2 font-weight-bold text-primary">Liste des Enfants</h4>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Classe</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row_etudiant = mysqli_fetch_assoc($result_etudiant)) {
        echo '<tr>';
        echo '<td>' . $row_etudiant['nom'] . '</td>';
        echo '<td>' . $row_etudiant['prenom'] . '</td>';
        echo '<td>' . $row_etudiant['classe'] . '</td>';
        // Ajout d'un lien pour afficher le bulletin scolaire de chaque étudiant
        echo '<td><a href="afficher_bulletin.php?id_etudiant=' . $row_etudiant['id_etudiant'] . '" class="btn btn-primary">Voir Bulletin</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'Aucun étudiant trouvé pour ce parent.';
}

include '../includes/footer.php';
?>
