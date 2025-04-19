<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_compt.php';

$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Vérifier si le formulaire de recherche a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom"]) && isset($_POST["prenom"])) {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    // Préparer la requête de recherche
    $requete = $db->prepare("SELECT * FROM etudiant WHERE nom = ? AND prenom = ? 
    AND nom_ecole = (SELECT nom_ecole 
                     FROM utilisateur 
                     WHERE nom_user = '".$_SESSION['nom_user']."' 
                     AND prenom_user = '".$_SESSION['prenom_user']."' LIMIT 1) 
    AND champ_visible = 1");

    
    // Vérifier si la requête est prête
    if ($requete) {
        // Binder les paramètres à la requête
        $requete->bind_param("ss", $nom, $prenom);
        
        // Exécuter la requête
        $requete->execute();

        // Récupérer le résultat de la requête
        $resultat = $requete->get_result();

        // Vérifier s'il y a des résultats
        if ($resultat->num_rows > 0) {
            echo '<div class="container">';
            echo '<h2>Résultats de la recherche :</h2>';
            echo '<ul>';
            while ($row = $resultat->fetch_assoc()) {
                echo '<li><a href="enregistrer_scolarite.php?id=' . $row["id_etudiant"] . '">' . $row["nom"] . ' ' . $row["prenom"] . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo '<div class="container">';
            echo '<p>Aucun étudiant trouvé avec ce nom et prénom.</p>';
            echo '</div>';
        }

        // Fermer le résultat de la requête
        $resultat->close();
    } else {
        echo '<div class="container">';
        echo '<p>Erreur lors de la préparation de la requête : ' . $db->error . '</p>';
        echo '</div>';
    }

    // Fermer la requête
    $requete->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1, h2, p {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Recherche d'étudiant</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <input type="submit" value="Rechercher">
    </form>
</body>
</html>
