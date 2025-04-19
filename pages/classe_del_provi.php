<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM classe WHERE id_classe = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Classe supprimez avec succès.");window.location = "classe_provi.php";</script>					
  