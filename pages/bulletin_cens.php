<?php
include '../includes/connection.php';
include '../includes/sidebar_cens.php';

// Vérifier si l'identifiant de classe est passé en paramètre
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];

    // Récupérer les informations de la classe
    $query_classe = "SELECT code_classe FROM classe WHERE id_classe = $class_id and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')";
    $result_classe = mysqli_query($db, $query_classe) or die(mysqli_error($db));
    $row_classe = mysqli_fetch_assoc($result_classe);
    $nom_classe = $row_classe['code_classe'];

    echo '<h2>Bulletin Scolaire des étudiants inscrits dans la classe ' . $nom_classe . '</h2>';

    // Récupérer et afficher les étudiants de la classe choisie
    $query_etudiants = "SELECT * FROM etudiant WHERE classe = '$nom_classe' and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')";
    $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));

    // Affichage des étudiants dans une table
    echo '<div class="card shadow mb-4">';
    echo '<div class="card-header py-3">';
    echo '<h4 class="m-2 font-weight-bold text-primary">Liste des Étudiants</h4>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead>';
    echo '<tr>';
    
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row_student = mysqli_fetch_assoc($result_etudiants)) {
        echo '<tr>';

        echo '<td>' . $row_student['nom'] . '</td>';
        echo '<td>' . $row_student['prenom'] . '</td>';
        echo '<td><a href="bulletin_scolaire.php?id_etudiant=' . $row_student['id_etudiant'] . '">Bulletin Scolaire</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'Aucune classe sélectionnée.';
}

include '../includes/footer.php';
?>
