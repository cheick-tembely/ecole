<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Scolaire des Élèves</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .carte {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 20px;
            float: left;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .info {
            text-align: left;
            margin-bottom: 10px;
        }
        input[type=file] {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Inclure le fichier de connexion à la base de données
    include '../includes/connection.php';
    include '../includes/sidebar_secre.php';
    
    // Chemin du répertoire de destination
    $upload_dir = "../uploads/";

    // Vérifier si le répertoire existe, sinon le créer
    if (!is_dir($upload_dir)) {
        // Créer le répertoire avec les permissions 0777 pour permettre l'écriture
        if (!mkdir($upload_dir, 0777, true)) {
            // Gérer l'erreur si la création du répertoire échoue
            die('Erreur lors de la création du répertoire de téléchargement.');
        }
    }

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['image_eleve']) && $_FILES['image_eleve']['error'] === 0) {
        // Spécifier le répertoire de téléchargement

        // Nom de fichier unique
        $filename = uniqid() . '_' . $_FILES['image_eleve']['name'];

        // Chemin complet du fichier téléchargé
        $target_file = $upload_dir . $filename;

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($_FILES['image_eleve']['tmp_name'], $target_file)) {
            echo "<p>L'image a été téléchargée avec succès.</p>";
        } else {
            echo "<p>Erreur lors du téléchargement de l'image.</p>";
        }
    }

    // Récupérer les informations des élèves depuis la base de données
    $query = "SELECT id_etudiant, nom, prenom, classe, photo FROM etudiant";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Logo de l'école
    $logo_ecole = "LOGO.jpeg";

    // Parcourir les résultats et afficher les cartes scolaires pour chaque élève
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="carte">';
        echo '<img class="logo" src="' . $logo_ecole . '" alt="Logo de l\'école">';
        echo '<img class="photo" src="' . $row['photo'] . '" alt="Photo de l\'élève">';
        echo '<div class="info">';
        echo '<p><strong>Nom :</strong> ' . $row['nom'] . '</p>';
        echo '<p><strong>Prénom :</strong> ' . $row['prenom'] . '</p>';
        echo '<p><strong>Classe :</strong> ' . $row['classe'] . '</p>';
        echo '</div>';

        // Formulaire pour télécharger l'image des élèves
        echo '<form method="post" enctype="multipart/form-data">';
        echo '<input type="file" name="image_eleve" accept="image/*">';
        echo '<input type="hidden" name="id_etudiant" value="' . $row['id_etudiant'] . '">';
        echo '<input type="submit" value="Télécharger">';
        echo '</form>';

        echo '</div>';
    }
    ?>
</body>
</html>
