<?php
include '../includes/connection.php';

if (isset($_POST['jour']) && isset($_POST['heure_debut']) && isset($_POST['heure_fin']) && isset($_POST['annee_scolaire']) && isset($_POST['id_classe']) && isset($_POST['id_matiere']) && isset($_POST['id_professeur'])) {
    $jour = $_POST['jour'];
    $heureDebut = $_POST['heure_debut'];
    $heureFin = $_POST['heure_fin'];
    $volume = $_POST['annee_scolaire'];
    $idClasse = $_POST['id_classe'];
    $idMatiere = $_POST['id_matiere'];
    $idProfesseur = $_POST['id_professeur'];

    // Récupérer le nom de l'école à partir de la session utilisateur
    $nomEcole = $_POST['nom_ecole'];

    // Vérifier si le volume est inférieur ou égal à 40
    if ($volume <= 40) {
        mysqli_query($db, "INSERT INTO emploi
            (id_emploi, jour, heure_debut, heure_fin, annee_scolaire, id_classe, id_matiere, id_professeur, nom_ecole)
            VALUES (Null,'$jour','$heureDebut','$heureFin','$volume','$idClasse','$idMatiere','$idProfesseur','$nomEcole')");

        echo '<script type="text/javascript">window.location = "emploi_du_temp_provi.php";</script>';
    } else {
        echo "Le volume doit être inférieur ou égal à 40.";
    }
}

include '../includes/footer.php';
?>
