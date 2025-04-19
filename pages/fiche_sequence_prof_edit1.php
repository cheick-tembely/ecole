<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['domaine'];
		    $lname = $_POST['competence'];
			$niv = $_POST['titre'];
            $b=$_POST['activite'];
            $ann=$_POST['annee_scolaire'];
		
	 			$query = 'UPDATE fiche_sequence set domaine ="'.$fname.'",
				 competence ="'.$lname.'",titre="'.$niv.'",activite="'.$b.'" ,annee_scolaire="'.$ann.'" WHERE
				 id_fiche ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Fiche de sequence modifiez avec succès.");
			window.location = "fiche_sequence_prof.php";
		</script>