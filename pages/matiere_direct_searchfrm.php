<?php
include'../includes/connection.php';

include'../includes/sidebar_direct.php';
$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['niveau'];
                   
          
}
$query = 'SELECT * FROM matiere WHERE id_matiere ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_matiere'];
      $i= $row['libelle_matiere'];
   
      $fl =$row['filiere'];
      $g =$row['niveau_enseignement'];
   
    }
      $id = $_GET['id'];
?>
          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail de la Matière</h4>
            </div>
            <a href="matiere_direct.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
          

                
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Matière<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $i; ?>  <br>
                        </h5>
                      </div>
                    </div>
                
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Filière Enseignèe<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $fl; ?> <br>
                        </h5>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                        Niveau Enseignement<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $g; ?> <br>
                        </h5>
                      </div>
                    </div>

                      
                    </div>

            </div>
         

<?php
include'../includes/footer.php';
?>