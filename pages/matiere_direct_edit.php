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

// JOB SELECT OPTION TAB




        $query = 'SELECT id_matiere,libelle_matiere,filiere,niveau_enseignement from matiere WHERE id_matiere ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
          {   
            $zz = $row['id_matiere'];
            $fname = $row['libelle_matiere'];

            $fl =$row['filiere'];
            $g =$row['niveau_enseignement'];
         
          }
            $id = $_GET['id'];
      ?>
  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Matière</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="matiere_direct.php"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
          
            <form role="form" method="post" action="matiere_direct_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Matière:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Matière" name="libelle_matiere" value="<?php echo $fname; ?>" required>
                </div>
              </div>
          
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Filière Enseignèe:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Filière Enseignèe" name="filiere" value="<?php echo $fl; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Niveau Enseignement:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Niveau Enseignement" name="niveau_enseignement" value="<?php echo $g; ?>" required>
                </div>
              </div>
              <hr>
                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Modifiez</button>    
              </form>  
                    
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>