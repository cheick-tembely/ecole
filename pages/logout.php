<?php

session_start();

// Unset all the session variables
unset($_SESSION['MEMBER_ID']);
unset($_SESSION['nom_user']);
unset($_SESSION['prenom_user']);
unset($_SESSION['GENDER']);
unset($_SESSION['email_user']);

?>
<script type="text/javascript">
    window.location = "login.php";
</script>