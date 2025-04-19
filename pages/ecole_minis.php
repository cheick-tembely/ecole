<?php
include '../includes/connection.php';
include '../includes/sidebar_minis.php';
?>
<style>
    #wrapper {
        width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
        min-height: 100vh;
    }
    
    #content-wrapper {
        width: 100% !important;
        height: auto !important;
        min-height: 100vh;
    }

    #content {
        width: 100% !important;
        padding-left: 224px;
        height: auto !important;
        min-height: calc(100vh - 60px);
        overflow-y: auto;
    }

    .container {
        max-width: 100% !important;
        padding: 0 2rem;
        height: auto;
        min-height: 100%;
    }

    body {
        min-height: 100vh;
        overflow-y: auto;
    }

    .table-responsive {
        max-height: calc(100vh - 300px);
        overflow-y: auto;
    }
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Écoles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50">

<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-school text-blue-600 mr-3"></i>
                    Liste des Établissements
                </h2>
                <p class="text-gray-600 mt-1">Cliquez sur une école pour voir ses détails</p>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
                <i class="fas fa-plus"></i>
                Ajouter une école
            </button>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom de l'établissement
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $query = "SELECT nom_ecole FROM ecole";
                    $result = mysqli_query($db, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class="school-row hover:bg-gray-50 transition-colors cursor-pointer">';
                        echo '<td class="px-6 py-4">';
                        echo '<div class="flex items-center">';
                        echo '<i class="fas fa-building text-blue-500 mr-3"></i>';
                        echo '<span class="school-name text-sm font-medium text-gray-900">' . $row['nom_ecole'] . '</span>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td class="px-6 py-4 text-right">';
                        echo '<button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>';
                        echo '<button class="text-red-600 hover:text-red-800"><i class="fas fa-trash-alt"></i></button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section pour afficher les détails de l'école -->
    <div id="user-list" class="bg-white rounded-xl shadow-lg p-6 transition-all duration-300 opacity-0">
        <!-- Le contenu sera chargé dynamiquement -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const schoolRows = document.querySelectorAll('.school-row');
    const userList = document.getElementById('user-list');

    schoolRows.forEach(row => {
        row.addEventListener('click', function () {
            const schoolName = this.querySelector('.school-name').textContent.trim();
            
            // Ajouter une classe active à la ligne sélectionnée
            schoolRows.forEach(r => r.classList.remove('bg-blue-50'));
            this.classList.add('bg-blue-50');
            
            // Afficher un loader
            userList.innerHTML = '<div class="flex justify-center py-8"><i class="fas fa-circle-notch fa-spin text-blue-600 text-3xl"></i></div>';
            userList.classList.remove('opacity-0');

            // Charger les données
            fetch('load_users.php?school=' + encodeURIComponent(schoolName))
                .then(response => response.text())
                .then(data => {
                    userList.innerHTML = data;
                })
                .catch(error => {
                    userList.innerHTML = '<div class="text-red-600 text-center py-4">Erreur lors du chargement des données</div>';
                    console.error('Erreur:', error);
                });
        });
    });
});
</script>

</body>
</html>
<?php include '../includes/footer.php'; ?>