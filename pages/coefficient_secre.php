<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';

// Inclure le contenu de la barre latérale pour les secrétaires
include '../includes/sidebar_secre.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Initialiser les variables pour les valeurs par défaut du formulaire
$classe = "";
$matiere = "";
$coefficient = "";
$volume = "";

// Message à afficher après soumission du formulaire
$message = "";

// Vérifier si le formulaire a été soumis pour insérer un coefficient
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["classe"]) && isset($_POST["matiere"]) && isset($_POST["coefficient"])&& isset($_POST["volume"])) {
    // Récupérer les données du formulaire
    $classe = $_POST["classe"];
    $matiere = $_POST["matiere"];
    $coefficient = $_POST["coefficient"];
    $volume = $_POST["volume"];
    $nom_ecole = $_POST["nom_ecole"];
   // Préparer la requête d'insertion
$requete = $db->prepare("INSERT INTO coefficient (classe, matiere, coefficient, volume,nom_ecole) VALUES ( ?, ?, ?, ?, ?)");

// Vérifier si la requête est prête
if ($requete) {
    // Binder les paramètres à la requête
    $requete->bind_param("ssiss", $classe, $matiere, $coefficient, $volume, $nom_ecole);

        
        // Exécuter la requête
        if ($requete->execute()) {
            $message = '<div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px;">Coefficient inséré avec succès.</div>';
            
            // Réinitialiser les valeurs des champs du formulaire
            $classe = "";
            $matiere = "";
            $coefficient = "";
            $volume="";
        } else {
            $message = '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px;">Erreur lors de l\'insertion du coefficient : ' . $requete->error . '</div>';
        }
        
        // Fermer la requête
        $requete->close();
    } else {
        $message = '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px;">Erreur lors de la préparation de la requête : ' . $db->error . '</div>';
    }
}

// Afficher le formulaire HTML pour enregistrer les coefficients
echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement des coefficients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f7f7f7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enregistrement des coefficients</h1>
        $message
        <form action="coefficient_secre.php" method="POST">
            <div class="form-group">
                <label for="classe">Classe:</label>
                <input type="text" id="classe" name="classe" value="$classe" required>
            </div>
            <div class="form-group">
                <label for="matiere">Matière:</label>
                <input type="text" id="matiere" name="matiere" value="$matiere" required>
            </div>
            <div class="form-group">
                <label for="coefficient">Coefficient:</label>
                <input type="number" id="coefficient" name="coefficient" value="$coefficient" min="0" step="0.1" required>
            </div>
            <div class="form-group">
                <label for="volume">Volume/Semaine:</label>
                <input id="coefficient" name="volume" value="$volume" min="0" step="0.1" required>
            </div>
            <div class="form-group">
                <label for="nom_ecole">Nom Ecole:</label>
                <input id="nom_ecole" name="nom_ecole" value=" $nom_ecole" required readonly>
            </div>
        
            <div class="form-group">
                <input type="submit" value="Enregistrer">
            </div>
        </form>

        <h2>Liste des coefficients enregistrés :</h2>
        <table border="1">
            <tr>
                <th>Classe</th>
                <th>Matière</th>
                <th>Coefficient</th>
                <th>Volume/Semaine</th>
               
            </tr>
HTML;

// Sélectionner tous les coefficients de la base de données
$resultat = $db->query('SELECT * FROM coefficient ');

// Vérifier si des résultats sont retournés
if ($resultat && $resultat->num_rows > 0) {
    // Afficher le tableau des coefficients
    while ($row = $resultat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["classe"] . '</td>';
        echo '<td>' . $row["matiere"] . '</td>';
        echo '<td>' . $row["coefficient"] . '</td>';
        echo '<td>' . $row["volume"] . '</td>';
      
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="3">Aucun coefficient trouvé.</td></tr>';
}

// Fermer la balise table et le reste du code HTML
echo '</table></div></body></html>';

// Fermer la connexion à la base de données (à placer à la fin de votre script)
$db->close();
?>
<?php
include '../includes/footer.php';
?>
