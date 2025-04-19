<?php
include '../includes/connection.php';
include '../includes/sidebar_cens.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Sélectionnez le nom de l'école de l'utilisateur
    $query1 = "SELECT u.nom_user, u.prenom_user,e.nom_ecole FROM utilisateur u,ecole e WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'and u.nom_ecole=e.nom_ecole";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

    // Sélectionnez les niveaux d'enseignement de l'école de l'utilisateur
    $query = "SELECT * FROM niveau_enseignement WHERE nom_ecole = '$nomEcole'  and champ_visible=1 ORDER BY id_niveau DESC";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Affichez les niveaux d'enseignement de l'école de l'utilisateur
    echo '<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Voir la liste des niveaux d\'enseignements</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Nom du Prof</th>
                        <th>Prenom du prof</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Matiere</th>
                        <th>Classe</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['nom_prof'] . '</td>';
        echo '<td>' . $row['prenom_prof'] . '</td>';
        echo '<td>' . $row['dates'] . '</td>';
        echo '<td>' . $row['contenu'] . '</td>';
        echo '<td>' . $row['matiere'] . '</td>';
        echo '<td>' . $row['classe'] . '</td>';
        echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="niveau_admin_searchfrm.php?action=edit & id=' . $row['id_niveau'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                            </div>
                          </div> </td>';
        echo '</tr> ';
    }

    echo '</tbody>
          </table>
        </div>
      </div>
    </div>';
} else {
    // Redirigez vers une page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}


                      echo '</tr> ';
                      
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
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une niveau d'enseignement</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="niveau_transac.php?action=add">
        <form role="form" method="post" action="">
                          <div class="form-group">
                              <input class="form-control" placeholder="Nom Professeur" name="nom_prof" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom Professeur" name="prenom_prof" required>
                            </div>
                            <div class="form-group">
                              <input type="datetime-local" class="form-control" placeholder="Date" name="dates" required>
                            </div>
                            <div class="form-group">
                              <input  class="form-control" placeholder="Contenu" name="contenu" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Matiere" name="matiere" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Classe" name="classe" required>
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
include'../includes/footer.php';
?>