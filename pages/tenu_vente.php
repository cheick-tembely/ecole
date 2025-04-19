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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vendre_tenu'])) {
    // Validation des données reçues du formulaire
    $nom_tenu_vendu = $_POST['nom_tenu_vendu'];
    $quantite_vendu = $_POST['quantite_vendu'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $prix_total = $_POST['prix_total'];
    $nom_eleve = $_POST['nom_eleve']; // Récupérer le nom de l'élève
    $prenom_eleve = $_POST['prenom_eleve']; // Récupérer le prénom de l'élève
    $classe_eleve = $_POST['classe_eleve']; // Récupérer la classe de l'élève
    $nom_ecole = $_POST['nom_ecole'];
    // Vérification si les champs ne sont pas vides
    if (empty($nom_tenu_vendu) || empty($quantite_vendu) || empty($prix_unitaire) || empty($prix_total)||empty($nom_ecole)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérification de la disponibilité de la quantité à vendre
        $query_disponibilite = "SELECT quantite FROM tenues_scolaires WHERE nom_tenu = '$nom_tenu_vendu' and nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') ";
        $result_disponibilite = mysqli_query($db, $query_disponibilite);
        $row_disponibilite = mysqli_fetch_assoc($result_disponibilite);

        if ($row_disponibilite['quantite'] < $quantite_vendu) {
            $error = "La quantité à vendre est supérieure à la quantité disponible en stock.";
        } else {
            // Préparation de la requête d'insertion des tenues vendues
            $query_insertion = "INSERT INTO tenues_vendues (nom_tenu, quantite, prix_unitaire, prix_total, nom_eleve, prenom_eleve, classe_eleve,nom_ecole) 
            VALUES ('$nom_tenu_vendu', '$quantite_vendu', '$prix_unitaire', '$prix_total', '$nom_eleve', '$prenom_eleve', '$classe_eleve', '$nom_ecole')";

            
            // Exécution de la requête d'insertion
            if (mysqli_query($db, $query_insertion)) {
                // Mise à jour de la quantité disponible dans la table tenues_scolaires
                $nouvelle_quantite = $row_disponibilite['quantite'] - $quantite_vendu;
                $query_maj_quantite = "UPDATE tenues_scolaires SET quantite = '$nouvelle_quantite' WHERE nom_tenu = '$nom_tenu_vendu'";
                mysqli_query($db, $query_maj_quantite);

                // Réinitialisation des variables
                $nom_tenu_vendu = $quantite_vendu = $prix_unitaire = $prix_total = '';
            } else {
                $error = "Erreur lors de la vente des tenues scolaires: " . mysqli_error($db);
            }
        }
    }
}
?>

<script>
function calculerPrixTotal() {
    var quantite = document.getElementById('quantite_vendu').value;
    var prixUnitaire = document.getElementById('prix_unitaire').value;
    var prixTotal = quantite * prixUnitaire;
    document.getElementById('prix_total').value = prixTotal.toFixed(2);
}
</script>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Vente de Tenues Scolaires</h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="nom_tenu_vendu">Type de la Tenue:</label>
                <input type="text" class="form-control" id="nom_tenu_vendu" name="nom_tenu_vendu" value="<?php echo $nom_tenu_vendu; ?>" required>
            </div>
                </div>
                <div class="col-md-6">
                <div class="form-group"> 
                <label for="quantite_vendu">Quantité</label>
                <input type="number" class="form-control" id="quantite_vendu" name="quantite_vendu" min="1" value="<?php echo $quantite_vendu; ?>" onchange="calculerPrixTotal();" required>
            </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire</label>
                <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" min="0" step="0.01" value="<?php echo $prix_unitaire; ?>" onchange="calculerPrixTotal();" required>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="prix_total">Prix Total</label>
                <input type="number" class="form-control" id="prix_total" name="prix_total" min="0" step="0.01" value="<?php echo $prix_total; ?>" required readonly>
            </div>
            </div>
            </div>


            <div class="row">
                
            <div class="col-md-6">
            <div class="form-group">
                <label for="nom_eleve">Nom de l'Élève:</label>
                <input type="text" class="form-control" id="nom_eleve" name="nom_eleve" required>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="prenom_eleve">Prénom de l'Élève:</label>
                <input type="text" class="form-control" id="prenom_eleve" name="prenom_eleve" required>
            </div>
            </div>
            </div>






            <!-- Ajout de champs pour le nom, le prénom et la classe de l'élève -->


            <div class="form-group">
                <label for="classe_eleve">Classe de l'Élève:</label>
                <input type="text" class="form-control" id="classe_eleve" name="classe_eleve" required>
            </div>
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <!-- Fin des champs pour le nom, le prénom et la classe de l'élève -->
             <div class="btn-groupe">
             <button type="submit" class="btn btn-success" name="vendre_tenu">Valider</button>
             <a href="" class="btn btn-warning">Annuler</a>
             </div>

            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>
