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
              $fname = $_POST['id_professeur'];
              $lname = $_POST['dates'];
              $pn = $_POST['id_classe'];
              $ne = $_POST['id_matiere'];
              $sp = $_POST['debut'];
              $ad = $_POST['fin'];
              $ns = $_POST['observation'];
            
        
              mysqli_query($db,"INSERT INTO pointage
              (id_pointage, id_professeur,dates,id_classe,id_matiere,debut,fin,observation)
              VALUES (Null,'$fname','$lname','$pn','$ne','$sp','$ad','$ns')");

            ?>
              <script type="text/javascript">
                window.location = "fiche_prof.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>