<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

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
        <h4 class="m-2 font-weight-bold text-primary">Liste des Transferts</h4>
    </div>
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                   
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ancienne Ecole</th>
                        <th>Nouvelle Ecole</th>
                        <th>Motif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
$query = "SELECT * FROM transfert_ecole WHERE champ_visible=1";

                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                    while ($row = mysqli_fetch_assoc($result)) {
                   
                        echo '<tr>';
                       
                        echo '<td>'. $row['nom'].'</td>';
                        echo '<td>'. $row['prenom'].'</td>';
                        echo '<td>'. $row['ancienne_ecole'].'</td>';
                        echo '<td>'. $row['nouvelle_ecole'].'</td>';
                       
                        echo '<td>'. $row['motif'].'</td>';
                       
                        echo '<td align="right"> <div class="btn-group">
                         
                                <div class="btn-group">
                                    <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                                    ... <span class="caret"></span></a>
                                    <ul class="dropdown-menu text-center" role="menu">
                                        <li>
                                            <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="traitement_edit.php?action=edit&id='.$row['id'].'">
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Transferts Valider </h4>
    </div>
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- Table header -->
                <thead>
                    <tr>
                  
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ancienne Ecole</th>
                        <th>Nouvelle Ecole</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <!-- Ajoutez d'autres colonnes si nécessaire -->
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    <?php                  
$query_valides = "SELECT * FROM transfert_ecole WHERE statut = 'Valider'";
$result_valides = mysqli_query($db, $query_valides) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result_valides)) {
    // Affichage des élèves validés
    echo '<tr>';
 
    echo '<td>'. $row['nom'].'</td>';
    echo '<td>'. $row['prenom'].'</td>';
    echo '<td>'. $row['ancienne_ecole'].'</td>';
    echo '<td>'. $row['nouvelle_ecole'].'</td>';
   
    echo '<td>'. $row['motif'].'</td>';
    echo '<td>'. $row['statut'].'</td>';
    echo '</tr> ';
}
?>
         </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des Transferts Rejeter</h4>
    </div>
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- Table header -->
                <thead>
                    <tr>
             
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Ancienne Ecole</th>
                        <th>Nouvelle Ecole</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <!-- Ajoutez d'autres colonnes si nécessaire -->
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    <?php                  
$query_non_valides = "SELECT * FROM transfert_ecole WHERE statut = 'Rejeter'";
$result_non_valides = mysqli_query($db, $query_non_valides) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result_non_valides)) {
    // Affichage des élèves non validés
    echo '<tr>';

    echo '<td>'. $row['nom'].'</td>';
    echo '<td>'. $row['prenom'].'</td>';
    echo '<td>'. $row['ancienne_ecole'].'</td>';
    echo '<td>'. $row['nouvelle_ecole'].'</td>';
   
    echo '<td>'. $row['motif'].'</td>';
    echo '<td>'. $row['statut'].'</td>';
    // Ajoutez d'autres colonnes si nécessaire
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
