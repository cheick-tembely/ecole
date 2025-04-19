<?php
include'../includes/connection.php';
include'../includes/sidebar_surv.php';
?>

<?php 

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
              <h4 class="m-2 font-weight-bold text-primary">Annèe Scolaire</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Debut Anneé</th>
                        <th>Fin Anneé</th>
                        <th>Etat</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM annee_scolaire';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['debut_annee'].'</td>';
                      echo '<td>'. $row['fin_annee'].'</td>';
                      echo '<td>'. $row['etat_annee'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="annee_surv_searchfrm.php?action=edit & id='.$row['id_annee'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                           
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

<?php
include'../includes/footer.php';
?>

  <!-- Product Modal-->
  <div class="modal fade" id="annModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez  une Anneé Scolaire</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="annee_scolaire_transac.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Debut Anneé" name="debut_annee" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Fin Anneé" name="fin_annee" required>
           </div>
           <div class="form-group">
                <select class="form-control"  name="etat_annee" required>
                  <option>en cours</option>
                  <option>fermer</option>
                      </select>
                 
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
  <script type="text/javascript">
    function confirmBlock(id_annee) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette Année Scolaire ?");
        if (confirmBlock) {
            window.location.href = "annee_scolaire_del.php?id=" + id_annee;
        }
    }
</script>