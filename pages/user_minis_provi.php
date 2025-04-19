<?php
include '../includes/connection.php';

// Récupération des options de niveau
$sqlforjob = "SELECT DISTINCT niveau, id_niveau 
              FROM niveau 
              WHERE niveau IN ('Administrateur Local') 
              ORDER BY id_niveau ASC";
$result_niveau = mysqli_query($db, $sqlforjob) or die("Bad SQL: $sqlforjob");

// Construction du menu déroulant pour sélectionner le niveau
$id_niveau = "<select class='form-control' name='id_niveau' required>
        <option value='' disabled selected hidden>Selectionnez le Niveau</option>";
while ($row = mysqli_fetch_assoc($result_niveau)) {
    $id_niveau .= "<option value='" . $row['id_niveau'] . "'>" . $row['niveau'] . "</option>";
}
$id_niveau .= "</select>";

// Requête pour récupérer les administrateurs locaux
$query = 'SELECT id_user, nom_user, prenom_user, GENDER, email_user, login, e.niveau
          FROM utilisateur u
          JOIN niveau e ON e.id_niveau = u.id_niveau AND e.niveau = "Administrateur Local"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<style>
    /* Styles pour corriger la largeur des éléments */
    #wrapper {
        width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
    }
    
    #content-wrapper {
        width: 100% !important;
    }

    .navbar {
        width: 100% !important;
        margin: 0 !important;
    }

    .container {
        max-width: 100% !important;
        padding: 0 2rem;
    }

    .card {
        width: 100% !important;
        margin: 1rem 0;
    }

    .table-responsive {
        width: 100% !important;
        margin: 0 !important;
    }
</style>

<?php include '../includes/sidebar_minis.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Administrateurs Locaux</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

<div class="card shadow-lg rounded-lg overflow-hidden bg-white/80 backdrop-blur-sm m-6">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-white">
        <h4 class="text-2xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-users-cog mr-3 text-blue-600"></i>
            Comptes des Administrateurs Locaux
        </h4>
        <button data-toggle="modal" data-target="#supplierModal1" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 flex items-center gap-2 shadow-md hover:shadow-lg">
            <i class="fas fa-plus"></i>
            Ajouter
        </button>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Nom</th>
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Prénom</th>
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Genre</th>
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Email</th>
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Login</th>
                        <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider uppercase text-sm">Niveau</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800"><?php echo $row['nom_user']; ?></td>
                            <td class="px-6 py-4 text-gray-800"><?php echo $row['prenom_user']; ?></td>
                            <td class="px-6 py-4 text-gray-800"><?php echo $row['GENDER']; ?></td>
                            <td class="px-6 py-4 text-gray-800"><?php echo $row['email_user']; ?></td>
                            <td class="px-6 py-4 text-gray-800"><?php echo $row['login']; ?></td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    <?php echo $row['niveau']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="supplierModal1" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-xl shadow-2xl">
            <div class="modal-header border-b border-gray-200 p-4">
                <h5 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                    Enregistrer un Administrateur Local
                </h5>
                <button class="text-gray-400 hover:text-gray-600" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-6">
                <form method="post" action="us_transac.php?action=add" class="space-y-4">
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Nom
                        </label>
                        <input type="text" name="nom_user" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Entrez le nom">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Prénom
                        </label>
                        <input type="text" name="prenom_user" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Entrez le prénom">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-venus-mars mr-2 text-blue-500"></i>Genre
                        </label>
                        <select name="GENDER" required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Sélectionnez le genre</option>
                            <option value="MASCULIN">MASCULIN</option>
                            <option value="FEMININ">FEMININ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>Email
                        </label>
                        <input type="email" name="email_user" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="exemple@email.com">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user-circle mr-2 text-blue-500"></i>Nom Utilisateur
                        </label>
                        <input type="text" name="login" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Entrez le nom d'utilisateur">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-key mr-2 text-blue-500"></i>Mot de passe
                        </label>
                        <input type="password" name="password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Entrez le mot de passe">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user-shield mr-2 text-blue-500"></i>Niveau
                        </label>
                        <?php echo $id_niveau; ?>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 flex items-center">
                            <i class="fa fa-check mr-2"></i>Enregistrer
                        </button>
                        <button type="reset" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 flex items-center">
                            <i class="fa fa-times mr-2"></i>Effacer
                        </button>
                        <button type="button" 
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200 flex items-center" 
                                data-dismiss="modal">
                            <i class="fa fa-arrow-left mr-2"></i>Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmBlock(userId) {
        var confirmBlock = confirm("Voulez-vous vraiment bloquer cet utilisateur ?");
        if (confirmBlock) {
            window.location.href = "us_del.php?id=" + userId;
        }
    }
</script>


</body>
</html>
<?php include '../includes/footer.php'; ?>