<?php
include'../includes/connection.php';

include'../includes/sidebar_direct.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * FROM annee_scolaire WHERE id_annee ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_annee'];
      $i= $row['debut_annee'];
      $a=$row['fin_annee'];
      $b=$row['etat_annee'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Anneé Scolaire</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="annee_scolaire_direct.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="annee_direct_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Debut Anneé:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Debut Anneé" name="debut_annee" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Fin Anneé:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Fin Anneé" name="fin_annee" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Etat:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Etat" name="etat_annee" value="<?php echo $b; ?>" required>
                </div>
              </div>
             
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>