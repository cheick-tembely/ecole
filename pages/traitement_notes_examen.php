<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connection.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $matieres = $_POST['matiere'];
    $total_devoirs = $_POST['total_devoir'];
    $examens = $_POST['examen'];
    $mois = $_POST['mois'];
    $trimestres = $_POST['trimestre']; // Ajout pour récupérer le trimestre

    // Préparer la requête d'insertion des notes d'examen avec le trimestre
    $sql_insert = "INSERT INTO note_examen (id_etudiant, matiere, total_devoir, examen, mois, trimestre) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($db, $sql_insert);

    // Vérifier si la préparation de l'instruction a réussi
    if ($stmt_insert) {
        // Boucler à travers les données du formulaire pour exécuter l'insertion
        foreach ($matieres as $id_etudiant => $matiere) {
            // Vérifier si la valeur de 'total_devoir' n'est pas null
            if (!is_null($total_devoirs[$id_etudiant])) {
                $total_devoir_value = mysqli_real_escape_string($db, $total_devoirs[$id_etudiant]);
                $examen_value = mysqli_real_escape_string($db, $examens[$id_etudiant]);
                $mois_value = mysqli_real_escape_string($db, $mois[$id_etudiant]);
                $trimestre_value = mysqli_real_escape_string($db, $trimestres[$id_etudiant]); // Récupération de la valeur du trimestre

                // Exécution de la requête préparée pour chaque étudiant
                mysqli_stmt_bind_param($stmt_insert, 'ississ', $id_etudiant, $matiere, $total_devoir_value, $examen_value, $mois_value, $trimestre_value);
                mysqli_stmt_execute($stmt_insert);
            } else {
                echo "Erreur : La valeur de 'total_devoir' ne peut pas être null.";
            }
        }

        // Fermer l'instruction préparée d'insertion
        mysqli_stmt_close($stmt_insert);

        // Redirection vers la page étudiants_par_classe1.php après l'insertion réussie
        if (isset($_POST['id_classe'])) {
            $id_classe = mysqli_real_escape_string($db, $_POST['id_classe']);
            header("Location: etudiants_par_classe1.php?classe_id=" . $id_classe);
            exit();
        } else {
            echo "Erreur : ID de classe non défini.";
        }
    } else {
        // En cas d'erreur dans la préparation de l'instruction d'insertion
        echo "Erreur dans la préparation de la requête d'insertion.";
    }
} else {
    // Redirection vers une page d'erreur si le formulaire n'est pas soumis
    header("Location: error.php");
    exit();
}
?>
