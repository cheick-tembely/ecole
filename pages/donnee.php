<?php
include'../includes/sidebar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Réinitialiser Données</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .checkbox-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }
        .submit-button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>



    <div class="checkbox-container">
        <h2>Réinitialiser les Données</h2>
        <form method="post" action="reset_data.php" class="checkbox-group">
            <?php
            include '../includes/connection.php'; // Inclure le fichier de connexion

            // Liste des tables dans votre base de données
            $tables = [
                'absence', 'absence_prof', 'absence_surveillant', 'antenne', 'arrivee_professeur',
                'attribution_programme', 'bulletin_scolaire', 'classe', 'coefficient', 'commande',
                'commande_emprunt', 'crai', 'devoir_domicile', 'ecole', 'eleves', 'emargement', 'emploi',
                'emploi_parent', 'emprunts', 'equipements', 'etudiant', 'fiche_sequence', 'livre', 'maintenances',
                'matiere', 'message', 'messages', 'message_grouper', 'niveau', 'niveau_enseignement', 'notes',
                'note_examen', 'pointage', 'professeur', 'programme', 'scolarite', 'sortie_craie', 'tenues_scolaires',
                'tenues_vendues', 'utilisateur', 'utilisateurs_ecoles'
            ];

            foreach ($tables as $table) {
                echo "<label><input type='checkbox' name='tables[]' value='$table'>$table</label>";
            }
            ?>
            <input class="submit-button" type="submit" name="reset_data" value="Réinitialiser Données">
        </form>
    </div>
</body>
</html>
<?php
include'../includes/footer.php';
?>