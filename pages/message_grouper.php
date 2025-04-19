<?php
include'../includes/connection.php';
include'../includes/sidebar_parent.php';
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
              <h4 class="m-2 font-weight-bold text-primary"> Message Grouper aux Parents d'Elèves</h4>
              
            </div>
           
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Nom Envoyeur</th>
                        <th>Prenom Envoyeur</th>
                        <th>Poste Envoyeur</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM message_grouper where champ_visible=1 order by id_message desc ';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['nom_envoyeur'].'</td>';
                      echo '<td>'. $row['prenom_envoyeur'].'</td>';
                      echo '<td>'. $row['poste_envoyeur'].'</td>';
                      echo '<td>'. $row['message'].'</td>';
                      echo '<td>'. $row['date_creation'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                      <a type="button" class="btn btn-primary bg-gradient-primary" href="message_grouper_searchfrm.php?action=edit & id='.$row['id_message'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
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
    function confirmBlock(id_etudiant) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer ce Professeur ?");
        if (confirmBlock) {
            window.location.href = "prof_del.php?id=" + id_etudiant;
        }
    }
</script>
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Envoyer un Message Grouper</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="message_gouper_cens_transac.php?action=add">
        <form role="form" method="post" action="">
                          <div class="form-group">
                              <input class="form-control" placeholder="Nom Envoyeur" name="nom_envoyeur" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Prenom Envoyeur" name="prenom_envoyeur" required>
                            </div>
                            <div class="form-group">
                        <select class="form-control" name="poste_envoyeur" required>
                            <option>Administrateur Principal</option>
                            <option>Promoteur</option>
                            <option>Proviseur</option>
                            <option>Censeur</option>
                            <option>Surveillant</option>
                        </select>
                    </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Message" name="message" required>
                            </div>
                            <div class="form-group">
                              <input type="datetime-local" class="form-control" placeholder="Date" name="date_creation" required>
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