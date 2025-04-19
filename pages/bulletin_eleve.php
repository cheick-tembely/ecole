<?php
session_start(); // Démarrez la session avant d'accéder à $_SESSION

include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Vérifiez si $_SESSION['nom'] et $_SESSION['prenom'] sont définis pour l'étudiant connecté
if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
    // Récupérer les informations de l'étudiant connecté
    $query_etudiant = "SELECT * FROM etudiant WHERE nom = '".$_SESSION['nom']."' AND prenom = '".$_SESSION['prenom']."'";
    $result_etudiant = mysqli_query($db, $query_etudiant) or die(mysqli_error($db));
    $row_etudiant = mysqli_fetch_assoc($result_etudiant);

    // Vérifier si des résultats ont été retournés pour l'étudiant
    if ($row_etudiant) {
        // Affichage des informations de l'étudiant dans un tableau
        echo '<div class="container-fluid">'; // Ajout d'un conteneur fluide
        echo '<div class="card shadow mb-4">';
        echo '<div class="card-header py-3">';
        echo '<h4 class="m-2 font-weight-bold text-primary">Vos Informations</h4>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered" id="dataTable" style="width: 100%;">'; // Style pour occuper 100% de la largeur
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nom</th>';
        echo '<th>Prénom</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        echo '<tr>';
        echo '<td>' . $row_etudiant['nom'] . '</td>';
        echo '<td>' . $row_etudiant['prenom'] . '</td>';
        echo '<td><a href="bulletin_scolaire_eleve.php?id_etudiant=' . $row_etudiant['id_etudiant'] . '" class="btn btn-info btn-sm">Voir le Bulletin Scolaire</a></td>';
        echo '</tr>';
        
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning">Aucune information trouvée pour cet étudiant.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Session non définie pour l\'étudiant connecté.</div>';
}
?>
