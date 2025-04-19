<?php
include'../includes/connection.php';
include'../includes/sidebar_direct.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POINTAGE-GEST</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Graphique du Nombre de Matières par Professeur</h1>
    <canvas id="profChart" width="400" height="200"></canvas>

    <?php
    // Supprimez l'inclusion redondante du fichier connection.php
    // include '../includes/connection.php';

    // Récupérer les données de la base de données par professeur
    $queryProf = "SELECT p.nom_professeur, p.prenom_professeur, COUNT(a.id_matiere) as nb_matieres 
                  FROM professeur p
                  LEFT JOIN attribution a ON p.id_professeur = a.id_professeur 
                  GROUP BY p.id_professeur";
    $resultProf = mysqli_query($db, $queryProf);

    // Préparer les données pour Chart.js par professeur
    $professors = [];
    $subjectsCountProf = [];
    // Utilisez une couleur conforme au design UI/UX
    $profColor = 'rgba(54, 162, 235, 0.7)';

    while ($row = mysqli_fetch_assoc($resultProf)) {
        $professorFullName = $row['nom_professeur'] . ' ' . $row['prenom_professeur'];
        $professors[] = $professorFullName;
        $subjectsCountProf[] = $row['nb_matieres'];
    }

    // Fermer la connexion à la base de données
    mysqli_close($db);
    ?>

    <script>
        // Utilisation de Chart.js pour créer le graphique par professeur
        var ctxProf = document.getElementById('profChart').getContext('2d');
        var profChart = new Chart(ctxProf, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($professors); ?>,
                datasets: [{
                    label: 'Nombre de Matières par Professeur',
                    data: <?php echo json_encode($subjectsCountProf); ?>,
                    backgroundColor: <?php echo json_encode($profColor); ?>,
                    borderColor: <?php echo json_encode($profColor); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
<?php
include'../includes/footer.php';
?>
</html>






