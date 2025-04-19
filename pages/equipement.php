<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php'; // Inclure le fichier de connexion à la base de données
include '../includes/sidebar_compt.php'; // Inclure la barre latérale
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Initialisation des variables
$nom = $description = $date_achat = $prix = ''; // Ajout de la variable $prix
$error = '';

// Traitement du formulaire d'ajout d'équipement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_equipement'])) {
    // Validation des données reçues du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date_achat = $_POST['date_achat'];
    $prix = $_POST['prix']; // Récupération du prix
    $nom_ecole = $_POST['nom_ecole'];
    // Vérification si les champs ne sont pas vides
    if (empty($nom) || empty($date_achat) || empty($prix)|| empty($nom_ecole)) { // Ajout de la vérification du champ prix
        $error = "Le nom, la date d'achat et le prix sont obligatoires."; // Mise à jour du message d'erreur
    } else {
        // Préparation de la requête d'insertion
        $query = "INSERT INTO equipements (nom, description, date_achat, prix,nom_ecole) VALUES ('$nom', '$description', '$date_achat', '$prix','$nom_ecole')"; // Ajout du prix dans la requête

        // Exécution de la requête
        if (mysqli_query($db, $query)) {
            // Réinitialisation des variables
            $nom = $description = $date_achat = $prix = ''; // Réinitialisation du prix
        } else {
            $error = "Erreur lors de l'ajout de l'équipement: " . mysqli_error($db);
        }
    }
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Ajouter un Équipement</h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom">Nom de l'Équipement:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="date_achat">Date d'Achat:</label>
                <input type="date" class="form-control" id="date_achat" name="date_achat" value="<?php echo $date_achat; ?>" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>">
            </div>
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <button type="submit" class="btn btn-primary" name="ajouter_equipement">Ajouter</button>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Équipements</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom de l'Équipement</th>
                        <th>Description</th>
                        <th>Date d'Achat</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                  // Exécuter la requête SQL pour récupérer les équipements associés à l'utilisateur
$sql_equipements = "SELECT * FROM equipements WHERE nom_ecole = '$nom_ecole'AND champ_visible=1";
$result_equipements = mysqli_query($db, $sql_equipements);

// Vérifier si la requête s'est exécutée correctement
if ($result_equipements) {
    while ($row_equipements = mysqli_fetch_assoc($result_equipements)) {
        echo '<tr>';
        echo '<td>'. $row_equipements['nom'] .'</td>';
        echo '<td>'. $row_equipements['description'] .'</td>';
        echo '<td>'. $row_equipements['date_achat'] .'</td>';
        echo '<td>'. $row_equipements['prix'] .'</td>';
        echo '</tr>';
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($db);
}

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
