<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php';
include '../includes/sidebar_compt.php';

$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Initialisation des variables
$nom_tenu = $quantite = $prix = '';
$error = '';

// Traitement du formulaire d'enregistrement des tenues scolaires
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données reçues du formulaire
    $nom_tenu = $_POST['nom_tenu'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $nom_ecole = $_POST['nom_ecole'];
    // Vérification si les champs ne sont pas vides
    if (empty($nom_tenu) || empty($quantite) || empty($prix)|| empty($nom_ecole)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Préparation de la requête d'insertion
        $query = "INSERT INTO tenues_scolaires (nom_tenu, quantite, prix,nom_ecole) VALUES ('$nom_tenu', '$quantite', '$prix', '$nom_ecole')";

        // Exécution de la requête
        if (mysqli_query($db, $query)) {
            // Réinitialisation des variables
            $nom_tenu = $quantite = $prix = '';
        } else {
            $error = "Erreur lors de l'enregistrement des tenues scolaires: " . mysqli_error($db);
        }
    }
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrement des Tenues Scolaires</h4>
    </div>

    <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom_tenu">Nom de la Tenue:</label>
                <input type="text" class="form-control" id="nom_tenu" name="nom_tenu" required value="<?php echo $nom_tenu; ?>">
            </div>
            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" class="form-control" id="quantite" name="quantite" min="1" required value="<?php echo $quantite; ?>">
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01" required value="<?php echo $prix; ?>">
            </div>
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Tenues Scolaires Enregistrées</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom de la Tenue</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                    // Requête pour récupérer les tenues scolaires
                    $query = "SELECT * FROM tenues_scolaires where nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // Affichage des tenues scolaires dans le tableau
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom_tenu'] .'</td>';
                        echo '<td>'. $row['quantite'] .'</td>';
                        echo '<td>'. $row['prix'] .'</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>
