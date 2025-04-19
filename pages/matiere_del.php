<?php
include'../includes/connection.php';

include'../includes/sidebar.php';

  $query = 'SELECT id_user, n.niveau
            FROM utilisateur u
            JOIN niveau  n ON n.id_niveau=u.id_niveau WHERE id_user = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  

	
						
    
    			$query = 'DELETE FROM matiere WHERE id_matiere = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Matiere supprimez avec succès.");window.location = "matiere.php";</script>					
            <?php
    			//break;
          

?>