<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil des Élèves par Classe</title>
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
            margin-bottom: 10px;
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
            <h4 class="card-title">Voir le Profil des Élèves par Classe</h4>
            <form action="voir_eleves_par_classe_surv.php" method="GET">
                <div class="form-group">
                    <label for="classe">Sélectionner une Classe :</label>
                    <select class="form-control" id="classe" name="classe" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="TSECO">TSECO</option>
                        <option value="TLL">TLL</option>
                        <option value="SES">SES</option>
                        <option value="TSE">TSE</option>
                        <option value="SCIENCE">SCIENCE</option>
                        <option value="TEXP">TEXP</option>
                        <option value="TSS">TSS</option>
                        <option value="LETTRE">LETTRE</option>
                        <option value="CG">CG</option>
                        <!-- Ajoutez les autres classes selon vos besoins -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Voir Profil des Élèves</button>
            </form>
            <a href="index_surv.php" class="btn btn-secondary">Retourner vers la page d'accueil du surveillant</a>
        </div>
    </div>
</body>
</html>
