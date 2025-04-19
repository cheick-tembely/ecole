<?php
include '../includes/connection.php';

if (isset($_POST['id_professeur']) && isset($_POST['id_classe']) && isset($_POST['id_matiere'])) {
    $id_professeur = mysqli_real_escape_string($db, $_POST['id_professeur']);
    $id_classe = mysqli_real_escape_string($db, $_POST['id_classe']);
    $id_matiere = mysqli_real_escape_string($db, $_POST['id_matiere']);

    // Récupérer le nom de l'école à partir de la session utilisateur
    $nom_ecole = mysqli_real_escape_string($db, $_POST['nom_ecole']);

    // Insérer dans la table attribution_programme
    mysqli_query($db, "INSERT INTO attribution_programme (id_attribution, id_professeur, id_classe, id_matiere, nom_ecole)
        VALUES (Null, '$id_professeur', '$id_classe', '$id_matiere', '$nom_ecole')");

    echo '<script type="text/javascript">window.location = "programme_cens.php";</script>';
}
include '../includes/footer.php';
?>
