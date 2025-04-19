<?php
include '../includes/connection.php';

if (isset($_POST['jour']) && isset($_POST['heure_debut']) && isset($_POST['heure_fin']) && isset($_POST['volume']) && isset($_POST['id_classe']) && isset($_POST['id_matiere']) && isset($_POST['id_professeur'])) {
    $jour = $_POST['jour'];
    $heureDebut = $_POST['heure_debut'];
    $heureFin = $_POST['heure_fin'];
    $volume = $_POST['volume'];
    $idClasse = $_POST['id_classe'];
    $idMatiere = $_POST['id_matiere'];
    $idProfesseur = $_POST['id_professeur'];
    $nom_ecole = $_POST['nom_ecole'];
    // Vérifier si le volume est inférieur ou égal à 40
    if ($volume <= 40) {
        mysqli_query($db, "INSERT INTO attribution
            (id_attribution, jour, heure_debut, heure_fin, volume, id_classe, nom_ecole, id_matiere, id_professeur)
            VALUES (Null,'$jour','$heureDebut','$heureFin','$volume','$idClasse', '$nom_ecole','$idMatiere','$idProfesseur')");

        echo '<script type="text/javascript">window.location = "attri_admin.php";</script>';
    } else {
        echo '<p>Le volume doit être inférieur ou égal à 40. Veuillez revenir en arrière et corriger la saisie.</p>';
        echo '<script type="text/javascript">window.location = "attri_admin.php";</script>';
    }
} else {
    echo '<p>Il manque certaines valeurs du formulaire. Veuillez revenir en arrière et remplir tous les champs.</p>';
    echo '<script type="text/javascript">window.location = "attri_admin.php";</script>';
}

include '../includes/footer.php';
?>
