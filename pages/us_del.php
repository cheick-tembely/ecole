<?php

include '../includes/connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Mettre à jour le statut de l'utilisateur à 1 pour bloquer
    $query = "UPDATE utilisateur SET statut = 1 WHERE id_user = $userId";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if ($result) {
        echo '<script type="text/javascript">alert("Utilisateur bloqué avec succès.");window.location = "user_admin.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Erreur lors du blocage de l\'utilisateur.");window.location = "user_admin.php";</script>';
    }
} else {
    echo '<script type="text/javascript">alert("ID utilisateur non valide.");window.location = "user_admin.php";</script>';
}
?>

            

