<?php
include '../includes/connection.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['nom'];
    $genre = $_POST['genre'];
    $auteur = $_POST['auteur'];
    $annee = $_POST['annee'];

    // Préparation de la requête d'insertion
    $query = "INSERT INTO livre (id_livre, nom, genre, auteur, annee)
              VALUES (NULL, '$fname', '$genre', '$auteur', '$annee')";

    // Exécution de la requête
    if (mysqli_query($db, $query)) {
        // Redirection vers la page livre.php après l'insertion réussie
        header('location: livre.php');
        exit; // Important pour arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur lors de l'insertion du livre: " . mysqli_error($db);
    }
}
?>
