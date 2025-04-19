<?php
include '../includes/connection.php';
include'../includes/sidebar_surv.php';
if (isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['statut'])  && isset($_POST['id_classe']) && isset($_POST['id_matiere']) && isset($_POST['id_professeur'])&& isset($_POST['nom_ecole'])) {
    $jour = $_POST['date_debut'];
    $heureDebut = $_POST['date_fin'];
    $heureFin = $_POST['statut'];
    $idClasse = $_POST['id_classe'];
    $idMatiere = $_POST['id_matiere'];
    $idProfesseur = $_POST['id_professeur'];
    $nom_ecole = $_POST['nom_ecole'];
    // Vérifier si le volume est inférieur ou égal à 40
  
        mysqli_query($db, "INSERT INTO pointage
            (id_pointage, date_debut, date_fin, statut, id_classe, id_matiere, id_professeur,nom_ecole)
            VALUES (Null,'$jour','$heureDebut','$heureFin','$idClasse','$idMatiere','$idProfesseur','$nom_ecole')");

        echo '<script type="text/javascript">window.location = "pointage_surv.php";</script>';
}

include '../includes/footer.php';
?>
