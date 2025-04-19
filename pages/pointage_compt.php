<?php
include'../includes/connection.php';

include'../includes/sidebar_compt.php';
?>
<?php
$sqlforjob = "SELECT DISTINCT libelle_classe, id_classe FROM classe where champ_visible=1 order by id_classe asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_classe = "<select class='form-control' name='id_classe' required>
        <option value='' disabled selected hidden>Selectionnez la classe</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_classe .= "<option value='".$row['id_classe']."'>".$row['libelle_classe']."</option>";
  }

$id_classe .= "</select>";
?>
<!--debut de l'anneé-->
<?php
$sqlforjob = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere  where champ_visible=1 order by id_matiere asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_matiere = "<select class='form-control' name='id_matiere' required>
        <option value='' disabled selected hidden>Selectionnez la matiere</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_matiere .= "<option value='".$row['id_matiere']."'>".$row['libelle_matiere']."</option>";
  }

  $id_matiere .= "</select>";
?>
<!--debut de l'anneé-->
<?php
$sqlforjob = "SELECT DISTINCT nom_professeur,prenom_professeur, id_professeur FROM professeur where champ_visible=1 order by id_professeur asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_professeur = "<select class='form-control' name='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le professeur</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='".$row['id_professeur']."'>".$row['nom_professeur'] .' '. $row['prenom_professeur']."</option>";
  }

  $id_professeur .= "</select>";
?>
<?php
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
              <h4 class="m-2 font-weight-bold text-primary">Voir les  Fiches de Pointage</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                   <th>Nom </th>
                      <th>Prenom </th>
                     <th>Code Classe</th>
                     <th>Matière</th>
                     <th>  Debut</th>
                     <th> Fin</th> 
                     <th>Statut</th>
                    
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = "SELECT id_pointage, pr.nom_professeur, pr.prenom_professeur, c.code_classe, m.libelle_matiere, date_debut, date_fin, p.statut  
    FROM pointage p
    JOIN professeur pr ON p.id_professeur = pr.id_professeur
    JOIN matiere m ON p.id_matiere = m.id_matiere
    JOIN classe c ON p.id_classe = c.id_classe
    WHERE p.nom_ecole = (SELECT nom_ecole 
                         FROM utilisateur 
                         WHERE nom_user = '".$_SESSION['nom_user']."' 
                         AND prenom_user = '".$_SESSION['prenom_user']."'
                         LIMIT 1) 
    AND p.champ_visible = 1";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'" LIMIT 1'));

    $nom_ecole = $row_ecole['nom_ecole'];
     while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>'. $row['nom_professeur'].'</td>';
     echo '<td>'. $row['prenom_professeur'].'</td>';
echo '<td>'. $row['code_classe'].'</td>';
echo '<td>'. $row['libelle_matiere'].'</td>';
echo '<td>'. $row['date_debut'].'</td>';
echo '<td>'. $row['date_fin'].'</td>';
echo '<td>'. $row['statut'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                      
                        <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                        ... <span class="caret"></span></a>
                      <ul class="dropdown-menu text-center" role="menu">
                         
                          <li>
                          <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="fpdf/print.php?action=edit & id='.$row['id_pointage']. '">
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
 <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Fiche de Pointage</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="pointage_surv_transac.php?action=add">
           <div class="form-group">
           <?php
                  echo $id_professeur;
                ?>
           </div>
            <div class="form-group">
           <?php
                  echo $id_classe;
                ?>
           </div>
           <div class="form-group">
           <?php
                  echo $id_matiere;
                ?>
           </div>
    
                    <div class="form-group">
             <input  type="datetime-local" class="form-control" placeholder="  Date Debut " name="date_debut" required>
           </div>
           <div class="form-group">
             <input type="datetime-local" class="form-control" placeholder="Date Fin" name="date_fin" required>
           </div>
           <div class="form-group">
                        <select class="form-control" name="statut" required>
                            <option>valider</option>
                            <option> non valider</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
        
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Valider</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function confirmBlock(id_pointage) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette fiche de pointage ?");
        if (confirmBlock) {
            window.location.href = "pointage_surv_del.php?id=" + id_pointage;
        }
    }
</script>