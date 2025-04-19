<?php

include('../includes/connection.php');

			$zz = $_POST['id'];
			$a = $_POST['nom_user'];
            $b = $_POST['prenom_user'];
            $c = $_POST['Genre'];
            $d = $_POST['email_user'];
            $e = $_POST['login'];
            $f = $_POST['password'];
			$s = $_POST['statut'];
	 			$query = 'UPDATE utilisateur  
	 						set nom_user="'.$a.'", prenom_user="'.$b.'", GENDER="'.$c.'", email_user="'.$d.'", login="'.$e.'",PASSWORD = sha1("'.$f.'"),statut="'.$s.'" WHERE
					id_user ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));							
?>
				<script type="text/javascript">
	                alert("l'utilisateur modifiez avec succès.");
	                window.location = "user_direct.php";
            	</script>