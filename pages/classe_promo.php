<?php
include'../includes/connection.php';
include'../includes/sidebar_promo.php';
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
              <h4 class="m-2 font-weight-bold text-primary">Listes des Classes</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>code_classe</th>
                        <th>libelle_classe</th>
                        <th>Anneé Scolaire</th>
                        <th>Niveau</th>
                       
                        
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * from classe';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['code_classe'].'</td>';
                      echo '<td>'. $row['libelle_classe'].'</td>';
                      echo '<td>'. $row['annee_scolaire'].'</td>';
                      echo '<td>'. $row['niveau'].'</td>';                  
                    
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
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Classe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="classe_transac.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Code Classe" name="code_classe" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Libelle Classe" name="libelle_classe" required>
           </div>
  
           <div class="form-group">
                        <select class="form-control" name="niveau" required>
                            <option>CG</option>
                            <option>SCIENCE</option>
                            <option>SES</option>
                            <option>LETTRE</option>
                            <option>TSE</option>
                            <option>TSEXP</option>
                            <option>TSS</option>
                            <option>TSECO</option>
                            <option>TLL</option>
                            <option>TAL</option>
                        </select>
                    </div>
                    <div class="form-group">
             <input class="form-control" placeholder="Anneé Scolaire" name="annee_scolaire" required>
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
    function confirmBlock(id_classe) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette Classe ?");
        if (confirmBlock) {
            window.location.href = "classe_del.php?id=" + id_classe;
        }
    }
</script>