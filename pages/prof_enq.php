<?php
include '../includes/connection.php';
include '../includes/sidebar_enq.php';

?>
<?php
// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
  $nomUser = $_SESSION['nom_user'];
  $prenomUser = $_SESSION['prenom_user'];

  // Sélectionnez le nom de l'école de l'utilisateur
  $query1 = "SELECT u.nom_user, u.prenom_user,e.nom_ecole FROM utilisateur u,ecole e WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'and u.nom_ecole=e.nom_ecole";
  $result1 = mysqli_query($db, $query1);
  $row = mysqli_fetch_assoc($result1);
  $nomEcole = $row['nom_ecole'];

?>

            
      
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste des professeurs</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone1</th>
                        <th>Telephone2</th>
                        <th>Email</th>
                        <th>Ville</th>
                        <th>Profession</th>
                        <th>Statut</th>
                        <th>Dernier Diplome</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT p.* 
                              FROM professeur p 
                              JOIN ecole e ON p.nom_ecole = e.nom_ecole
                              WHERE p.nom_ecole = '$nomEcole'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['nom_professeur'].'</td>';
                        echo '<td>'. $row['prenom_professeur'].'</td>';
                        echo '<td>'. $row['telephone1'].'</td>';
                        echo '<td>'. $row['telephone2'].'</td>';
                        echo '<td>'. $row['email'].'</td>';
                        echo '<td>'. $row['ville'].'</td>';
                        echo '<td>'. $row['profession'].'</td>';
                        echo '<td>'. $row['employeur'].'</td>';
                        echo '<td>'. $row['dernier_diplome'].'</td>';
                        echo '<td align="right"> <div class="btn-group">
                                <a type="button" class="btn btn-primary bg-gradient-primary" href="prof_enq_searchfrm.php?action=edit & id='.$row['id_professeur'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                                <div class="btn-group">

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
    function confirmBlock(id_professeur) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer ce Professeur ?");
        if (confirmBlock) {
            window.location.href = "prof_del.php?id=" + id_professeur;
        }
    }
</script>
<div class="modal fade" id="profModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez un Professeur</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="prof_transac.php?action=add">
        <form role="form" method="post" action="">
                          <div class="form-group">
                              <input class="form-control" placeholder="Nom" name="nom_professeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom" name="prenom_professeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Profession" name="profession" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Telephone1" name="telephone1" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Telephone2" name="telephone2" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Ville" name="ville" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Employeur" name="employeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Dernier Diplome Du Professeur" name="dernier_diplome" required>
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
}
include'../includes/footer.php';
?>