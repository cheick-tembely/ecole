<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';

// Vérifier si des données ont été envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'ID de la classe est présent dans les données postées
    if (isset($_POST['id_classe'])) {
        $id_classe = $_POST['id_classe'];

        // Parcourir les données postées pour récupérer les notes des étudiants
        foreach ($_POST['matiere'] as $id_etudiant => $matiere) {
            // Récupérer les notes des étudiants pour chaque matière
            $interrogation1 = $_POST['interrogation1'][$id_etudiant];
            $interrogation2 = $_POST['interrogation2'][$id_etudiant];
            $devoir1 = $_POST['devoir1'][$id_etudiant];
            $devoir2 = $_POST['devoir2'][$id_etudiant];
         
            $mois = $_POST['mois'][$id_etudiant];

            // Calculer le total des devoirs selon la logique spécifiée
            if ($interrogation2 != "" && $devoir2 != "" && $interrogation1 !="" && $devoir1 !="" ) {
                $total_devoirs = ($interrogation1 + $interrogation2 + $devoir1 + $devoir2 ) / 5;
            } elseif ($interrogation2 != "" && $devoir2 != ""&&$interrogation1 !=""&& $devoir1 !="" ) {
                $total_devoirs = ($interrogation1 + $interrogation2 + $devoir1 + $devoir2) / 4;
            } elseif ($interrogation2 == "" && $devoir2 == "" ) {
                $total_devoirs = ($interrogation1 + $devoir1 ) / 1.5;
            } 

            // Insérer les données dans la base de données
            $query_insert = "INSERT INTO notes (id_classe, id_etudiant, matiere, interrogation1, interrogation2, devoir1, devoir2, total_devoirs, mois) 
                             VALUES ($id_classe, $id_etudiant, '$matiere', $interrogation1, $interrogation2, $devoir1, $devoir2, $total_devoirs, '$mois')";
            mysqli_query($db, $query_insert) or die(mysqli_error($db));
        }

        // Rediriger vers une page de confirmation ou une autre page appropriée
        header('Location: note.php');
        exit();
    } else {
        // Rediriger vers une page d'erreur ou une autre page appropriée
        header('Location: erreur.php');
        exit();
    }
} else {
    // Rediriger vers une page d'erreur ou une autre page appropriée
    header('Location: erreur.php');
    exit();
}
?>
