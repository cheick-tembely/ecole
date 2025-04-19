<?php
session_start();
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Statistiques principales
$query_total_etudiants = "SELECT COUNT(*) AS total_etudiants FROM etudiant";
$query_total_profs = "SELECT COUNT(*) AS total_profs FROM professeur";
$query_total_cours = "SELECT COUNT(*) AS total_cours FROM matiere";

$total_etudiants = mysqli_fetch_assoc(mysqli_query($db, $query_total_etudiants))['total_etudiants'];
$total_profs = mysqli_fetch_assoc(mysqli_query($db, $query_total_profs))['total_profs'];
$total_cours = mysqli_fetch_assoc(mysqli_query($db, $query_total_cours))['total_cours'];

// Données pour les graphiques
$query_etudiants_par_classe = "SELECT classe, COUNT(*) AS nombre FROM etudiant GROUP BY classe";
$result_etudiants_par_classe = mysqli_query($db, $query_etudiants_par_classe);
$etudiants_data = [];
while ($row = mysqli_fetch_assoc($result_etudiants_par_classe)) {
    $etudiants_data['labels'][] = $row['classe'];
    $etudiants_data['values'][] = $row['nombre'];
}

$query_profs_par_discipline = "SELECT 
    m.libelle_matiere, 
    COUNT(DISTINCT a.id_professeur) AS nombre
FROM 
    attribution a
INNER JOIN professeur p ON a.id_professeur = p.id_professeur
INNER JOIN matiere m ON a.id_matiere = m.id_matiere
GROUP BY 
    m.libelle_matiere;
";
$result_profs_par_discipline = mysqli_query($db, $query_profs_par_discipline);
$profs_data = [];
while ($row = mysqli_fetch_assoc($result_profs_par_discipline)) {
    $profs_data['labels'][] = $row['libelle_matiere'];
    $profs_data['values'][] = $row['nombre'];
}

// Convertir les données en JSON pour les envoyer au JavaScript
$etudiants_data_json = json_encode($etudiants_data);
$profs_data_json = json_encode($profs_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Scolaire</title>
    <!-- Intégration de Bootstrap pour le design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 40px;
        }
        .dashboard-card {
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .dashboard-card i {
            font-size: 30px;
            margin-bottom: 10px;
        }
        .dashboard-card .card-body {
            padding: 30px;
            text-align: center;
        }
        .chart-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }
        .row .col-md-4 {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.5rem;
            }

            .dashboard-card {
                margin-bottom: 15px;
            }

            .chart-container {
                padding: 15px;
            }

            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .row {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="header">
    <h3 class="text-center">Bienvenu(e) : <?php echo  $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></h3>
        <h1>Tableau de Bord</h1>
        <form action="login.php" method="post">
        <button type="submit" class="btn btn-danger">Déconnexion</button>
    </form>
    </div>

    <!-- Statistiques principales -->
    <div class="row text-center">
        <div class="col-md-4">
            <div class="dashboard-card bg-primary text-white p-4">
                <i class="fas fa-users"></i>
                <h3><?php echo $total_etudiants; ?></h3>
                <p>Total Étudiants</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-success text-white p-4">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3><?php echo $total_profs; ?></h3>
                <p>Total Professeurs</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-warning text-white p-4">
                <i class="fas fa-book-open"></i>
                <h3><?php echo $total_cours; ?></h3>
                <p>Total Cours</p>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-5">
        <div class="col-md-6 col-12">
            <div class="chart-container">
                <canvas id="etudiantsChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="chart-container">
                <canvas id="profsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Récupération des données dynamiques depuis PHP
    const etudiantsData = <?php echo $etudiants_data_json; ?>;
    const profsData = <?php echo $profs_data_json; ?>;

    // Graphique Étudiants par Classe
    const etudiantsChartCtx = document.getElementById('etudiantsChart').getContext('2d');
    new Chart(etudiantsChartCtx, {
        type: 'pie',
        data: {
            labels: etudiantsData.labels,
            datasets: [{
                label: 'Étudiants par Classe',
                data: etudiantsData.values,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8']
            }]
        }
    });

    // Graphique Professeurs par Discipline
    const profsChartCtx = document.getElementById('profsChart').getContext('2d');
    new Chart(profsChartCtx, {
        type: 'bar',
        data: {
            labels: profsData.labels,
            datasets: [{
                label: 'Professeurs par Discipline',
                data: profsData.values,
                backgroundColor: ['#17a2b8', '#6f42c1', '#e83e8c', '#fd7e14', '#28a745']
            }]
        }
    });
</script>

</body>
</html>
<?php
include '../includes/footer_eleve.php';
?>