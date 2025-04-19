<?php
include'../includes/connection.php';
include'../includes/sidebar_provi.php';
?><?php 

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   

                                  
}   
  $query = 'SELECT * FROM message WHERE id_message ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['id_message'];
      $i= $row['nom_envoyeur'];
      $a=$row['prenom_envoyeur'];
      $b=$row['poste_envoyeur'];
      $c=$row['nom_destinateur'];
      $d=$row['prenom_destinateur'];
      $ad=$row['poste_destinateur'];
      $ns =$row['motif'];
      $da =$row['dates'];
    }
  
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Detail Du Message</h4>
            </div>
            <a href="message_provi.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Retour </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Nom et Prenom de l'envoyeur<br>
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
                        Poste de l'envoyeur<br>
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
  Nom du Destinataire<br>
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
  Prenom du Destinataire<br>
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
    Poste de Destinataire<br>
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
    Message<br>
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
    Date<br>
  </h5>
</div>

<div class="col-sm-9">
  <h5>
    : <?php echo $da; ?>  <br>
  </h5>
</div>

</div>    

<?php
include'../includes/footer.php';
?>