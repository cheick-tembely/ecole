<?php
include '../includes/connection.php';

if (
    isset($_POST['heure_debut']) &&
    isset($_POST['heure_fin']) &&
    isset($_POST['jour']) &&
    isset($_POST['matiere']) &&
    isset($_POST['id_professeur']) &&
    isset($_POST['volume']) &&
    isset($_POST['classe']) &&
    isset($_POST['nom_ecole']) // Ajouter l'attribut nom_ecole dans la vérification des champs
) {
    $heuresDebut = $_POST['heure_debut'];
    $heuresFin = $_POST['heure_fin'];
    $jours = $_POST['jour'];
    $matieres = $_POST['matiere'];
    $idProfesseur = $_POST['id_professeur'];
    $volumes = $_POST['volume']; // Volume horaire pour chaque classe
    $classes = explode(',', $_POST['classe']);
    $nomEcole = $_POST['nom_ecole']; // Récupérer le nom de l'école


            // Insérer les données dans la base de données pour cet ensemble de données
            mysqli_query($db, "INSERT INTO attribution (id_attribution, jour, heure_debut, heure_fin, volume, classe, matiere, id_professeur, nom_ecole)
                VALUES (NULL, '$jour', '$heureDebut', '$heureFin', '$volume', '$classe', '$matiere', '$idProfesseur', '$nomEcole')");
        }

        // Rediriger vers une page de confirmation ou afficher un message de succès
        echo '<script type="text/javascript">window.location = "attri_admin.php";</script>';

?>
