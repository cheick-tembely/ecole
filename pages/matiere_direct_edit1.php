<?php

include'../includes/connection.php';

			$zz = $_POST['id'];
			$fname = $_POST['libelle_matiere'];
            $lname = $_POST['professeur'];
			$fl = $_POST['filiere'];
            $g = $_POST['niveau_enseignement'];
	 			$query = 'UPDATE matiere  set libelle_matiere="'.$fname.'",
				 professeur="'.$lname.'",filiere="'.$fl.'",niveau_enseignement="'.$g.'" WHERE
				 id_matiere ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("Matière modifiez avec succés.");
			window.location = "matiere_direct.php";
		</script>