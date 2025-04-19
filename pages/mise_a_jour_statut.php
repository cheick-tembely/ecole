<?php
// Assurez-vous d'inclure votre fichier de connexion à la base de données
include '../includes/connection.php';

// Code pour mettre à jour le statut dans la base de données
$query = "UPDATE pointage SET statut = 'Payer'";
$result = mysqli_query($db, $query);

if ($result) {
    // Si la mise à jour a réussi, retourner une réponse réussie
    echo "Mise à jour réussie";
} else {
    // Si la mise à jour a échoué, retourner une réponse d'erreur
    echo "Erreur lors de la mise à jour";
}

// Fermer la connexion à la base de données si nécessaire
mysqli_close($db);
?>
