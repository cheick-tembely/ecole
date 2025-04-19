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
    $sql = "SELECT * FROM eleves WHERE classe = ?";

    // Préparer et exécuter la requête
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $classe);
    $stmt->execute();

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier s'il y a des élèves dans la classe sélectionnée
    if ($result->num_rows > 0) {
        // Inclure les styles pour le format de carte scolaire
        echo "<style>
                .school-card {
                    width: 350px;
                    height: 220px;
                    border: 2px solid #333;
                    border-radius: 10px;
                    padding: 15px;
                    margin: 15px auto;
                    font-family: Arial, sans-serif;
                    position: relative;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    background: #f9f9f9;
                }
                .school-card-header {
                    text-align: center;
                    font-weight: bold;
                    font-size: 16px;
                    margin-bottom: 20px; /* Ajout d'espace en bas */
                    color: #0056b3;
                }
                .profile-image {
                    width: 80px;
                    height: 80px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #333;
                    position: absolute;
                    top: 50px; /* Ajustement de l'espacement pour éviter le chevauchement */
                    left: 15px;
                }
                .student-info {
                    margin-left: 110px;
                    margin-top: 10px; /* Alignement vertical avec la photo */
                    font-size: 14px;
                    line-height: 1.6;
                }
                .school-footer {
                    text-align: center;
                    font-size: 12px;
                    color: #555;
                    position: absolute;
                    bottom: 10px;
                    width: 100%;
                }
              </style>";

        echo "<a href='profil_surv.php' class='btn btn-primary'>Retourner vers la page de profil du surveillant</a>";
        echo "<div class='container d-flex flex-wrap justify-content-center mt-4'>"; // Conteneur pour les cartes scolaires

        while($row = $result->fetch_assoc()) {
            // Créer la carte scolaire pour chaque élève
            echo "<div class='school-card'>";
            echo "<div class='school-card-header'>ECOLE-GEST - Carte Scolaire</div>";
            echo "<img class='profile-image' src='" . $row['photo'] . "' alt='Photo de l\'élève'>";
            echo "<div class='student-info'>";
            echo "<p><strong>Nom :</strong> " . $row['nom'] . "</p>";
            echo "<p><strong>Prénom :</strong> " . $row['prenom'] . "</p>";
            echo "<p><strong>Classe :</strong> " . $row['classe'] . "</p>";
            echo "<p><strong>Année Scolaire :</strong> " . $row['annee_scolaire'] . "</p>";
            echo "</div>";
            echo "<div class='school-footer'>Carte émise par l'administration</div>";
            echo "</div>";
        }

        echo "</div>"; // Fermeture du conteneur des cartes
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