</div>

<?php
// Récupérer les ventes de tenues scolaires depuis la base de données
$query_ventes = "SELECT * FROM tenues_vendues where nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
$result_ventes = mysqli_query($db, $query_ventes);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Ventes de Tenues Scolaires</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom de la Tenue</th>
                        <th>Quantité Vendue</th>
                        <th>Prix Unitaire</th>
                        <th>Prix Total</th>
                        <th>Nom de l'Élève</th>
                        <th>Prénom de l'Élève</th>
                        <th>Classe de l'Élève</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_ventes)) { ?>
                        <tr>
                            <td><?php echo $row['nom_tenu']; ?></td>
                            <td><?php echo $row['quantite']; ?></td>
                            <td><?php echo $row['prix_unitaire']; ?></td>
                            <td><?php echo $row['prix_total']; ?></td>
                            <td><?php echo $row['nom_eleve']; ?></td>
                            <td><?php echo $row['prenom_eleve']; ?></td>
                            <td><?php echo $row['classe_eleve']; ?></td>
                            <td><button onclick="imprimerRecu('<?php echo $row['nom_tenu']; ?>', '<?php echo $row['quantite']; ?>', '<?php echo $row['prix_unitaire']; ?>', '<?php echo $row['prix_total']; ?>', '<?php echo $row['nom_eleve']; ?>', '<?php echo $row['prenom_eleve']; ?>', '<?php echo $row['classe_eleve']; ?>')" class="btn btn-primary">Imprimer</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function imprimerRecu(nom, quantite, prixUnitaire, prixTotal, nomEleve, prenomEleve, classeEleve) {
    // Obtenir la date actuelle
    var currentDate = new Date();
    var dateString = currentDate.toLocaleDateString('fr-FR');
    
    // Chemin vers l'image du logo de l'école
    var logoPath = 'ecole-gest.jpg';
    
    // Contenu du reçu avec la date et le logo
    var content = "<h2>Reçu de Vente</h2>" +
                  "<img src='" + logoPath + "' alt='Logo de l'école' style='max-width: 200px;'>" +
                  "<p><strong>Date:</strong> " + dateString + "</p>" +
                  "<p><strong>Nom de l'Élève:</strong> " + nomEleve + "</p>" +
                  "<p><strong>Prénom de l'Élève:</strong> " + prenomEleve + "</p>" +
                  "<p><strong>Classe de l'Élève:</strong> " + classeEleve + "</p>" +
                  "<p><strong>Nom de la Tenue:</strong> " + nom + "</p>" +
                  "<p><strong>Quantité Vendue:</strong> " + quantite + "</p>" +
                  "<p><strong>Prix Unitaire:</strong> " + prixUnitaire + "</p>" +
                  "<p><strong>Prix Total:</strong> " + prixTotal + "</p>";

    // Ouvrir une nouvelle fenêtre pour afficher le reçu et le préparer pour l'impression
    var newWindow = window.open('', '_blank');
    newWindow.document.open();
    newWindow.document.write('<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Reçu de Vente</title><style>body{font-family: Arial, sans-serif;}</style></head><body>' + content + '</body></html>');
    newWindow.document.close();
    newWindow.print(); // Imprimer le reçu
}


</script>

<?php
include '../includes/footer.php';
?>
