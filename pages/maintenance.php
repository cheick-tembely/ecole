<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php';
include '../includes/sidebar_compt.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Initialisation des variables
$nom_equipement = $description = $date_maintenance = '';
$error = '';

// Traitement du formulaire de maintenance des équipements
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_maintenance'])) {
    // Validation des données reçues du formulaire
    $nom_equipement = $_POST['nom_equipement'];
    $description = $_POST['description'];
    $date_maintenance = $_POST['date_maintenance'];
    $prix = $_POST['prix'];
    $nom_ecole = $_POST['nom_ecole'];
    // Vérification si les champs ne sont pas vides
    if (empty($nom_equipement) || empty($description) || empty($date_maintenance) || empty($prix)|| empty($nom_ecole)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Préparation de la requête d'insertion de la maintenance
        $query = "INSERT INTO maintenances (nom_equipement, description, date_maintenance,prix,nom_ecole) VALUES ('$nom_equipement', '$description', '$date_maintenance','$prix','$nom_ecole')";

        // Exécution de la requête
        if (mysqli_query($db, $query)) {
            // Réinitialisation des variables
            $nom_equipement = $description = $date_maintenance = $prix='';
        } else {
            $error = "Erreur lors de l'ajout de la maintenance: " . mysqli_error($db);
        }
    }
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Ajouter une Maintenance</h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom_equipement">Nom de l'Équipement:</label>
                <input type="text" class="form-control" id="nom_equipement" name="nom_equipement" value="<?php echo $nom_equipement; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="date_maintenance">Date de Maintenance:</label>
                <input type="date" class="form-control" id="date_maintenance" name="date_maintenance" value="<?php echo $date_maintenance; ?>" required>
            </div>
            <div class="form-group">
                <label for="date_maintenance">Prix:</label>
                <input  class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>" required>
            </div>
            <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <button type="submit" class="btn btn-primary" name="ajouter_maintenance">Ajouter</button>
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Maintenances</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom de l'Équipement</th>
                        <th>Description</th>
                        <th>Date de Maintenance</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
              
              $query_maintenances = "SELECT * FROM maintenances WHERE nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and champ_visible=1";
              $result_maintenances = mysqli_query($db, $query_maintenances);
              
              // Vérifier si la requête a retourné un résultat valide
              if ($result_maintenances && mysqli_num_rows($result_maintenances) > 0) {
                  // Utiliser mysqli_fetch_assoc uniquement si $result_maintenances contient des lignes
                  while ($row_maintenance = mysqli_fetch_assoc($result_maintenances)) {
                      echo '<tr>';
                      echo '<td>'. $row_maintenance['nom_equipement'] .'</td>';
                      echo '<td>'. $row_maintenance['description'] .'</td>';
                      echo '<td>'. $row_maintenance['date_maintenance'].'</td>';
                      echo '<td>'. $row_maintenance['prix'].'</td>';
                      echo '</tr>';
                  }
              } else {
                  // Gérer le cas où la requête n'a pas retourné de résultat valide
                  echo '<tr><td colspan="4">Aucune maintenance trouvée.</td></tr>';
              }
              
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


