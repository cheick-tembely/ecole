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
              $fname = $_POST['nom_professeur'];
              $lname = $_POST['prenom_professeur'];
              $ne = $_POST['telephone1'];
              $sp = $_POST['telephone2'];
              $ns = $_POST['email'];
              $ad = $_POST['ville'];
              $pn = $_POST['profession']; 
              $th = $_POST['employeur'];
              $dd = $_POST['dernier_diplome'];
              $nom_ecole = $_POST['nom_ecole'];
              mysqli_query($db,"INSERT INTO professeur
              (id_professeur, nom_professeur,prenom_professeur,telephone1,telephone2,email,ville,profession,employeur,dernier_diplome,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$ad','$pn','$th','$dd','$nom_ecole')");

            ?>
              <script type="text/javascript">
                window.location = "prof_secre.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>