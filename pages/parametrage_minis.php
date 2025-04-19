<?php
include '../includes/connection.php';
include '../includes/sidebar_minis.php';

?>
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
            text-align: center; /* Correction pour centrer le titre */
            margin-top: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto; /* Centrer le formulaire */
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"],
        input[type="file"],
        input[type="date"],
        select {
            width: 100%; /* Correction pour une largeur cohérente */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Assurer une mise en page correcte */
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Bouton s'adapte à la largeur du formulaire */
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Paramétrage de l'école</h1>
    <form action="parametrage_traitement_minis.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom Administrateur :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom Administrateur :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="academie">Académie :</label>
        <input type="text" id="academie" name="academie" required>

        <label for="nom_ecole">Nom de l'école :</label>
        <input type="text" id="nom_ecole" name="nom_ecole" required>

        <label for="logo">Logo :</label>
        <input type="file" id="logo" name="logo" accept="image/*">

        <label for="lieu">Lieu :</label>
        <input type="text" id="lieu" name="lieu" required>

        <label for="statut">Statut :</label>
        <select id="statut" name="statut" required>
            <option value="Privee">Privée</option>
            <option value="Etatique">Étatique</option>
        </select>

        <label for="antenne">Antenne :</label>
        <input type="text" id="antenne" name="antenne">

        <label for="date_licence">Date de Licence :</label>
        <input type="date" id="date_licence" name="date_licence" required>

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
<?php
include '../includes/footer.php';
?>
