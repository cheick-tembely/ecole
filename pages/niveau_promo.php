<?php
include'../includes/connection.php';
include'../includes/sidebar_promo.php';
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
              <h4 class="m-2 font-weight-bold text-primary">Voir la liste des niveaux d'enseignements des Professeurs</h4>
              
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
                       
                      
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM niveau_enseignement order by id_niveau desc ';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['nom_prof'].'</td>';
                      echo '<td>'. $row['prenom_prof'].'</td>';
                      echo '<td>'. $row['dates'].'</td>';
                      echo '<td>'. $row['contenu'].'</td>';
                      echo '<td>'. $row['matiere'].'</td>';
                      echo '<td>'. $row['classe'].'</td>';
                      
                     
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