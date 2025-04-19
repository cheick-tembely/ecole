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
              $fname = $_POST['nom'];
              $lname = $_POST['prenom'];
              $ne = $_POST['nom_etudiant'];
              $sp = $_POST['prenom_etudiant'];
              $ns = $_POST['classe'];
              $ad = $_POST['matiere'];
              $pn = $_POST['dates']; 
              $ju = $_POST['justifier']; 
              $nom_ecole = $_POST['nom_ecole'];
        
              mysqli_query($db,"INSERT INTO absence
              (id_absence, nom,prenom,nom_etudiant,prenom_etudiant,classe,matiere,dates,justifier,nom_ecole)
              VALUES (Null,'$fname','$lname','$ne','$sp','$ns','$ad','$pn','$ju','$nom_ecole')");

            ?>
              <script type="text/javascript">
                window.location = "absence.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>