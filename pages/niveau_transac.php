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
                   

                                   
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['nom_prof'];
              $lname = $_POST['prenom_prof'];
              $ne = $_POST['dates'];
              $sp = $_POST['contenu'];
              $ns = $_POST['matiere'];
              $ad = $_POST['classe'];
              $nom_ecole = $_POST['nom_ecole'];
        
              mysqli_query($db,"INSERT INTO niveau_enseignement
              (id_niveau, nom_prof,prenom_prof,dates,contenu,matiere,classe,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$ad','$nom_ecole')");

            ?>
              <script type="text/javascript">
                window.location = "niveau.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>