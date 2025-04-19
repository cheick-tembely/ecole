<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';

// Vérifier si l'identifiant de la scolarité est passé en paramètre
if (isset($_GET['id_etudiant'])) {
    $id_scolarite = $_GET['id_etudiant'];

    // Récupérer les informations de la scolarité à mettre à jour
    $scolarite_query = $db->prepare("SELECT mois_paye FROM scolarite WHERE id_etudiant = ?");
    $scolarite_query->bind_param("i", $id_scolarite);
    $scolarite_query->execute();
    $scolarite_result = $scolarite_query->get_result();

    if ($scolarite_result->num_rows > 0) {
        $scolarite_row = $scolarite_result->fetch_assoc();
        $mois_paye = $scolarite_row['mois_paye'];
    } else {
        // Gérer le cas où la scolarité n'est pas trouvée
        echo "Scolarité non trouvée.";
        exit();
    }
} else {
    // Gérer le cas où l'identifiant de la scolarité n'est pas spécifié
    echo "Identifiant de la scolarité non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les mois payés</title>
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
        select, input[type="submit"] {
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
    </style>
</head>
<body>
    <h1>Modifier les mois payés</h1>
    <div class="container">
        <form action="update_payment.php" method="POST">
            <input type="hidden" name="id_scolarite" value="<?php echo $id_scolarite; ?>">
            <label for="mois_paye">Mois payé :</label>
            <select id="mois_paye" name="mois_paye" required>
                <option value="1" <?php if ($mois_paye == 1) echo 'selected'; ?>>Janvier</option>
                <option value="2" <?php if ($mois_paye == 2) echo 'selected'; ?>>Février</option>
                <option value="3" <?php if ($mois_paye == 3) echo 'selected'; ?>>Mars</option>
                <!-- Ajoutez d'autres options pour les mois suivants -->
            </select>
            <input type="submit" value="Enregistrer">
        </form>
    </div>
</body>
</html>
