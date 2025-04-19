<?php
include'../includes/connection.php';
include'../includes/sidebar_consult.php';
?><?php 

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
              <h4 class="m-2 font-weight-bold text-primary"> Detail Du Classe</h4>
            </div>
            <a href="classe_consult.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                        Code Classe<br>
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
                        Libelle Classe<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a; ?> <br>
                        </h5>
                      </div>
                      
                    </div>
  <div class="form-group row text-left">

   <div class="col-sm-3 text-primary">
  <h5>
    Filière<br>
    </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $b; ?> <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Debut Anneé<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $d; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Fin Anneé<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $f; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Antenne<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $n; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Niveau<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $niv; ?>  <br>
  </h5>
</div>

</div>

<?php
include'../includes/footer.php';
?>