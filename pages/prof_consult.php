<?php
include'../includes/connection.php';
include'../includes/sidebar_consult.php';

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
              <h4 class="m-2 font-weight-bold text-primary">Exportez la liste des Professeurs&nbsp;<a  href="fonction_csv1.php" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fa fa-file-excel"></i></a></h4>
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
                        <th>Employeur</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM professeur order by id_professeur desc ';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
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
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="prof_consult_searchfrm.php?action=edit & id='.$row['id_professeur'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            
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