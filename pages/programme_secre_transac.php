<?php
include '../includes/connection.php';

if (isset($_POST['contenu']) && isset($_POST['horaire_hebdomadaire']) && isset($_POST['coeficient']) && isset($_POST['annee_scolaire']) && isset($_POST['id_classe']) && isset($_POST['id_matiere'])&& isset($_POST['nom_ecole'])) {
    // Échapper les apostrophes dans les données du formulaire
    $jour = mysqli_real_escape_string($db, $_POST['contenu']);
    $heureDebut = mysqli_real_escape_string($db, $_POST['horaire_hebdomadaire']);
    $heureFin = mysqli_real_escape_string($db, $_POST['coeficient']);
    $volume = mysqli_real_escape_string($db, $_POST['annee_scolaire']);
    $idClasse = mysqli_real_escape_string($db, $_POST['id_classe']);
    $idMatiere = mysqli_real_escape_string($db, $_POST['id_matiere']);
    $competence = mysqli_real_escape_string($db, $_POST['competence']);
    $composante = mysqli_real_escape_string($db, $_POST['composante']);
    $manifestation = mysqli_real_escape_string($db, $_POST['manifestation']);
    $trimestre = mysqli_real_escape_string($db, $_POST['trimestre']);
    $nom_ecole = mysqli_real_escape_string($db, $_POST['nom_ecole']);
    // Vérifier si le volume est inférieur ou égal à 40
   
        mysqli_query($db, "INSERT INTO programme
            (id_programme, contenu, horaire_hebdomadaire, coeficient, annee_scolaire, id_classe, id_matiere, competence,composante,manifestation,trimestre,nom_ecole)
            VALUES (Null,'$jour','$heureDebut','$heureFin','$volume','$idClasse','$idMatiere','$competence','$composante','$manifestation','$trimestre','$nom_ecole')");

        echo '<script type="text/javascript">window.location = "programme_secre.php";</script>';
}
include '../includes/footer.php';
?>
