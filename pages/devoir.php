<?php
include '../includes/connection.php';
include '../includes/sidebar_prof.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'" LIMIT 1'));

$nom_ecole = $row_ecole['nom_ecole'];
// Récupérer l'ID de l'utilisateur connecté à partir de la session
$idUtilisateur = $_SESSION['MEMBER_ID'];

// Récupérer les informations sur la matière et la classe du professeur à partir de la table emploi
$queryInfoProf = "SELECT c.code_classe 
                  FROM emploi e
                  JOIN classe c ON e.id_classe = c.id_classe
                  JOIN utilisateur u ON e.id_professeur = u.id_user
                  WHERE u.id_user = $idUtilisateur 
                  AND e.nom_ecole = (
                      SELECT nom_ecole 
                      FROM utilisateur 
                      WHERE nom_user = '".$_SESSION['nom_user']."' 
                      AND prenom_user = '".$_SESSION['prenom_user']."'
                      LIMIT 1
                  )";

$resultInfoProf = mysqli_query($db, $queryInfoProf);

// Vérifier si des résultats ont été retournés
if ($resultInfoProf && mysqli_num_rows($resultInfoProf) > 0) {
    $infoProf = mysqli_fetch_assoc($resultInfoProf);

    $classeProf = $infoProf['classe'];
} else {
 // Initialiser à une chaîne vide si aucune donnée n'est disponible
    $classeProf = ''; // Initialiser à une chaîne vide si aucune donnée n'est disponible
}

// Traiter le formulaire lorsqu'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nomProf = $_POST['nom_prof'];
    $prenomProf = $_POST['prenom_prof'];
    $titreDevoir = $_POST['titre_devoir'];
    $contenu = $_POST['contenu'];
    $classe = $_POST['classe'];
    $dateLimite = $_POST['date_limite'];
    $nom_ecole = $_POST['nom_ecole'];
    // Préparer la requête d'insertion
    $query = "INSERT INTO devoirs_domicile (nom_prof, prenom_prof, classe, titre_devoir, contenu, date_limite,nom_ecole) 
              VALUES ('$nomProf', '$prenomProf', '$classe', '$titreDevoir', '$contenu', '$dateLimite' ,'$nom_ecole')";

    // Exécuter la requête
    if (mysqli_query($db, $query)) {
        echo "Le devoir a été envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du devoir: " . mysqli_error($db);
    }

    // Fermer la connexion à la base de données

}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez un Devoir à Domicile &nbsp;<a href="#" data-toggle="modal" data-target="#absenceModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>
   
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                <thead>
                    <tr>
                        <th>Nom du Prof</th>
                        <th>Prenom du prof</th>
                        <th>Classe</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date Limite</th>
                       
                </thead>
                <tbody>
                    <?php                  
$query = 'SELECT * FROM devoirs_domicile WHERE nom_ecole = (
    SELECT nom_ecole 
    FROM utilisateur 
    WHERE nom_user = "'.$_SESSION['nom_user'].'" 
    AND prenom_user = "'.$_SESSION['prenom_user'].'"
    LIMIT 1
) ORDER BY id DESC';

                    $result = mysqli_query($db, $query) or die (mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $_SESSION['nom_user'] .'</td>'; // Afficher le nom du professeur
                        echo '<td>'. $_SESSION['prenom_user'] .'</td>'; // Afficher le prénom du professeur
                       // Afficher la classe du professeur
                       echo '<td>'. $row['classe'].'</td>';
                        // Afficher la matière du professeur
                        echo '<td>'. $row['titre_devoir'].'</td>';
                        echo '<td>'. $row['contenu'].'</td>';
                        echo '<td>'. $row['date_limite'].'</td>';
                        
                        // Compter le nombre d'occurrences du nom de l'étudiant
                       
                        
                        
                        
                
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmBlock(id_absence) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer ce absence ?");
        if (confirmBlock) {
            window.location.href = "absence_del.php?id=" + id_absence;
        }
    }
</script>

<div class="modal fade" id="absenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez un Devoir à domicile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom Professeur" name="nom_prof" value="<?php echo $_SESSION['nom_user']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prenom Professeur" name="prenom_prof" value="<?php echo $_SESSION['prenom_user']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Titre" name="titre_devoir" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Contenu" name="contenu" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Classe" name="classe" required>
                        </div>
                   
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" placeholder="Date Limite" name="date_limite"  required>
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
mysqli_close($db);
?>
