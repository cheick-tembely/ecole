<?php
session_start();

// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Vérification des sessions
if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
    echo "Les variables de session 'nom' et 'prenom' ne sont pas définies.";
    exit;
}

// Récupération des variables de session
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

// Requête SQL
$sql = "SELECT n.* FROM notes n 
        JOIN etudiant e ON n.id_etudiant = e.id_etudiant 
        WHERE BINARY e.nom = '$nom' AND BINARY e.prenom = '$prenom' AND n.champ_visible = 1";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes des élèves</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Custom Styles -->
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center">Notes de classe de l'élève : <?php echo $nom . " " . $prenom; ?></h3>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <table id="notesTable" class="display table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Matière</th>
                        <th>Interrogation 1</th>
                        <th>Interrogation 2</th>
                        <th>Devoir 1</th>
                        <th>Devoir 2</th>
                        <th>Total des devoirs</th>
                        <th>Mois</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row["matiere"]; ?></td>
                            <td><?php echo $row["interrogation1"]; ?></td>
                            <td><?php echo $row["interrogation2"]; ?></td>
                            <td><?php echo $row["devoir1"]; ?></td>
                            <td><?php echo $row["devoir2"]; ?></td>
                            <td><?php echo $row["total_devoirs"]; ?></td>
                            <td><?php echo $row["mois"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">Aucune note trouvée dans la base de données.</p>
        <?php endif; ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Initialisation de DataTables -->
    <script>
        $(document).ready(function () {
            $('#notesTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
                }
            });
        });
    </script>
</body>
</html>
<?php
include '../includes/footer_eleve.php';
?>