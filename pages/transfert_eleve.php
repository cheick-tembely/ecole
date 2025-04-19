<?php
// Inclusion du fichier de connexion à la base de données
session_start();
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

$nom = "";
$prenom = "";
$error = "";
$success = "";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ancienne_ecole = $_POST['ancienne_ecole'];
    $nouvelle_ecole = $_POST['nouvelle_ecole'];
    $motif = $_POST['motif'];

    // Validation des données (vous pouvez ajouter d'autres validations selon vos besoins)
    if (empty($nom) || empty($prenom) || empty($ancienne_ecole) || empty($nouvelle_ecole) || empty($motif)) {
        // Affiche un message d'erreur si des champs sont vides
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Requête SQL pour insérer les données dans la table de transfert
        $sql = "INSERT INTO transfert_ecole (nom, prenom, ancienne_ecole, nouvelle_ecole, motif) 
                VALUES ('$nom', '$prenom', '$ancienne_ecole', '$nouvelle_ecole', '$motif')";

        // Exécute la requête en utilisant la variable de connexion $db
        if (mysqli_query($db, $sql)) {
            $success = "Formulaire de transfert soumis avec succès.";
        } else {
            $error = "Erreur lors de la soumission du formulaire : " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Transfert d'École</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulaire de Transfert d'École</h2>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <?php if (!empty($success)) { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>
            </div>
            <div class="form-group">
                <label for="ancienne_ecole">Ancienne École :</label>
                <input type="text" id="ancienne_ecole" name="ancienne_ecole" required>
            </div>
            <div class="form-group">
                <label for="nouvelle_ecole">Nouvelle École :</label>
                <input type="text" id="nouvelle_ecole" name="nouvelle_ecole" required>
            </div>
            <div class="form-group">
                <label for="motif">Motif du Transfert :</label>
                <textarea id="motif" name="motif" required></textarea>
            </div>
            <input type="submit" value="Soumettre">
        </form>
    </div>
</body>
</html>
