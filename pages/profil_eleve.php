<?php
session_start();
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Création de Profil Élève</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 50px 0;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }

        .card-title {
            margin-top: 20px;
            text-align: center;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            margin: 0 auto 20px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .school-logo {
            width: 60px;
            height: 60px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <h4 class="card-title">ID Élève</h4>
            <div class="profile-picture">
                <img src="ecole-gest.jpg" alt="Photo de l'élève">
            </div>
            <form action="traitement_eleve.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="photo">Photo de l'Élève :</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" required accept="image/*">
                </div>
                <div class="form-group">
                    <label for="classe">Classe :</label>
                    <input type="text" class="form-control" id="classe" name="classe" required>
                </div>
                <div class="form-group">
                    <label for="annee">Année Scolaire :</label>
                    <input type="text" class="form-control" id="annee" name="annee" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer Profil</button>
            </form>
          
        </div>
    </div>
</body>
</html>
