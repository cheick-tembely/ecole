<?php
include'../includes/connection.php';

?>
            <?php
              $fname = $_POST['libelle_matiere'];
             
           
              
              
           
              
              mysqli_query($db,"INSERT INTO matiere
                              (id_matiere, libelle_matiere)
                              VALUES (Null,'$fname')");
             
              header('location:matiere_secre.php');
            ?>