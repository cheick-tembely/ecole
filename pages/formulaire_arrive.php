<?php
session_start();
include '../includes/connection.php'; // Inclure le fichier de connexion à la base de données

// Traitement d'insertion des données dans la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $classe = $_POST['classe'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $nom_ecole = $_POST['nom_ecole'];

    // Préparer la requête SQL d'insertion
    $query = "INSERT INTO arrivee_professeur (nom, prenom, date, classe, heure_arrivee, nom_ecole) 
              VALUES ('$nom', '$prenom', '$date', '$classe', '$heure_arrivee', '$nom_ecole')";

    // Exécuter la requête SQL
    if (mysqli_query($db, $query)) {
        echo '<div style="color: green;">Enregistrement ajouté avec succès.</div>';
    } else {
        echo '<div style="color: red;">Erreur lors de l\'ajout de l\'enregistrement : ' . mysqli_error($db) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOLE-GEST</title>
    <!-- Style CSS pour le formulaire -->
    <style>
        /* Style du formulaire */
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Formulaire d'insertion -->
    <h2>Fiche de Presence des Professeurs</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required><br>

        <label for="classe">Classe :</label>
        <input type="text" id="classe" name="classe" required><br>

        <label for="heure_arrivee">Heure d'arrivée :</label>
        <input type="time" id="heure_arrivee" name="heure_arrivee" required><br>
        <label for="nom_ecole">Ecole:</label>
        <input type="text" id="nom_ecole" name="nom_ecole" required><br>
        <input type="submit" value="Ajouter">
    </form>

</body>
</html>
