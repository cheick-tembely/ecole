<?php
include '../includes/connection.php';

if (isset($_POST['titre']) && isset($_POST['activite']) && isset($_POST['duree']) && isset($_POST['competence']) && isset($_POST['id_classe']) && isset($_POST['id_matiere']) && isset($_POST['id_professeur'])&& isset($_POST['nom_ecole'])) {
    $jour =mysqli_real_escape_string($db, $_POST['titre']);
    $heureDebut = mysqli_real_escape_string($db, $_POST['activite']);
    $heureFin = mysqli_real_escape_string($db, $_POST['duree']);
    $volume =mysqli_real_escape_string($db, $_POST['competence']);
    $domaine = mysqli_real_escape_string($db, $_POST['domaine']);
    $annee =mysqli_real_escape_string($db, $_POST['annee_scolaire']);
    $idClasse = mysqli_real_escape_string($db, $_POST['id_classe']);
    $idMatiere= mysqli_real_escape_string($db, $_POST['id_matiere']);
    $idProfesseur= mysqli_real_escape_string($db, $_POST['id_professeur']);
    $nom_ecole= mysqli_real_escape_string($db, $_POST['nom_ecole']);
    // Vérifier si le volume est inférieur ou égal à 40
  
        mysqli_query($db, "INSERT INTO fiche_sequence
            (id_fiche, titre, activite, duree, competence,domaine,annee_scolaire, id_classe, id_matiere, id_professeur,nom_ecole)
            VALUES (Null,'$jour','$heureDebut','$heureFin','$volume','$domaine','$annee','$idClasse','$idMatiere','$idProfesseur','$nom_ecole')");

        echo '<script type="text/javascript">window.location = "fiche_sequence_prof.php";</script>';
}

include '../includes/footer.php';
?>
