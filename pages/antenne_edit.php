<?php
include'../includes/connection.php';

include'../includes/sidebar.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * FROM antenne WHERE id_antenne ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_antenne'];
      $i= $row['region'];
      $a=$row['ville'];
      $b=$row['quartier'];
      $c=$row['nom'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Antenne</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="annee_scolaire.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="antenne_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Region:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Region" name="region" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Ville:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Ville" name="ville" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Quartier:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Quartier" name="quartier" value="<?php echo $b; ?>" required>
                </div>
                <div class="col-sm-3" style="padding-top: 5px;">
                 Nom:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Nom" name="nom" value="<?php echo $c; ?>" required>
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