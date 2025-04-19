<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramétrage de l'école</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-top: 0;
            text-align: center;
            /* Correction pour l'alignement */
        }

        .info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .info-value {
            margin-bottom: 15px;
            color: #333;
        }

        .button-container {
            text-align: center;
        }

        .confirm-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .confirm-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Paramétrage de l'école</h1>
    <div class="info">
      <?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';

// Vérifier si l'utilisateur est connecté et récupérer ses informations
session_start();
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Vérifier si la connexion à la base de données est établie
    if ($db) {
        // Requête SQL pour récupérer les informations de l'école associées à l'utilisateur
        $query = "SELECT nom,prenom,academie, nom_ecole, lieu, statut,logo_path, antenne FROM ecole WHERE nom = '$nomUser' AND prenom = '$prenomUser'";
        $result = mysqli_query($db, $query);

        // Vérifier s'il y a des résultats
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $academie = $row['academie'];
            $nomEcole = $row['nom_ecole'];
            $lieu = $row['lieu'];
            $statut = $row['statut'];
            $antenne = $row['antenne'];
            $logo_path = $row['logo_path'];

            // Afficher les informations de l'école
            echo '<label>Nom Administrateur Local :</label>';
            echo '<div class="info-value">' . $nom . '</div>';

            echo '<label>Prenom Administrateur Local :</label>';
            echo '<div class="info-value">' . $prenom . '</div>';
            echo '<label>Académie :</label>';
            echo '<div class="info-value">' . $academie . '</div>';

            echo '<label>Nom de l\'école :</label>';
            echo '<div class="info-value">' . $nomEcole . '</div>';

            echo '<label>Lieu :</label>';
            echo '<div class="info-value">' . $lieu . '</div>';

            echo '<label>Statut :</label>';
            echo '<div class="info-value">' . $statut . '</div>';

            echo '<label>Antenne :</label>';
            echo '<div class="info-value">' . $antenne . '</div>';

            echo '<label>Logo :</label>';
            echo '<div class="info-value">' . $logo_path . '</div>';

            // Vérifier si l'utilisateur a déjà confirmé
            if (!isset($_SESSION['confirm'])) {
                // Marquer que l'utilisateur a confirmé
                $_SESSION['confirm'] = true;
                // Rediriger vers index.php
                header('Location: index.php');
                exit; // Assurez-vous de terminer le script après la redirection
            }
        } else {
            // Aucune école trouvée pour cet utilisateur
            echo '<p>Aucune école trouvée pour cet utilisateur.</p>';
        }
    } else {
        // Erreur de connexion à la base de données
        echo '<p>Erreur de connexion à la base de données.</p>';
    }
} else {
    // L'utilisateur n'est pas connecté
    echo '<p>Vous devez être connecté pour accéder à cette fonctionnalité.</p>';
}
?>

    </div>
    <div class="button-container">
    <a type="button" class="btn btn-primary bg-gradient-primary" href="index.php?action=edit&id='.$row['id'].'"><i class="fas fa-fw fa-list-alt"></i> Comfirmer</a>

    </div>
</body>

</html>
