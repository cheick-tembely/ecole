<?php

include'../includes/connection.php';

	
    			$query = 'DELETE FROM attribution WHERE id_attribution = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Attribution supprimez avec succès.");window.location = "attri.php";</script>					
  