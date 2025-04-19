<?php
include'../includes/connection.php';

include'../includes/sidebar_consult.php';
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
                   <th>Nom du Professeur</th>
                      <th>Prenom du Professeur</th>
                     <th>Classe</th>
                     <th>Matière</th>
                     <th> Date et Heure de Debut</th>
                     <th>Date et Heure de Fin</th> 
                     <th>Statut</th>
                     <th>Commentaire</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur,c.libelle_classe, m.libelle_matiere, date_debut, date_fin,p.statut, commentaire  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
    and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

     while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>'. $row['nom_professeur'].'</td>';
     echo '<td>'. $row['prenom_professeur'].'</td>';
echo '<td>'. $row['libelle_classe'].'</td>';
echo '<td>'. $row['libelle_matiere'].'</td>';
echo '<td>'. $row['date_debut'].'</td>';
echo '<td>'. $row['date_fin'].'</td>';
echo '<td>'. $row['statut'].'</td>';
echo '<td>'. $row['commentaire'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                      <a type="button" class="btn btn-primary bg-gradient-primary" href="pointage_consult_searchfrm.php?action=edit & id='.$row['id_pointage'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                 
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
