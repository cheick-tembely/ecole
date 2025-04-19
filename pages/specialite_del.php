<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM specialite WHERE id_specialite = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Spécialité supprimez avec succès.");window.location = "specialite.php";</script>					
  