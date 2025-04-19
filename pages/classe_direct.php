<?php
include'../includes/connection.php';
include'../includes/sidebar_direct.php';
?>
<?php
$sqlforjob = "SELECT DISTINCT filiere, id_filiere FROM filiere order by id_filiere asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_filiere = "<select class='form-control' name='id_filiere' required>
        <option value='' disabled selected hidden>Selectionnez la filiere</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_filiere .= "<option value='".$row['id_filiere']."'>".$row['filiere']."</option>";
  }

$id_filiere .= "</select>";
?>
<!--debut de l'anneé-->
<?php
$sqlforjob = "SELECT DISTINCT debut_annee, id_annee FROM annee_scolaire order by id_annee asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_debut_annee = "<select class='form-control' name='id_annee' required>
        <option value='' disabled selected hidden>Selectionnez le debut de l'anneé</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_debut_annee .= "<option value='".$row['id_annee']."'>".$row['debut_annee']."</option>";
  }

  $id_debut_annee .= "</select>";
?>
<!--debut de l'anneé-->
<?php
$sqlforjob = "SELECT DISTINCT fin_annee, id_annee FROM annee_scolaire order by id_annee asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_fin_annee = "<select class='form-control' name='id_annee' required>
        <option value='' disabled selected hidden>Selectionnez la fin de l'anneé</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_fin_annee .= "<option value='".$row['id_annee']."'>".$row['fin_annee']."</option>";
  }

  $id_fin_annee .= "</select>";
?>
<!--Antenne-->
<?php
$sqlforjob = "SELECT DISTINCT nom, id_antenne FROM antenne order by id_antenne asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_antenne = "<select class='form-control' name='id_antenne' required>
        <option value='' disabled selected hidden>Selectionnez l'antenne</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_antenne .= "<option value='".$row['id_antenne']."'>".$row['nom']."</option>";
  }

  $id_antenne .= "</select>";
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
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez une classe&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>code_classe</th>
                        <th>libelle_classe</th>
                        <th>Debut Anneé</th>
                        <th>Fin Anneé</th>
                        <th>Nom de l'antenne</th>
                        <th>Filière</th>
                        <th>Niveau</th>
                        <th>Action</th>
                        
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT c.id_classe,f.id_filiere,t.id_antenne,a.id_annee, c.code_classe,c.libelle_classe,c.niveau,a.debut_annee,a.fin_annee,t.nom,f.filiere  FROM classe c,annee_scolaire a,filiere f,antenne t 
                      where c.id_filiere=f.id_filiere and c.id_antenne=t.id_antenne and c.id_annee=a.id_annee';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['code_classe'].'</td>';
                      echo '<td>'. $row['libelle_classe'].'</td>';
                      echo '<td>'. $row['debut_annee'].'</td>';
                      echo '<td>'. $row['fin_annee'].'</td>';
                      echo '<td>'. $row['nom'].'</td>';
                      echo '<td>'. $row['filiere'].'</td>';
                      echo '<td>'. $row['niveau'].'</td>';
                      
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="classe_direct_searchfrm.php?action=edit & id='.$row['id_classe'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="classe_direct_edit.php?action=edit & id='.$row['id_classe']. '">
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
          <form role="form" method="post" action="classe_transac1.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Code Classe" name="code_classe" required>
           </div>
           <div class="form-group">
             <input class="form-control" placeholder="Libelle Classe" name="libelle_classe" required>
           </div>
           <div class="form-group">
           <?php
                  echo $id_filiere;
                ?>
           </div>
           <div class="form-group">
           <?php
                  echo $id_debut_annee;
                ?>
           </div>
           <div class="form-group">
           <?php
                  echo $id_fin_annee;
                ?>
           </div>
           <div class="form-group">
           <?php
                  echo $id_antenne;
                ?>
           </div>
           <div class="form-group">
                        <select class="form-control" name="niveau" required>
                            <option>DUT1</option>
                            <option>DUT2</option>
                            <option>LICENCE</option>
                            <option>MASTER1</option>
                            <option>MASTER2</option>
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
    function confirmBlock(id_classe) {
        var confirmBlock = confirm("Voulez-vous vraiment supprimer cette Classe ?");
        if (confirmBlock) {
            window.location.href = "classe_del.php?id=" + id_classe;
        }
    }
</script>