<?php
// Démarre la mise en mémoire tampon
ob_start();

// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

$nom = "";
$prenom = "";

// Vérification si les données ont été soumises via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs saisies dans le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_tuteur = $_POST['nom_tuteur'];
    $prenom_tuteur = $_POST['prenom_tuteur'];
    $telephone_tuteur = $_POST['telephone_tuteur'];

    // Requête SQL pour vérifier si l'élève existe dans la base de données
    $query = "SELECT * FROM etudiant WHERE nom = '$nom' AND prenom = '$prenom' AND nom_tuteur = '$nom_tuteur' AND prenom_tuteur = '$prenom_tuteur' AND telephone_tuteur = '$telephone_tuteur'";
    $result = mysqli_query($db, $query);

    // Vérification si la requête a retourné au moins une ligne (correspondance trouvée)
    if (mysqli_num_rows($result) > 0) {
        // L'élève existe, affichage de ses informations
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
    } else {
        // Aucune correspondance trouvée, affichage d'un message d'erreur et redirection
        echo "<div class='alert alert-danger text-center'>Aucun élève trouvé avec ce nom et prénom.</div>";
        header("Location: eleve_login.php");
        exit;
    }
} else {
    // Redirection si les données n'ont pas été soumises via POST
    header("Location: eleve_login.php");
    exit;
}

// Vide le tampon et envoie la sortie au navigateur
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Élève</title>
    <!-- Inclusion de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .card-body {
            background-color: #f8f9fa;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Barre de navigation avec le bouton de déconnexion -->


<!-- Contenu principal -->
<div class="container">
    <h2 class="text-center text-primary font-weight-bold">Bonjour <?php echo $row['prenom']; ?> <?php echo $row['nom']; ?> !</h2>

    <div class="card">
        <div class="card-header">
            Vos Informations
        </div>
        <div class="card-body">
            <p><strong>Classe:</strong> <?php echo $row['classe']; ?></p>
            <p><strong>Téléphone:</strong> <?php echo $row['telephone']; ?></p>
            <p><strong>Nom Tuteur:</strong> <?php echo $row['nom_tuteur']; ?></p>
            <p><strong>Prénom Tuteur:</strong> <?php echo $row['prenom_tuteur']; ?></p>
            <p><strong>Téléphone Tuteur:</strong> <?php echo $row['telephone_tuteur']; ?></p>
            <div class="text-center">
            <div class="ml-auto">
            <a href="login.php" class="btn btn-danger">Déconnexion</a>
        </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclusion de Bootstrap JS et JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
