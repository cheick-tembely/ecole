<?php
include'../includes/connection.php';
include'../includes/sidebar_provi.php';
?>
<?php
$sqlforjob = "SELECT DISTINCT libelle_classe, id_classe FROM classe order by id_classe asc";
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
$sqlforjob = "SELECT DISTINCT libelle_matiere, id_matiere FROM matiere order by id_matiere asc";
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
$sqlforjob = "SELECT DISTINCT nom_professeur,prenom_professeur, id_professeur FROM professeur order by id_professeur asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_professeur = "<select class='form-control' name='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le professeur</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='".$row['id_professeur']."'>".$row['nom_professeur'] .' '. $row['prenom_professeur']."</option>";
  }

  $id_professeur .= "</select>";
?>
<!--Antenne-->

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
              <h4 class="m-2 font-weight-bold text-primary">Emploi du Temps des Professeurs&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Classe</th>
                        <th>Matière</th>
                        <th>Nom </th>
                        <th>Prenom </th>
                        <th>Jour</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Année Scolaire</th>
                        <th>Action</th>
                        
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
$query = 'SELECT at.id_emploi, m.id_matiere, m.libelle_matiere, p.id_professeur, p.nom_professeur, p.prenom_professeur, c.id_classe, c.code_classe, at.jour, at.heure_debut, at.heure_fin, at.annee_scolaire  
FROM emploi at 
JOIN classe c ON at.id_classe = c.id_classe 
JOIN matiere m ON at.id_matiere = m.id_matiere 
JOIN professeur p ON at.id_professeur = p.id_professeur 
WHERE at.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'") and at.champ_visible=1';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
                      $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
                      $nom_ecole = $row_ecole['nom_ecole'];
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['code_classe'].'</td>';
                      echo '<td>'. $row['libelle_matiere'].'</td>';
                      echo '<td>'. $row['nom_professeur'].'</td>';
                      echo '<td>'. $row['prenom_professeur'].'</td>';
                      echo '<td>'. $row['jour'].'</td>';
                      echo '<td>'. $row['heure_debut'].'</td>';
                      echo '<td>'. $row['heure_fin'].'</td>';
                      echo '<td>'. $row['annee_scolaire'].'</td>';
                      
                      echo '<td align="right"> <div class="btn-group">
                      <a type="button" class="btn btn-primary bg-gradient-primary" href="emploi_provi_searchfrm.php?action=edit & id='.$row['id_emploi'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="emploi_provi_edit.php?action=edit & id='.$row['id_emploi']. '">
                                    <i class="fas fa-fw fa-edit"></i> Modifiez
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



  <!-- Product Modal-->
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Elaboration des Empois du Temps</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="emploi_du_temps_provi_transac.php?action=add">
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
           <?php
                  echo $id_professeur;
                ?>
           </div>
           <div class="form-group">
                        <select class="form-control" name="jour" required>
                            <option>Lundi</option>
                            <option>Mardi</option>
                            <option>Mercredi</option>
                            <option>Jeudi</option>
                            <option>Vendredi</option>
                            <option>Samedi</option>
                        </select>
                    </div>
                    <div class="form-group">
             <input  type="time" class="form-control" placeholder="Heure Debut" name="heure_debut" required>
           </div>
           <div class="form-group">
             <input type="time" class="form-control" placeholder="Heure Fin" name="heure_fin" required>
           </div>
           <div class="form-group">
             <input   class="form-control" placeholder="Année Scolaire" name="annee_scolaire" required>
           </div>
           <div class="form-group">
    <input class="form-control" placeholder="Ecole" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
</div>
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Attribuer</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function confirmBlock(id_attribution) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette Attribution de matière ?");
        if (confirmBlock) {
            window.location.href = "attri_del.php?id=" + id_attribution;
        }
    }
</script>
<?php
include'../includes/footer.php';
?>