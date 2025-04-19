<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM filiere WHERE id_filiere = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Filière supprimez avec succès.");window.location = "filiere.php";</script>					
  