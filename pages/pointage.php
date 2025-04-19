<?php
include'../includes/connection.php';

include'../includes/sidebar.php';
$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['niveau'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Fiches de pointage</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                   <th>Nom </th>
                      <th>Prenom </th>
                     <th>code Classe</th>
                     <th>Matière</th>
                     <th>  Debut</th>
                     <th> Fin</th> 
                     <th>Statut</th>
                     <th>Commentaire</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur,c.code_classe, m.libelle_matiere, date_debut, date_fin,p.statut, commentaire  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
    and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

     while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>'. $row['nom_professeur'].'</td>';
     echo '<td>'. $row['prenom_professeur'].'</td>';
echo '<td>'. $row['code_classe'].'</td>';
echo '<td>'. $row['libelle_matiere'].'</td>';
echo '<td>'. $row['date_debut'].'</td>';
echo '<td>'. $row['date_fin'].'</td>';
echo '<td>'. $row['statut'].'</td>';
echo '<td>'. $row['commentaire'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                      <a type="button" class="btn btn-primary bg-gradient-primary" href="pointage_searchfrm.php?action=edit & id='.$row['id_pointage'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                      <div class="btn-group">
                        <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                        ... <span class="caret"></span></a>
                      <ul class="dropdown-menu text-center" role="menu">
                         
                          <li>
                          <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="fpdf/print.php?action=edit & id='.$row['id_pointage']. '">
                            <i class="fas fa-fw fa-print"></i> Imprimez
                          </a>
                        </li>
                        <li>
                                <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pointage_del.php?id='.$row['id_pointage']. '">
                                  <i class="fa fa-trash fa-fw"></i> Supprimez
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
