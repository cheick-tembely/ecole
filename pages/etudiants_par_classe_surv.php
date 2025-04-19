<?php
// Inclure les fichiers de connexion et l'en-tête
include '../includes/connection.php';
include '../includes/sidebar_surv.php';

// Vérifier si l'ID de la classe est passé dans l'URL
if (isset($_GET['classe_id'])) {
    $classe_id = $_GET['classe_id'];

    // Récupérer les informations de la classe
    $query = "SELECT code_classe FROM classe WHERE id_classe = '$classe_id' AND nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')and champ_visible=1 ";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    $nom_classe = $row['code_classe'];

    // Afficher le nom de la classe
    echo '<h2>Liste des étudiants inscrits dans la classe '.$nom_classe.'</h2>';

    // Récupérer et afficher les étudiants de la classe choisie
    $query_etudiants = "SELECT * FROM etudiant WHERE classe = '$nom_classe' and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
    $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));

    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    // Ajouter d'autres colonnes si nécessaire
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row_etudiant = mysqli_fetch_assoc($result_etudiants)) {
        echo '<tr>';
        echo '<td>'.$row_etudiant['nom'].'</td>';
        echo '<td>'.$row_etudiant['prenom'].'</td>';
        // Ajouter d'autres colonnes si nécessaire
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    // Rediriger si l'ID de la classe n'est pas spécifié dans l'URL
    header('Location: liste_classes_surv.php');
    exit();
}

// Inclure le pied de page
include '../includes/footer.php';
?>
