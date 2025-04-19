<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
			$fname = $_POST['jour'];
		    $lname = $_POST['heure_debut'];
			$niv = $_POST['heure_fin'];
            $b=$_POST['volume'];
		
	 			$query = 'UPDATE attribution set jour ="'.$fname.'",
				 heure_debut ="'.$lname.'",heure_fin="'.$niv.'",volume="'.$b.'" WHERE
				 id_attribution ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("Attribution modifiez avec succès.");
			window.location = "attri.php";
		</script>