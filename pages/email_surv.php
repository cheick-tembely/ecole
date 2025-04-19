<?php
include '../includes/connection.php';
include '../includes/sidebar_surv.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'envoi d'e-mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Formulaire d'envoi d'e-mail</h1>
    <form action="envoi_email_surv.php" method="post">
        <label for="destinataire">Adresse du destinataire :</label>
        <input type="email" id="destinataire" name="destinataire" required><br><br>

        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
<?php
include'../includes/footer.php';
?>