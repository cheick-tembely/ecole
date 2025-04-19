<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "ecole-gest");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
}

// Vérifier si la classe a été sélectionnée dans le formulaire
if(isset($_GET['classe']) && isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    // Récupérer la classe sélectionnée depuis le formulaire
    $classe = $_GET['classe'];



    // Préparer la requête SQL pour récupérer les élèves de la classe sélectionnée
    $sql = "SELECT * FROM eleves WHERE classe = ? and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";

    // Préparer et exécuter la requête
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $classe);
    $stmt->execute();

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier s'il y a des élèves dans la classe sélectionnée
    if ($result->num_rows > 0) {
        // Afficher les profils des élèves
        echo "<style>";
        echo ".profile-image { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; }";
        echo "</style>";
        echo "<a href='profil_cens.php' class='btn btn-primary'>Retourner vers la page de profil du censeur</a>";
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<img class='profile-image' src='" . $row['photo'] . "' alt='Photo de l\'élève'>";
            echo "<h3>Profil de " . $row['prenom'] . " " . $row['nom'] . "</h3>";
            echo "<p><strong>Nom :</strong> " . $row['nom'] . "</p>";
            echo "<p><strong>Prénom :</strong> " . $row['prenom'] . "</p>";
            echo "<p><strong>Classe :</strong> " . $row['classe'] . "</p>";
            echo "<p><strong>Année Scolaire :</strong> " . $row['annee_scolaire'] . "</p>";
            echo "</div>";
        }
    } else {
        // Aucun élève trouvé dans la classe sélectionnée
        echo "Aucun élève trouvé dans la classe sélectionnée.";
    }

    // Fermer la requête et la connexion à la base de données
    $stmt->close();
    $mysqli->close();
} else {
    // Rediriger vers la page de sélection de classe si aucune classe n'est sélectionnée
    header("Location: index.php");
    exit();
}
?>
