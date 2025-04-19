<?php

include'../includes/connection.php';

			$zz = $_POST['id'];
			$fname = $_POST['libelle_matiere'];
            
	 			$query = 'UPDATE matiere  set libelle_matiere="'.$fname.'" WHERE
				 id_matiere ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("Matière modifiez avec succés.");
			window.location = "matiere.php";
		</script>