<?php
include('../includes/connection.php');
			$zz = $_POST['id'];
            $fname = $_POST['region'];
            $lname = $_POST['ville'];
            $pr = $_POST['quartier'];
            $nm = $_POST['nom'];
			
		
	 			$query = 'UPDATE antenne set region ="'.$fname.'",
				 ville ="'.$lname.'", quartier="'.$pr.'", nom="'.$nm.'" WHERE
				 id_antenne  ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	 <script type="text/javascript">
			alert("Antenne modifiez avec succès.");
			window.location = "antenne_direct.php";
		</script> 