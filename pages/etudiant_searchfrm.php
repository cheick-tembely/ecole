<?php
include'../includes/connection.php';
include'../includes/sidebar_secre.php';
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
  $query = 'SELECT * FROM etudiant WHERE id_etudiant ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_etudiant'];
      $i= $row['nom'];
      $a=$row['prenom'];
      $b=$row['telephone'];
      $c=$row['nom_tuteur'];
      $d=$row['prenom_tuteur'];
      $ad=$row['telephone_tuteur'];
      $ns =$row['classe'];
      $se =$row['sexe'];
      $date =$row['date_naiss'];
      $stat =$row['statut'];
    }
  
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail De l'étudiant</h4>
            </div>
            <a href="etudiant.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom et Prenom de l'étudiant<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $i; ?> <?php echo $a; ?> <br>
                        </h5>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                        Telephone de l'étudiant<br>
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
  Nom du Tuteur<br>
    </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $c; ?> <br>
  </h5>
</div>

</div>
    
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
  Prenom du Tuteur<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $d; ?> <br>
  </h5>
</div>

</div> 
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Telephone du Tuteur<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $ad; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Classe<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $ns; ?>  <br>
  </h5>
</div>

</div> 
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Sexe<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $se; ?>  <br>
  </h5>
</div>

</div>  
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Date Naissance<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $date; ?>  <br>
  </h5>
</div>

</div>  
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Statut<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $stat; ?>  <br>
  </h5>
</div>

</div>  
<?php
include'../includes/footer.php';
?>