<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM antenne WHERE id_antenne = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Antenne supprimez avec succès.");window.location = "antenne.php";</script>					
  