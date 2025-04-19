<?php
include'../includes/connection.php';
include'../includes/sidebar_cens.php';

?><?php 

                $query = 'SELECT id_user, t.niveau
                          FROM utilisateur u
                          JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                                    
}   
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Voir la liste des absences</h4>
              
            </div>
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Exportez la liste des absences&nbsp;<a  href="fonction_csv.php" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fa fa-file-excel"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Nom du Prof</th>
                        <th>Prenom du prof</th>
                        <th>Nom Etudiant</th>
                        <th>Prenom Etudiant</th>
                        <th>Classe</th>
                        <th>Matiere</th>
                        <th>Date</th>
                        <th>Justifier</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM absence order by id_absence desc ';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['nom'].'</td>';
                      echo '<td>'. $row['prenom'].'</td>';
                      echo '<td>'. $row['nom_etudiant'].'</td>';
                      echo '<td>'. $row['prenom_etudiant'].'</td>';
                      echo '<td>'. $row['classe'].'</td>';
                      echo '<td>'. $row['matiere'].'</td>';
                      echo '<td>'. $row['dates'].'</td>';
                      echo '<td>'. $row['justifier'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="absence_cens_searchfrm.php?action=edit & id='.$row['id_absence'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                             
                            <ul class="dropdown-menu text-center" role="menu">
                              
                              
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
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Absence</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="absence_transac.php?action=add">
        <form role="form" method="post" action="">
                          <div class="form-group">
                              <input class="form-control" placeholder="Nom Professeur" name="nom" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom Professeur" name="prenom" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Nom Etudiant" name="nom_etudiant" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom Etudiant" name="prenom_etudiant" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Classe" name="classe" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Matiere" name="matiere" required>
                            </div>
                            <div class="form-group">
                              <input type="datetime-local" class="form-control" placeholder="Date" name="dates" required>
                            </div>
                            <div class="form-group">
                              <input  class="form-control" placeholder="Justifier oui ou non" name="justifier" required>
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