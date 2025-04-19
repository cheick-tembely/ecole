<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';
// Vérification si l'ID du livre est passé en paramètre
if (isset($_GET['id'])) {
    $id_livre = $_GET['id'];

    // Vérification de la disponibilité du livre avant de placer l'étudiant sur la liste d'attente
    $query_disponibilite = "SELECT date_retour FROM emprunts WHERE id_livre = $id_livre";
    $result_disponibilite = mysqli_query($db, $query_disponibilite);

    if ($result_disponibilite && mysqli_num_rows($result_disponibilite) > 0) {
        echo 'Le livre est déjà emprunté. Vous serez placé sur la liste d\'attente.';
        // Ajout de l'étudiant à la liste d'attente dans la table liste_attente
        $query_attente = "INSERT INTO liste_attente (id_livre, id_etudiant, date_demande) 
                          VALUES ($id_livre, $id_etudiant, NOW())"; // Supposons que vous ayez une variable $id_etudiant

        $result_attente = mysqli_query($db, $query_attente);

        if ($result_attente) {
            echo 'Vous avez été ajouté à la liste d\'attente.';
        } else {
            echo 'Erreur lors de l\'ajout à la liste d\'attente.';
        }
    } else {
        echo 'Le livre est disponible pour l\'emprunt actuellement.';
    }
} else {
    echo 'ID du livre non spécifié.';
}

// Inclusion du fichier de pied de page

