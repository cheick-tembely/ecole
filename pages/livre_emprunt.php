<?php
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $id_livre = $_POST['id_livre'];
    $nom_emprunteur = $_POST['nom_emprunteur'];
    $prenom_emprunteur = $_POST['prenom_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];
    $nom_ecole = $_POST['nom_ecole'];

    // Préparation de la requête d'insertion
    $query = "INSERT INTO emprunts (id_livre, nom_emprunteur, prenom_emprunteur, date_emprunt, date_retour,nom_ecole)
              VALUES ('$id_livre', '$nom_emprunteur', '$prenom_emprunteur', '$date_emprunt', '$date_retour', '$nom_ecole')";

    // Exécution de la requête
    $result = mysqli_query($db, $query);
    if ($result) {
        echo '<div class="alert alert-success" role="alert">
                Données insérées avec succès dans la table des emprunts!
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Erreur lors de l\'insertion des données dans la table des emprunts: ' . mysqli_error($db) . '
              </div>';
    }
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Emprunt de Livres</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="livresTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Nom du Livre</th>
                        <th>Genre</th>
                        <th>Auteur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query = "SELECT * FROM livre 
WHERE nom_ecole = (
    SELECT nom_ecole FROM utilisateur 
    WHERE nom_user = '{$_SESSION['nom_user']}' AND prenom_user = '{$_SESSION['prenom_user']}'
) and champ_visible=1";

                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom'] .'</td>';
                        echo '<td>'. $row['genre'] .'</td>';
                        echo '<td>'. $row['auteur'].'</td>';
                        echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#empruntModal' . $row['id_livre'] . '">Emprunter</button></td>';
                        echo '</tr>';

                        // Modal pour l'emprunt de livre
                        echo '<div class="modal fade" id="empruntModal' . $row['id_livre'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Emprunter ' . $row['nom'] . '</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                                                <input type="hidden" name="id_livre" value="' . $row['id_livre'] . '">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Nom de l\'emprunteur" name="nom_emprunteur" required>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Prénom de l\'emprunteur" name="prenom_emprunteur" required>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" type="date" name="date_emprunt" required>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" type="date" name="date_retour" required>
                                                </div>
                                                <div class="form-group">
                                                <input class="form-control" placeholder="Ecole" name="nom_ecole" value="' . $nom_ecole . '" required readonly>
                                            </div>
                    
                                                <hr>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Emprunter</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Emprunteurs</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="emprunteursTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Nom du Livre Emprunté</th>
                        <th>Nom de l'emprunteur</th>
                        <th>Prénom de l'emprunteur</th>
                        <th>Date d'emprunt</th>
                        <th>Date de retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query_emprunts = "SELECT emprunts.*, livre.nom AS nom_livre 
FROM emprunts
INNER JOIN livre ON emprunts.id_livre = livre.id_livre 
WHERE emprunts.nom_ecole = (
    SELECT nom_ecole FROM utilisateur 
    WHERE nom_user = '{$_SESSION['nom_user']}' AND prenom_user = '{$_SESSION['prenom_user']}'
)";

                    $result_emprunts = mysqli_query($db, $query_emprunts) or die(mysqli_error($db));

                    while ($row_emprunts = mysqli_fetch_assoc($result_emprunts)) {
                        echo '<tr>';
                        echo '<td>'. $row_emprunts['nom_livre'] .'</td>';
                        echo '<td>'. $row_emprunts['nom_emprunteur'] .'</td>';
                        echo '<td>'. $row_emprunts['prenom_emprunteur'].'</td>';
                        echo '<td>'. $row_emprunts['date_emprunt'].'</td>';
                        echo '<td>'. $row_emprunts['date_retour'].'</td>';
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
