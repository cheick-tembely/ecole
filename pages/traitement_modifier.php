<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';

// Vérification si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $id_commande = $_POST['id_commande'];
    $id_livre = $_POST['id_livre'];
    $nom_emprunteur = $_POST['nom_emprunteur'];
    $prenom_emprunteur = $_POST['prenom_emprunteur'];
 
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];
    $nom_ecole = $_POST['nom_ecole'];
    // Préparation de la requête d'insertion dans la table emprunts
    $query_insert_emprunts = "INSERT INTO commande_emprunt (id_commande, id_livre, nom_emprunteur, prenom_emprunteur,  date_emprunt, date_retour,nom_ecole) 
                              VALUES ('$id_commande', '$id_livre', '$nom_emprunteur', '$prenom_emprunteur',  '$date_emprunt', '$date_retour', '$nom_ecole')";

    // Exécution de la requête d'insertion
    $result_insert_emprunts = mysqli_query($db, $query_insert_emprunts);

    if ($result_insert_emprunts) {
        // Redirection vers la page de modification de commande avec succès
        header("Location: modifier_commande.php?success=1");
        exit;
    } else {
        // Redirection vers la page de modification de commande avec erreur
        header("Location: modifier_commande.php?error=1");
        exit;
    }
} else {
    // Redirection vers une page d'erreur si le formulaire n'a pas été soumis correctement
    header("Location: erreur.php");
    exit;
}
?>
