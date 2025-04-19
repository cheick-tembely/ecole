<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['code_classe'];
		    $lname = $_POST['libelle_classe'];
			$niv = $_POST['niveau'];
			$ann = $_POST['annee_scolaire'];
		
	 			$query = 'UPDATE classe set code_classe ="'.$fname.'",
				 libelle_classe ="'.$lname.'",niveau="'.$niv.'",annee_scolaire="'.$ann.'" WHERE
				 id_classe ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Classe modifiez avec succès.");
			window.location = "classe_cens.php";
		</script>