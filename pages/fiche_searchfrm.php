<?php
include'../includes/connection.php';

include'../includes/sidebar_prof.php';
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
    
$query2 = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
        $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> L'ensembles des Fiches de pointage du professeur</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                   <th>Nom du Professeur</th>
                      <th>Prenom du Professeur</th>
                     <th>Date</th>
                     <th>Classe</th>
                     <th>Matière</th>
                     <th>Debut</th>
                     <th>Fin</th> 
                     <th>Titre du cours</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php   
 $query = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
 and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
                      echo '<td>'. $row['nom_professeur'].'</td>';
                      echo '<td>'. $row['prenom_professeur'].'</td>';
                echo '<td>'. $row['dates'].'</td>';
                echo '<td>'. $row['libelle_classe'].'</td>';
                echo '<td>'. $row['libelle_matiere'].'</td>';
                echo '<td>'. $row['debut'].'</td>';
                echo '<td>'. $row['fin'].'</td>';
                echo '<td>'. $row['observation'].'</td>';
                echo '<td align="right">
                      <a type="button" class="btn btn-warning bg-gradient-warning" href="fiche_edit.php?action=edit & id='.$row['id_pointage']. '"><i class="fas fa-fw fa-edit"></i> Modifiez</a>
                          </div></td>';
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