<?php
include'../includes/connection.php';

include'../includes/sidebar_direct.php';

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  
  $query = 'SELECT c.id_classe,f.id_filiere,t.id_antenne,a.id_annee, c.code_classe,c.libelle_classe,c.niveau,a.debut_annee,a.fin_annee,t.nom,f.filiere  FROM classe c,annee_scolaire a,filiere f,antenne t 
  where c.id_filiere=f.id_filiere and c.id_antenne=t.id_antenne and c.id_annee=a.id_annee and id_classe ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_classe'];
      $i= $row['code_classe'];
      $a=$row['libelle_classe'];
      $niv=$row['niveau'];
      $b=$row['filiere'];
      $d=$row['debut_annee'];
      $f=$row['fin_annee'];
      $n=$row['nom'];
    
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Modifiez une Classe</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="classe_direct.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
         
            <form role="form" method="post" action="classe_direct_edit1.php">
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
                Niveau:
                </div>
              <div class="col-sm-9">
                  <select class='form-control' name='niveau' required>
                    <option value="" disabled selected hidden>Selectionnez le Niveau</option>
                    <option>DUT1</option>
                    <option>DUT2</option>
                    <option>LICENCE</option>
                    <option>MASTER1</option>
                    <option>MASTER2</option>
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