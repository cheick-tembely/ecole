<?php
include('../includes/connection.php');

require_once('session.php');
			$zz = $_POST['id'];
			$a = $_POST['nom_user'];
            $b = $_POST['prenom_user'];
            
            $d = $_POST['email_user'];
         
            $f = $_POST['niveau'];
	 			$query = 'UPDATE utilisateur u 
	 						join niveau n on u.id_niveau=n.id_niveau
	 						set u.nom_user="'.$a.'", u.prenom_user="'.$b.'",  email_user="'.$d.'"  WHERE
					id_user ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
              <?php 

                $sql = 'SELECT id_user
                          FROM utilisateur';
                $result2 = mysqli_query($db, $sql) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result2)) {
                          $a = $row['id_user'];
                
        if ($_SESSION['niveau']=='Admin'){  ?>

             <script type="text/javascript">
                alert("Compte Utilisateur modifiez avec succès.");
                window.location = "index.php";
            </script>
            <?php

        }
        if ($_SESSION['niveau']=='Professeur'){  ?>

            <script type="text/javascript">
               alert("Compte Utilisateur modifiez avec succès.");
               window.location = "index_prof.php";
           </script>
           <?php

       }
       if ($_SESSION['niveau']=='Comptable'){  ?>

        <script type="text/javascript">
           alert("Compte Utilisateur modifiez avec succès.");
           window.location = "index_compt.php";
       </script>
       <?php

   }
?>

        <?php } ?>