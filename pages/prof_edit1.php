<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['nom_professeur'];
		    $lname = $_POST['prenom_professeur'];
			$pr = $_POST['telephone1'];
			$ne = $_POST['telephone2'];
			$sp=$_POST['email'];
			$ad=$_POST['ville'];
			$pn = $_POST['profession']; 
			$th = $_POST['employeur'];
			$dd = $_POST['dernier_diplome'];
		
	 			$query = 'UPDATE professeur set nom_professeur ="'.$fname.'",
				 prenom_professeur ="'.$lname.'", telephone1="'.$pr.'",telephone2="'.$ne.'",email="'.$sp.'",ville="'.$ad.'",profession="'.$pn.'",employeur="'.$th.'",dernier_diplome="'.$dd.'" WHERE
				 id_professeur ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("professeur modifiez avec succès.");
			window.location = "prof_cens.php";
		</script>