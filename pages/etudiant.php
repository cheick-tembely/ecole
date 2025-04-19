<?php
include'../includes/connection.php';
include'../includes/sidebar_secre.php';

$query = 'SELECT id_user, t.niveau
          FROM utilisateur u
          JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
$result = mysqli_query($db, $query) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['niveau'];
    if ($Aa == 'User') {
?>
    <script type="text/javascript">
        // Redirection si l'utilisateur n'a pas les droits
        alert("Page restreinte ! Vous serez redirigé vers POS");
        window.location = "pos.php";
    </script>
<?php
    }
}

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez un étudiant&nbsp;<a href="#" data-toggle="modal" data-target="#etudiantModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Exportez la liste des étudiants&nbsp;<a href="fonction_csv1.php" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fa fa-file-excel"></i></a></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Nom du Tuteur</th>
                        <th>Prénom du Tuteur</th>
                        <th>Téléphone du Tuteur</th>
                        <th>Classe</th>
                        <th>Sexe</th>
                        <th>Date Naissance</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query = "SELECT * FROM etudiant WHERE nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') ORDER BY id_etudiant DESC";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                    $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
                    $nom_ecole = $row_ecole['nom_ecole'];
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Formatage du matricule unique
                        $matricule = 'CMD' . str_pad($row['id_etudiant'], 5, '0', STR_PAD_LEFT);
                        echo '<tr>';
                        echo '<td>'. $matricule .'</td>';
                        echo '<td>'. $row['nom'].'</td>';
                        echo '<td>'. $row['prenom'].'</td>';
                        echo '<td>'. $row['telephone'].'</td>';
                        echo '<td>'. $row['nom_tuteur'].'</td>';
                        echo '<td>'. $row['prenom_tuteur'].'</td>';
                        echo '<td>'. $row['telephone_tuteur'].'</td>';
                        echo '<td>'. $row['classe'].'</td>';
                        echo '<td>'. $row['sexe'].'</td>';
                        echo '<td>'. $row['date_naiss'].'</td>';
                        echo '<td>'. $row['statut'].'</td>';
                        echo '<td align="right"> <div class="btn-group">
                                <a type="button" class="btn btn-primary bg-gradient-primary" href="etudiant_searchfrm.php?action=edit&id='.$row['id_etudiant'].'"><i class="fas fa-fw fa-list-alt"></i> Détails</a>
                                <div class="btn-group">
                                    <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                                    ... <span class="caret"></span></a>
                                    <ul class="dropdown-menu text-center" role="menu">
                                        <li>
                                            <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="etudiant_edit.php?action=edit&id='.$row['id_etudiant'].'">
                                                <i class="fas fa-fw fa-edit"></i> Modifier
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> </td>';
                        echo '</tr> ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmBlock(id_etudiant) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cet étudiant ?");
        if (confirmBlock) {
            window.location.href = "prof_del.php?id=" + id_etudiant;
        }
    }
</script>
<div class="modal fade" id="etudiantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez un étudiant</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="etudiant_transac.php?action=add">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom Étudiant" name="nom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prénom Étudiant" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Téléphone Étudiant" name="telephone" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom du Tuteur" name="nom_tuteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prénom du Tuteur" name="prenom_tuteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Téléphone du Tuteur" name="telephone_tuteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Classe" name="classe" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="sexe" required>
                            <option value="">Sélectionnez le sexe</option>
                            <option value="Garçon">Garçon</option>
                            <option value="Fille">Fille</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" placeholder="Date Naissance" name="date_naiss" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="statut" required>
                            <option value="">Sélectionnez le statut</option>
                            <option value="Regulier">Regulier</option>
                            <option value="Candidat Libre">Candidat Libre</option>
                        </select>
                    </div>
                    <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Envoyer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> Effacer</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>
