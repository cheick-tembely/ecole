<?php
include'../includes/connection.php';
include'../includes/sidebar_compt.php';
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
              <h4 class="m-2 font-weight-bold text-primary">Liste des professeurs</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Profession</th>
                        <th>Niveau_etude</th>
                        <th>Specialiter</th>
                        <th>Adresse</th>
                        <th>Niveau Enseignement</th>
                        <th>Taux Horaire en %</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM professeur';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['nom_professeur'].'</td>';
                      echo '<td>'. $row['prenom_professeur'].'</td>';
                      echo '<td>'. $row['profession'].'</td>';
                      echo '<td>'. $row['niveau_etude'].'</td>';
                      echo '<td>'. $row['Specialiter'].'</td>';
                      echo '<td>'. $row['adresse'].'</td>';
                      echo '<td>'. $row['niveau_enseignement'].'</td>';
                      echo '<td>'. $row['taux_horaire'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="prof_compt_searchfrm.php?action=edit & id='.$row['id_professeur'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="fpdf/prof_print.php?action=edit & id='.$row['id_professeur']. '">
                                    <i class="fas fa-fw fa-print"></i> Imprimez
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

<?php
include'../includes/footer.php';
?>