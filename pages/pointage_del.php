<?php
include'../includes/connection.php';

          
	
    			$query = 'DELETE FROM pointage WHERE id_pointage = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Fiche de pointage supprimez avec succès.");window.location = "pointage.php";</script>					
            <?php
    			//break;
            
	
?>