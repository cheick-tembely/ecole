<?php
include'../includes/connection.php';
include'../includes/sidebar_cens.php';
?><?php 

$query = 'SELECT id_user, t.niveau
FROM utilisateur u
JOIN niveau t ON t.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['niveau'];
                   

                                   
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['nom_envoyeur'];
              $lname = $_POST['prenom_envoyeur'];
              $ne = $_POST['poste_envoyeur'];
              $sp = $_POST['nom_destinateur'];
              $ns = $_POST['prenom_destinateur'];
              $ad = $_POST['poste_destinateur'];
              $pn = $_POST['motif']; 
              $da = $_POST['dates'];
              $nom_ecole = $_POST['nom_ecole'];
        
              mysqli_query($db,"INSERT INTO message
              (id_message, nom_envoyeur,prenom_envoyeur,poste_envoyeur,nom_destinateur,prenom_destinateur,poste_destinateur,motif,dates,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$ad','$pn','$da','$nom_ecole')");

            ?>
              <script type="text/javascript">
                window.location = "message_cens.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>