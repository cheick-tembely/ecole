<?php
include'../includes/connection.php';
include'../includes/sidebar_prof.php';
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
  $query = 'SELECT * FROM absence WHERE id_absence='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_absence'];
      $i= $row['nom'];
      $a=$row['prenom'];
      $b=$row['nom_etudiant'];
      $c=$row['prenom_etudiant'];
      $d=$row['classe'];
      $ad=$row['matiere'];
      $da=$row['dates'];
      $ju=$row['justifier'];
    }
  
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail D'une Absence</h4>
            </div>
            <a href="absence.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom et Prenom du Professeur<br>
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
                        Nom de l'étudiant<br>
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
  Prenom de l'étudiant<br>
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
  Classe<br>
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
    Matiere<br>
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
    Date<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $da; ?>  <br>
  </h5>
</div>

</div>
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
<h5>
Justifier<br>
 </h5>
</div>

<div class="col-sm-9">
<h5>
 : <?php echo $ju; ?> <br>
</h5>
</div>

</div> 

<?php
include'../includes/footer.php';
?>