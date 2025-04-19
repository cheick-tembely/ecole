<?php
include'../includes/connection.php';

?>
            <?php
              $fname = $_POST['libelle_matiere'];
              $lname = $_POST['professeur'];
           
              $fl = $_POST['filiere'];
              $g = $_POST['niveau_enseignement'];
              
           
              
              mysqli_query($db,"INSERT INTO matiere
                              (id_matiere, libelle_matiere,professeur,filiere,niveau_enseignement)
                              VALUES (Null,'$fname','$lname','$fl','$g')");
             
              header('location:matiere_direct.php');
            ?>