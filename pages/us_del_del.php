<?php
include'../includes/connection.php';

?>
 <?php

    			$query = 'DELETE FROM utilisateur WHERE id_user = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Utilisateur supprimez avec succès.");window.location = "user_admin.php";</script>					
           
    			
            
	
