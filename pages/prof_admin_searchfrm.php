<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
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
  $query = 'SELECT * FROM professeur WHERE id_professeur ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_professeur'];
      $i= $row['nom_professeur'];
      $a=$row['prenom_professeur'];
      $b=$row['telephone1'];
      $c=$row['telephone2'];
      $d=$row['email'];
      $ad=$row['ville'];
      $ns =$row['profession'];
      $th =$row['employeur'];
      $dd =$row['dernier_diplome'];
    }
  
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail Du Professeur</h4>
            </div>
            <a href="prof_admin.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom et Prenom<br>
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
                        Telephone1<br>
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
  Telephone2<br>
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
  Email<br>
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
    Ville<br>
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
    Profession<br>
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
    Employeur<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $th; ?>  <br>
  </h5>
</div>

</div>  
<div class="form-group row text-left">

<div class="col-sm-3 text-primary">
  <h5>
    Dernier Diplome<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $dd; ?>  <br>
  </h5>
</div>

</div>   

<?php
include'../includes/footer.php';
?>