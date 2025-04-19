<?php
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le formulaire a été soumis

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $genre = $_POST['genre'];
    $auteur = $_POST['auteur'];
    $annee = $_POST['annee'];
    $nom_ecole = $_POST['nom_ecole'];

    // Préparation de la requête d'insertion
    $query = "INSERT INTO livre (nom, genre, auteur, annee, nom_ecole) VALUES ('$nom', '$genre', '$auteur', '$annee', '$nom_ecole')";

    // Exécution de la requête
    $result = mysqli_query($db, $query);

    if ($result) {
        // Livre inséré avec succès
        echo '<script>alert("Livre ajouté avec succès !");</script>';
    } else {
        // Erreur lors de l'insertion du livre
        echo '<script>alert("Erreur lors de l\'ajout du livre.");</script>';
    }
}

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez un Livre&nbsp;<a href="#" data-toggle="modal" data-target="#livreModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Nom du Livre</th>
                        <th>Genre</th>
                        <th>Auteur</th>
                        <th>Année de Publication</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query = "SELECT * FROM livre l
JOIN utilisateur u ON l.nom_ecole = u.nom_ecole
WHERE u.nom_user = '{$_SESSION['nom_user']}' 
AND u.prenom_user = '{$_SESSION['prenom_user']}'
and l.champ_visible=1
ORDER BY l.id_livre DESC";

                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom'] .'</td>';
                        echo '<td>'. $row['genre'] .'</td>';
                        echo '<td>'. $row['auteur'].'</td>';
                        echo '<td>'. $row['annee'].'</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="livreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez un Livre</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom Livre" name="nom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Genre" name="genre" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Auteur" name="auteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Année de Publication" name="annee" required>
                    </div>
                    <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>   
                </form>  
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>
