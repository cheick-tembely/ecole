<?php
include'../includes/connection.php';
include'../includes/sidebar_prof.php';
?>
<?php
$sqlforjob = "SELECT DISTINCT nom_professeur, prenom_professeur,id_professeur FROM professeur order by id_professeur asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_professeur = "<select class='form-control' name='id_professeur' required>
        <option value='' disabled selected hidden>Selectionnez le Professeur</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_professeur .= "<option value='".$row['id_professeur']."'>".$row['nom_professeur']." ".$row['prenom_professeur']."</option>";
  }

$id_professeur .= "</select>";
?>
<?php
$sqlforjob = "SELECT DISTINCT libelle_matiere,id_matiere FROM matiere order by id_matiere asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_matiere = "<select class='form-control' name='id_matiere' required>
        <option value='' disabled selected hidden>Selectionnez la matiere</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_matiere .= "<option value='".$row['id_matiere']."'>".$row['libelle_matiere']."</option>";
  }

$id_matiere .= "</select>";
?>
<?php
$sqlforjob = "SELECT DISTINCT libelle_classe,id_classe FROM classe order by id_classe asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$id_classe = "<select class='form-control' name='id_classe' required>
        <option value='' disabled selected hidden>Selectionnez la classe</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $id_classe .= "<option value='".$row['id_classe']."'>".$row['libelle_classe']."</option>";
  }

$id_classe .= "</select>";
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
              <h4 class="m-2 font-weight-bold text-primary">Enregistrez une Fiches de pointage&nbsp;<a  href="#" data-toggle="modal" data-target="#customerModal1" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
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
                     

                     // Requête SQL pour récupérer les pointages du professeur connecté
                     $query = "SELECT id_pointage, pr.nom_professeur,pr.prenom_professeur, DATE_FORMAT(dates,'%d-%m-%Y') as dates, c.libelle_classe, m.libelle_matiere, debut, fin, observation  FROM pointage p, professeur pr,matiere m,classe c where p.id_professeur= pr.id_professeur
                     and p.id_matiere=m.id_matiere and c.id_classe=p.id_classe";
                     $result = mysqli_query($db, $query) or die(mysqli_error($db));
        
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
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="fiche_searchfrm.php?action=edit & id='.$row['id_pointage'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
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
          
          <div class="modal fade" id="customerModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Fiche de pointage</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="fiche_transac.php?action=add">
                          <div class="form-group">
                          <?php
                  echo $id_professeur;
                ?>
                            </div>
                            <div class="form-group">
                              <input type="date" class="form-control" placeholder="Date" name="dates" required>
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
                              <input type="time" class="form-control" placeholder="Debut" name="debut" required>
                            </div>
                             <div class="form-group">
                              <input type="time" class="form-control" placeholder="Fin" name="fin" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Titre du cours" name="observation" required>
                            </div>
                          
                            
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>      
          </form>  
        </div>
        </div>
<?php
include'../includes/footer.php';
?>