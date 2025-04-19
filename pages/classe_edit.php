<?php
include'../includes/connection.php';

include'../includes/sidebar_cens.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT * from classe where  id_classe ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_classe'];
      $i= $row['code_classe'];
      $a=$row['libelle_classe'];
      $niv=$row['niveau'];
      $ann=$row['annee_scolaire'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Classe</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="classe_cens.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="classe_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Code Classe:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Code Classe" name="code_classe" value="<?php echo $i; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Libelle Classe:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Libelle Classe" name="libelle_classe" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Anneé Scolaire:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Anneé Scolaire" name="annee_scolaire" value="<?php echo $ann; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                Niveau:
                </div>
              <div class="col-sm-9">
                  <select class='form-control' name='niveau' required>
                    <option value="" disabled selected hidden>Selectionnez le Niveau</option>
                    <option>CG</option>
                            <option>SCIENCE</option>
                            <option>SES</option>
                            <option>LETTRE</option>
                            <option>TSE</option>
                            <option>TSEXP</option>
                            <option>TSS</option>
                            <option>TSECO</option>
                            <option>TLL</option>
                            <option>TAL</option>
                  </select>
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