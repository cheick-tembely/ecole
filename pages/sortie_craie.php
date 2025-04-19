<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php';
include '../includes/sidebar_compt.php';

$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Initialisation des variables
$nom_tenu_vendu = $quantite_vendu = $prix_unitaire = $prix_total = '';
$error = '';

// Traitement du formulaire de vente des tenues scolaires
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vendre_tenu'])&& isset($_POST['nom_ecole'])) {
    // Validation des données reçues du formulaire
    $nom_tenu_vendu = $_POST['qualite'];
    $quantite_vendu = $_POST['quantite'];
    $prix_unitaire = $_POST['nom'];
    $prix_total = $_POST['date'];
    $nom_ecole = $_POST['nom_ecole'];
     // Récupérer la classe de l'élève

    // Vérification si les champs ne sont pas vides
    if (empty($nom_tenu_vendu) || empty($quantite_vendu) || empty($prix_unitaire) || empty($prix_total)|| empty($nom_ecole)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérification de la disponibilité de la quantité à vendre
        $query_disponibilite = "SELECT quantite FROM crai WHERE qualite = '$nom_tenu_vendu' and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')";
        $result_disponibilite = mysqli_query($db, $query_disponibilite);
        $row_disponibilite = mysqli_fetch_assoc($result_disponibilite);

        if ($row_disponibilite['quantite'] < $quantite_vendu) {
            $error = "La quantité à vendre est supérieure à la quantité disponible en stock.";
        } else {
            // Préparation de la requête d'insertion des tenues vendues
            $query_insertion = "INSERT INTO sortie_craie (qualite, quantite, nom, date,nom_ecole) 
            VALUES ('$nom_tenu_vendu', '$quantite_vendu', '$prix_unitaire', '$prix_total', '$nom_ecole')";

            
            // Exécution de la requête d'insertion
            if (mysqli_query($db, $query_insertion)) {
                // Mise à jour de la quantité disponible dans la table tenues_scolaires
                $nouvelle_quantite = $row_disponibilite['quantite'] - $quantite_vendu;
                $query_maj_quantite = "UPDATE crai SET quantite = '$nouvelle_quantite' WHERE qualite = '$nom_tenu_vendu'";
                mysqli_query($db, $query_maj_quantite);

                // Réinitialisation des variables
                $nom_tenu_vendu = $quantite_vendu = $prix_unitaire = $prix_total = '';
            } else {
                $error = "Erreur lors de la vente des craies: " . mysqli_error($db);
            }
        }
    }
}
?>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Sortie des craies</h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom_tenu_vendu">Qualité:</label>
                <input type="text" class="form-control" id="qualite" name="qualite" value="<?php echo $nom_tenu_vendu; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantite_vendu">Quantité:</label>
                <input type="number" class="form-control" id="quantite" name="quantite" min="1" value="<?php echo $quantite_vendu; ?>" onchange="calculerPrixTotal();" required>
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" min="0" step="0.01" value="<?php echo $prix_unitaire; ?>" onchange="calculerPrixTotal();" required>
            </div>
            <div class="form-group">
                <label for="prix_total">Date:</label>
                <input type="date" class="form-control" id="date" name="date" min="0" step="0.01" value="<?php echo $prix_total; ?>" required >
            </div>
            <!-- Ajout de champs pour le nom, le prénom et la classe de l'élève -->
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            
         
            <!-- Fin des champs pour le nom, le prénom et la classe de l'élève -->
            <button type="submit" class="btn btn-primary" name="vendre_tenu">Attribuer</button>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>
</div>

<?php
// Récupérer les ventes de tenues scolaires depuis la base de données
$query_ventes = "SELECT * FROM sortie_craie where nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
$result_ventes = mysqli_query($db, $query_ventes);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Sorties des craies</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Qualité</th>
                        <th>Quantité </th>
                        <th>Nom</th>
                        <th>Date</th>
                      
                    
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_ventes)) { ?>
                        <tr>
                            <td><?php echo $row['qualite']; ?></td>
                            <td><?php echo $row['quantite']; ?></td>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include '../includes/footer.php';
?>
