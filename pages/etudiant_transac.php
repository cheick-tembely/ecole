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
                   

                                   
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['nom'];
              $lname = $_POST['prenom'];
              $ne = $_POST['telephone'];
              $sp = $_POST['nom_tuteur'];
              $ns = $_POST['prenom_tuteur'];
              $ad = $_POST['telephone_tuteur'];
              $pn = $_POST['classe']; 
              $se = $_POST['sexe']; 
              $date = $_POST['date_naiss']; 
              $stat = $_POST['statut']; 
              $nom_ecole = $_POST['nom_ecole'];
        
              mysqli_query($db,"INSERT INTO etudiant
              (id_etudiant, nom,prenom,telephone,nom_tuteur,prenom_tuteur,telephone_tuteur,classe,sexe,date_naiss,statut,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$ad','$pn','$se','$date','$stat','$nom_ecole')");

            ?>
              <script type="text/javascript">
                window.location = "etudiant.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>