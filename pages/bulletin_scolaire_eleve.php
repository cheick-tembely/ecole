<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
// Connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';
require_once('fonctions.php');
$as = annee_scolaire_actuelle();
// Récupérer les informations de la classe

// Vérifier si l'identifiant de l'étudiant est passé en paramètre
if (isset($_GET['id_etudiant'])) {
    $id_etudiant = $_GET['id_etudiant'];

    // Requête pour récupérer les informations de l'étudiant
    $sql_etudiant = "SELECT nom, prenom FROM etudiant WHERE id_etudiant = ?";
    $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
    mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
    mysqli_stmt_execute($stmt_etudiant);
    $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
 // Requête pour récupérer les informations de l'étudiant
 $sql_etudiant = "SELECT nom, prenom, classe FROM etudiant WHERE id_etudiant = ?";
 $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
 mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
 mysqli_stmt_execute($stmt_etudiant);
 $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
    // Vérifier si des résultats ont été retournés pour l'étudiant
    if ($result_etudiant && mysqli_num_rows($result_etudiant) > 0) {
        $row_etudiant = mysqli_fetch_assoc($result_etudiant);
        $nom_etudiant = $row_etudiant['nom'];
        $prenom_etudiant = $row_etudiant['prenom'];
        $classe_etudiant = $row_etudiant['classe']; 
        
        // Requête pour récupérer les informations du bulletin scolaire de l'étudiant
        $sql_bulletin = "SELECT ce.matiere, ce.coefficient AS coeff_matiere, ne.total_devoir, ne.examen
        FROM note_examen ne
        INNER JOIN coefficient ce ON ne.matiere = ce.matiere
        WHERE ne.id_etudiant = ? AND ne.trimestre = 'Trimestre 1'";
$stmt_bulletin = mysqli_prepare($db, $sql_bulletin);
mysqli_stmt_bind_param($stmt_bulletin, 'i', $id_etudiant);
mysqli_stmt_execute($stmt_bulletin);
$result_bulletin = mysqli_stmt_get_result($stmt_bulletin);

        // Vérifier si des résultats ont été retournés pour le bulletin scolaire
        if ($result_bulletin && mysqli_num_rows($result_bulletin) > 0) {
            // Initialisation des variables pour le calcul de la moyenne générale et des notes coefficient
            $total_points = 0;
            $total_coefficients = 0;
            $sum_notes_coefficient = 0; // Variable pour stocker la somme totale des notes coefficients
// Calcul du trimestre en fonction du mois
$mois_actuel = date('m');
$trimestre = '';

if ($mois_actuel >= 10 && $mois_actuel <= 12) {
    $trimestre = 'Trimestre 1';
} elseif ($mois_actuel >= 1 && $mois_actuel <= 3) {
    $trimestre = 'Trimestre 2';
} elseif ($mois_actuel >= 4 && $mois_actuel <= 6) {
    $trimestre = 'Trimestre 3';
} else {
    $trimestre = 'Non défini';
}

            // Affichage du bulletin scolaire de l'étudiant
            echo '<div class="card shadow mb-4">';
            echo '<div class="card-header py-3">';
            echo '<h4 class="m-2 font-weight-bold text-primary text-center">Année Académique ' . $as . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Bulletin Scolaire de ' . $nom_etudiant . ' ' . $prenom_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Classe : ' . $classe_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary"> Trimestre 1 </h4>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Matière</th>';
            echo '<th>Coefficient Matière</th>'; // Nouvelle colonne ajoutée
            echo '<th>Note Classe</th>';
            echo '<th>Note Examen</th>';
            echo '<th>Moyenne Generale</th>'; // Nouvelle colonne ajoutée
            echo '<th>Notes Coefficient</th>'; // Nouvelle colonne ajoutée
            echo '<th>Commentaire</th>'; // Nouvelle colonne ajoutée
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row_bulletin = mysqli_fetch_assoc($result_bulletin)) {
                echo '<tr>';
                echo '<td>' . $row_bulletin['matiere'] . '</td>';
                echo '<td>' . $row_bulletin['coeff_matiere'] . '</td>'; // Afficher le coefficient de la matière
                echo '<td>' . $row_bulletin['total_devoir'] . '</td>';
                echo '<td>' . $row_bulletin['examen'] . '</td>';
                // Calcul de la moyenne générale pour chaque matière
                $moyenne_generale_matiere = ($row_bulletin['total_devoir'] + (2 * $row_bulletin['examen'])) / 3;
                // Formater la moyenne générale avec deux chiffres après la virgule
                $moyenne_generale_matiere_formattee = number_format($moyenne_generale_matiere, 2);
                echo '<td>' . $moyenne_generale_matiere_formattee . '</td>';
                // Calcul des notes coefficient pour chaque matière
                $note_coefficient = $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                // Formater la note coefficient avec deux chiffres après la virgule
                // Continuation du code après le calcul des notes coefficients pour chaque matière
                $note_coefficient_formattee = number_format($note_coefficient, 2);
                echo '<td>' . $note_coefficient_formattee . '</td>';
                // Déterminons le commentaire pour chaque matière basé sur la note d'examen de l'étudiant
                $note_examen = $row_bulletin['examen'];
                $commentaire = '';
                if ($note_examen >= 0 && $note_examen < 10) {
                    $commentaire = 'Insuffisant';
                } elseif ($note_examen >= 10 && $note_examen < 12) {
                    $commentaire = 'Passable';
                } elseif ($note_examen >= 12 && $note_examen < 14) {
                    $commentaire = 'Assez-Bien';
                } elseif ($note_examen >= 14 && $note_examen < 16) {
                    $commentaire = 'Bien';
                } elseif ($note_examen >= 16) {
                    $commentaire = 'Excellent';
                } else {
                    $commentaire = 'Non défini';
                }
                echo '<td>' . $commentaire . '</td>';
                echo '</tr>';

                // Calcul de la moyenne générale pondérée
                $total_points += $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                $total_coefficients += $row_bulletin['coeff_matiere'];
                // Calcul de la somme totale des notes coefficients
                $sum_notes_coefficient += $note_coefficient;
            }

            echo '</tbody>';
            echo '</table>';

            // Calcul de la somme totale des coefficients
            $sum_coefficients = 0;
            $sql_sum_coefficients = "SELECT SUM(coefficient) AS sum_coefficients FROM coefficient";
            $result_sum_coefficients = mysqli_query($db, $sql_sum_coefficients);

            if ($result_sum_coefficients && mysqli_num_rows($result_sum_coefficients) > 0) {
                $row_sum_coefficients= mysqli_fetch_assoc($result_sum_coefficients);
                $sum_coefficients = $row_sum_coefficients['sum_coefficients'];
            }

            // Affichage de la somme totale des coefficients
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Coefficients: ' . $sum_coefficients . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee1 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Notes Coefficient: ' . number_format($sum_notes_coefficient, 2) . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Moyenne Générale du Trimestre 1: ' . $moyenne_generale_finale_formattee1 . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee1 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale

            // Requête SQL pour récupérer les étudiants triés par leur moyenne générale finale
            $sql_classement = "SELECT id_etudiant, (SUM(ne.total_devoir) + (2 * SUM(ne.examen))) / (3 * SUM(ce.coefficient)) AS moyenne_generale_finale
                               FROM note_examen ne
                               INNER JOIN coefficient ce ON ne.matiere = ce.matiere
                               GROUP BY id_etudiant
                               ORDER BY moyenne_generale_finale DESC";
            $result_classement = mysqli_query($db, $sql_classement);

            if ($result_classement && mysqli_num_rows($result_classement) > 0) {
                echo '<h4 class="m-2 font-weight-bold text-primary">Classement de l\'étudiant:</h4>';
                $position = 1;
                while ($row_classement = mysqli_fetch_assoc($result_classement)) {
                    if ($row_classement['id_etudiant'] == $id_etudiant) {
                        echo '<h4 class="m-2 font-weight-bold text-primary">Rang : ' . $position . '</h4>';
                        break; // Arrêter la boucle une fois que le rang de l'étudiant actuel est trouvé
                    }
                    $position++;
                }
            } else {
                echo 'Aucun classement disponible.';
            }
  // Utilisation de la moyenne générale du trimestre
  $commentaire_trimestre = '';
  if ($moyenne_generale_finale >= 0 && $moyenne_generale_finale < 10) {
      $commentaire_trimestre = 'Travail insuffisant';
  } elseif ($moyenne_generale_finale >= 10 && $moyenne_generale_finale < 12) {
      $commentaire_trimestre = 'Travail passable';
  } elseif ($moyenne_generale_finale >= 12 && $moyenne_generale_finale < 14) {
      $commentaire_trimestre = 'Assez-bon Travail';
  } elseif ($moyenne_generale_finale >= 14 && $moyenne_generale_finale < 16) {
      $commentaire_trimestre = 'Bon Travail';
  } elseif ($moyenne_generale_finale >= 16 && $moyenne_generale_finale < 18) {
      $commentaire_trimestre = 'Très Bon Travail';
  } elseif ($moyenne_generale_finale >= 18) {
      $commentaire_trimestre = 'Travail Excellent';
  }

  echo '<h4 class="m-2 font-weight-bold text-primary">Appréciation :' . $commentaire_trimestre . '</h4>';

  // Bouton pour imprimer le bulletin scolaire
  echo '<button onclick="window.print()" class="btn btn-primary">Imprimer</button>';

  // Signature du directeur des études
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">Le Directeur des Etudes</h4>';
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">CHEICKNA TEMBELY</h4>';

  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
} else {
  echo 'Aucun bulletin scolaire trouvé pour cet étudiant.';
}
} else {
echo 'Aucun étudiant trouvé avec cet identifiant.';
}
} else {
echo 'Aucun identifiant d\'étudiant spécifié.';
}

if (isset($_GET['id_etudiant'])) {
    $id_etudiant = $_GET['id_etudiant'];

    // Requête pour récupérer les informations de l'étudiant
    $sql_etudiant = "SELECT nom, prenom FROM etudiant WHERE id_etudiant = ?";
    $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
    mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
    mysqli_stmt_execute($stmt_etudiant);
    $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
 // Requête pour récupérer les informations de l'étudiant
 $sql_etudiant = "SELECT nom, prenom, classe FROM etudiant WHERE id_etudiant = ?";
 $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
 mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
 mysqli_stmt_execute($stmt_etudiant);
 $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
    // Vérifier si des résultats ont été retournés pour l'étudiant
    if ($result_etudiant && mysqli_num_rows($result_etudiant) > 0) {
        $row_etudiant = mysqli_fetch_assoc($result_etudiant);
        $nom_etudiant = $row_etudiant['nom'];
        $prenom_etudiant = $row_etudiant['prenom'];
        $classe_etudiant = $row_etudiant['classe']; 
        
        // Requête pour récupérer les informations du bulletin scolaire de l'étudiant
        $sql_bulletin = "SELECT ce.matiere, ce.coefficient AS coeff_matiere, ne.total_devoir, ne.examen
        FROM note_examen ne
        INNER JOIN coefficient ce ON ne.matiere = ce.matiere
        WHERE ne.id_etudiant = ? AND ne.trimestre = 'Trimestre 2'";
$stmt_bulletin = mysqli_prepare($db, $sql_bulletin);
mysqli_stmt_bind_param($stmt_bulletin, 'i', $id_etudiant);
mysqli_stmt_execute($stmt_bulletin);
$result_bulletin = mysqli_stmt_get_result($stmt_bulletin);

        // Vérifier si des résultats ont été retournés pour le bulletin scolaire
        if ($result_bulletin && mysqli_num_rows($result_bulletin) > 0) {
            // Initialisation des variables pour le calcul de la moyenne générale et des notes coefficient
            $total_points = 0;
            $total_coefficients = 0;
            $sum_notes_coefficient = 0; // Variable pour stocker la somme totale des notes coefficients
// Calcul du trimestre en fonction du mois
$mois_actuel = date('m');
$trimestre = '';

if ($mois_actuel >= 10 && $mois_actuel <= 12) {
    $trimestre = 'Trimestre 1';
} elseif ($mois_actuel >= 1 && $mois_actuel <= 3) {
    $trimestre = 'Trimestre 2';
} elseif ($mois_actuel >= 4 && $mois_actuel <= 6) {
    $trimestre = 'Trimestre 3';
} else {
    $trimestre = 'Non défini';
}
            // Affichage du bulletin scolaire de l'étudiant
            echo '<div class="card shadow mb-4">';
            echo '<div class="card-header py-3">';
            echo '<h4 class="m-2 font-weight-bold text-primary text-center">Année Académique ' . $as . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Bulletin Scolaire de ' . $nom_etudiant . ' ' . $prenom_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Classe : ' . $classe_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">  Trimestre 2</h4>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Matière</th>';
            echo '<th>Coefficient Matière</th>'; // Nouvelle colonne ajoutée
            echo '<th>Note Classe</th>';
            echo '<th>Note Examen</th>';
            echo '<th>Moyenne Generale</th>'; // Nouvelle colonne ajoutée
            echo '<th>Notes Coefficient</th>'; // Nouvelle colonne ajoutée
            echo '<th>Commentaire</th>'; // Nouvelle colonne ajoutée
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row_bulletin = mysqli_fetch_assoc($result_bulletin)) {
                echo '<tr>';
                echo '<td>' . $row_bulletin['matiere'] . '</td>';
                echo '<td>' . $row_bulletin['coeff_matiere'] . '</td>'; // Afficher le coefficient de la matière
                echo '<td>' . $row_bulletin['total_devoir'] . '</td>';
                echo '<td>' . $row_bulletin['examen'] . '</td>';
                // Calcul de la moyenne générale pour chaque matière
                $moyenne_generale_matiere = ($row_bulletin['total_devoir'] + (2 * $row_bulletin['examen'])) / 3;
                // Formater la moyenne générale avec deux chiffres après la virgule
                $moyenne_generale_matiere_formattee = number_format($moyenne_generale_matiere, 2);
                echo '<td>' . $moyenne_generale_matiere_formattee . '</td>';
                // Calcul des notes coefficient pour chaque matière
                $note_coefficient = $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                // Formater la note coefficient avec deux chiffres après la virgule
                // Continuation du code après le calcul des notes coefficients pour chaque matière
                $note_coefficient_formattee = number_format($note_coefficient, 2);
                echo '<td>' . $note_coefficient_formattee . '</td>';
                // Déterminons le commentaire pour chaque matière basé sur la note d'examen de l'étudiant
                $note_examen = $row_bulletin['examen'];
                $commentaire = '';
                if ($note_examen >= 0 && $note_examen < 10) {
                    $commentaire = 'Insuffisant';
                } elseif ($note_examen >= 10 && $note_examen < 12) {
                    $commentaire = 'Passable';
                } elseif ($note_examen >= 12 && $note_examen < 14) {
                    $commentaire = 'Assez-Bien';
                } elseif ($note_examen >= 14 && $note_examen < 16) {
                    $commentaire = 'Bien';
                } elseif ($note_examen >= 16) {
                    $commentaire = 'Excellent';
                } else {
                    $commentaire = 'Non défini';
                }
                echo '<td>' . $commentaire . '</td>';
                echo '</tr>';

                // Calcul de la moyenne générale pondérée
                $total_points += $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                $total_coefficients += $row_bulletin['coeff_matiere'];
                // Calcul de la somme totale des notes coefficients
                $sum_notes_coefficient += $note_coefficient;
            }

            echo '</tbody>';
            echo '</table>';

            // Calcul de la somme totale des coefficients
            $sum_coefficients = 0;
            $sql_sum_coefficients = "SELECT SUM(coefficient) AS sum_coefficients FROM coefficient";
            $result_sum_coefficients = mysqli_query($db, $sql_sum_coefficients);

            if ($result_sum_coefficients && mysqli_num_rows($result_sum_coefficients) > 0) {
                $row_sum_coefficients= mysqli_fetch_assoc($result_sum_coefficients);
                $sum_coefficients = $row_sum_coefficients['sum_coefficients'];
            }

            // Affichage de la somme totale des coefficients
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Coefficients: ' . $sum_coefficients . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee2 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Notes Coefficient: ' . number_format($sum_notes_coefficient, 2) . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Moyenne Générale du Trimestre 2: ' . $moyenne_generale_finale_formattee2 . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee2 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale

            // Requête SQL pour récupérer les étudiants triés par leur moyenne générale finale
            $sql_classement = "SELECT id_etudiant, (SUM(ne.total_devoir) + (2 * SUM(ne.examen))) / (3 * SUM(ce.coefficient)) AS moyenne_generale_finale
                               FROM note_examen ne
                               INNER JOIN coefficient ce ON ne.matiere = ce.matiere
                               GROUP BY id_etudiant
                               ORDER BY moyenne_generale_finale DESC";
            $result_classement = mysqli_query($db, $sql_classement);

            if ($result_classement && mysqli_num_rows($result_classement) > 0) {
                echo '<h4 class="m-2 font-weight-bold text-primary">Classement de l\'étudiant:</h4>';
                $position = 1;
                while ($row_classement = mysqli_fetch_assoc($result_classement)) {
                    if ($row_classement['id_etudiant'] == $id_etudiant) {
                        echo '<h4 class="m-2 font-weight-bold text-primary">Rang : ' . $position . '</h4>';
                        break; // Arrêter la boucle une fois que le rang de l'étudiant actuel est trouvé
                    }
                    $position++;
                }
            } else {
                echo 'Aucun classement disponible.';
            }
  // Utilisation de la moyenne générale du trimestre
  $commentaire_trimestre = '';
  if ($moyenne_generale_finale >= 0 && $moyenne_generale_finale < 10) {
      $commentaire_trimestre = 'Travail insuffisant';
  } elseif ($moyenne_generale_finale >= 10 && $moyenne_generale_finale < 12) {
      $commentaire_trimestre = 'Travail passable';
  } elseif ($moyenne_generale_finale >= 12 && $moyenne_generale_finale < 14) {
      $commentaire_trimestre = 'Assez-bon Travail';
  } elseif ($moyenne_generale_finale >= 14 && $moyenne_generale_finale < 16) {
      $commentaire_trimestre = 'Bon Travail';
  } elseif ($moyenne_generale_finale >= 16 && $moyenne_generale_finale < 18) {
      $commentaire_trimestre = 'Très Bon Travail';
  } elseif ($moyenne_generale_finale >= 18) {
      $commentaire_trimestre = 'Travail Excellent';
  }

  echo '<h4 class="m-2 font-weight-bold text-primary">Appréciation :' . $commentaire_trimestre . '</h4>';

  // Bouton pour imprimer le bulletin scolaire
  echo '<button onclick="window.print()" class="btn btn-primary">Imprimer</button>';

  // Signature du directeur des études
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">Le Directeur des Etudes</h4>';
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">CHEICKNA TEMBELY</h4>';

  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

}
} else {
echo 'Aucun étudiant trouvé avec cet identifiant.';
}
} else {
echo 'Aucun identifiant d\'étudiant spécifié.';
}
if (isset($_GET['id_etudiant'])) {
    $id_etudiant = $_GET['id_etudiant'];

    // Requête pour récupérer les informations de l'étudiant
    $sql_etudiant = "SELECT nom, prenom FROM etudiant WHERE id_etudiant = ?";
    $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
    mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
    mysqli_stmt_execute($stmt_etudiant);
    $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
 // Requête pour récupérer les informations de l'étudiant
 $sql_etudiant = "SELECT nom, prenom, classe FROM etudiant WHERE id_etudiant = ?";
 $stmt_etudiant = mysqli_prepare($db, $sql_etudiant);
 mysqli_stmt_bind_param($stmt_etudiant, 'i', $id_etudiant);
 mysqli_stmt_execute($stmt_etudiant);
 $result_etudiant = mysqli_stmt_get_result($stmt_etudiant);
    // Vérifier si des résultats ont été retournés pour l'étudiant
    if ($result_etudiant && mysqli_num_rows($result_etudiant) > 0) {
        $row_etudiant = mysqli_fetch_assoc($result_etudiant);
        $nom_etudiant = $row_etudiant['nom'];
        $prenom_etudiant = $row_etudiant['prenom'];
        $classe_etudiant = $row_etudiant['classe']; 
        
        // Requête pour récupérer les informations du bulletin scolaire de l'étudiant
        $sql_bulletin = "SELECT ce.matiere, ce.coefficient AS coeff_matiere, ne.total_devoir, ne.examen
        FROM note_examen ne
        INNER JOIN coefficient ce ON ne.matiere = ce.matiere
        WHERE ne.id_etudiant = ? AND ne.trimestre = 'Trimestre 3'";
$stmt_bulletin = mysqli_prepare($db, $sql_bulletin);
mysqli_stmt_bind_param($stmt_bulletin, 'i', $id_etudiant);
mysqli_stmt_execute($stmt_bulletin);
$result_bulletin = mysqli_stmt_get_result($stmt_bulletin);

        // Vérifier si des résultats ont été retournés pour le bulletin scolaire
        if ($result_bulletin && mysqli_num_rows($result_bulletin) > 0) {
            // Initialisation des variables pour le calcul de la moyenne générale et des notes coefficient
            $total_points = 0;
            $total_coefficients = 0;
            $sum_notes_coefficient = 0; // Variable pour stocker la somme totale des notes coefficients
// Calcul du trimestre en fonction du mois
$mois_actuel = date('m');
$trimestre = '';

if ($mois_actuel >= 10 && $mois_actuel <= 12) {
    $trimestre = 'Trimestre 1';
} elseif ($mois_actuel >= 1 && $mois_actuel <= 3) {
    $trimestre = 'Trimestre 2';
} elseif ($mois_actuel >= 4 && $mois_actuel <= 6) {
    $trimestre = 'Trimestre 3';
} else {
    $trimestre = 'Non défini';
}
            // Affichage du bulletin scolaire de l'étudiant
            echo '<div class="card shadow mb-4">';
            echo '<div class="card-header py-3">';
            echo '<h4 class="m-2 font-weight-bold text-primary text-center">Année Académique ' . $as . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Bulletin Scolaire de ' . $nom_etudiant . ' ' . $prenom_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Classe : ' . $classe_etudiant . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary"> Trimestre 2</h4>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Matière</th>';
            echo '<th>Coefficient Matière</th>'; // Nouvelle colonne ajoutée
            echo '<th>Note Classe</th>';
            echo '<th>Note Examen</th>';
            echo '<th>Moyenne Generale</th>'; // Nouvelle colonne ajoutée
            echo '<th>Notes Coefficient</th>'; // Nouvelle colonne ajoutée
            echo '<th>Commentaire</th>'; // Nouvelle colonne ajoutée
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row_bulletin = mysqli_fetch_assoc($result_bulletin)) {
                echo '<tr>';
                echo '<td>' . $row_bulletin['matiere'] . '</td>';
                echo '<td>' . $row_bulletin['coeff_matiere'] . '</td>'; // Afficher le coefficient de la matière
                echo '<td>' . $row_bulletin['total_devoir'] . '</td>';
                echo '<td>' . $row_bulletin['examen'] . '</td>';
                // Calcul de la moyenne générale pour chaque matière
                $moyenne_generale_matiere = ($row_bulletin['total_devoir'] + (2 * $row_bulletin['examen'])) / 3;
                // Formater la moyenne générale avec deux chiffres après la virgule
                $moyenne_generale_matiere_formattee = number_format($moyenne_generale_matiere, 2);
                echo '<td>' . $moyenne_generale_matiere_formattee . '</td>';
                // Calcul des notes coefficient pour chaque matière
                $note_coefficient = $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                // Formater la note coefficient avec deux chiffres après la virgule
                // Continuation du code après le calcul des notes coefficients pour chaque matière
                $note_coefficient_formattee = number_format($note_coefficient, 2);
                echo '<td>' . $note_coefficient_formattee . '</td>';
                // Déterminons le commentaire pour chaque matière basé sur la note d'examen de l'étudiant
                $note_examen = $row_bulletin['examen'];
                $commentaire = '';
                if ($note_examen >= 0 && $note_examen < 10) {
                    $commentaire = 'Insuffisant';
                } elseif ($note_examen >= 10 && $note_examen < 12) {
                    $commentaire = 'Passable';
                } elseif ($note_examen >= 12 && $note_examen < 14) {
                    $commentaire = 'Assez-Bien';
                } elseif ($note_examen >= 14 && $note_examen < 16) {
                    $commentaire = 'Bien';
                } elseif ($note_examen >= 16) {
                    $commentaire = 'Excellent';
                } else {
                    $commentaire = 'Non défini';
                }
                echo '<td>' . $commentaire . '</td>';
                echo '</tr>';

                // Calcul de la moyenne générale pondérée
                $total_points += $moyenne_generale_matiere * $row_bulletin['coeff_matiere'];
                $total_coefficients += $row_bulletin['coeff_matiere'];
                // Calcul de la somme totale des notes coefficients
                $sum_notes_coefficient += $note_coefficient;
            }

            echo '</tbody>';
            echo '</table>';

            // Calcul de la somme totale des coefficients
            $sum_coefficients = 0;
            $sql_sum_coefficients = "SELECT SUM(coefficient) AS sum_coefficients FROM coefficient";
            $result_sum_coefficients = mysqli_query($db, $sql_sum_coefficients);

            if ($result_sum_coefficients && mysqli_num_rows($result_sum_coefficients) > 0) {
                $row_sum_coefficients= mysqli_fetch_assoc($result_sum_coefficients);
                $sum_coefficients = $row_sum_coefficients['sum_coefficients'];
            }

            // Affichage de la somme totale des coefficients
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Coefficients: ' . $sum_coefficients . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee3 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale
            echo '<h4 class="m-2 font-weight-bold text-primary">Somme des Notes Coefficient: ' . number_format($sum_notes_coefficient, 2) . '</h4>';
            echo '<h4 class="m-2 font-weight-bold text-primary">Moyenne Générale du Trimestre 3: ' . $moyenne_generale_finale_formattee3 . '</h4>';

            // Calcul de la moyenne générale finale
            $moyenne_generale_finale = ($sum_coefficients > 0) ? $total_points / $sum_coefficients : 0;
            // Formater la moyenne générale finale avec deux chiffres après la virgule
            $moyenne_generale_finale_formattee3 = number_format($moyenne_generale_finale, 2);
            // Affichage de la moyenne générale finale

            // Requête SQL pour récupérer les étudiants triés par leur moyenne générale finale
            $sql_classement = "SELECT id_etudiant, (SUM(ne.total_devoir) + (2 * SUM(ne.examen))) / (3 * SUM(ce.coefficient)) AS moyenne_generale_finale
                               FROM note_examen ne
                               INNER JOIN coefficient ce ON ne.matiere = ce.matiere
                               GROUP BY id_etudiant
                               ORDER BY moyenne_generale_finale DESC";
            $result_classement = mysqli_query($db, $sql_classement);

            if ($result_classement && mysqli_num_rows($result_classement) > 0) {
                echo '<h4 class="m-2 font-weight-bold text-primary">Classement de l\'étudiant:</h4>';
                $position = 1;
                while ($row_classement = mysqli_fetch_assoc($result_classement)) {
                    if ($row_classement['id_etudiant'] == $id_etudiant) {
                        echo '<h4 class="m-2 font-weight-bold text-primary">Rang : ' . $position . '</h4>';
                        break; // Arrêter la boucle une fois que le rang de l'étudiant actuel est trouvé
                    }
                    $position++;
                }
            } else {
                echo 'Aucun classement disponible.';
            }
  // Utilisation de la moyenne générale du trimestre
  $commentaire_trimestre = '';
  if ($moyenne_generale_finale >= 0 && $moyenne_generale_finale < 10) {
      $commentaire_trimestre = 'Travail insuffisant';
  } elseif ($moyenne_generale_finale >= 10 && $moyenne_generale_finale < 12) {
      $commentaire_trimestre = 'Travail passable';
  } elseif ($moyenne_generale_finale >= 12 && $moyenne_generale_finale < 14) {
      $commentaire_trimestre = 'Assez-bon Travail';
  } elseif ($moyenne_generale_finale >= 14 && $moyenne_generale_finale < 16) {
      $commentaire_trimestre = 'Bon Travail';
  } elseif ($moyenne_generale_finale >= 16 && $moyenne_generale_finale < 18) {
      $commentaire_trimestre = 'Très Bon Travail';
  } elseif ($moyenne_generale_finale >= 18) {
      $commentaire_trimestre = 'Travail Excellent';
  }

  echo '<h4 class="m-2 font-weight-bold text-primary">Appréciation :' . $commentaire_trimestre . '</h4>';

  // Bouton pour imprimer le bulletin scolaire
  echo '<button onclick="window.print()" class="btn btn-primary">Imprimer</button>';

  // Signature du directeur des études
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">Le Directeur des Etudes</h4>';
  echo '<h4 class="m-2 font-weight-bold text-primary text-right">CHEICKNA TEMBELY</h4>';

  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

}
} else {
echo 'Aucun étudiant trouvé avec cet identifiant.';
}
} else {
echo 'Aucun identifiant d\'étudiant spécifié.';
}
echo '</tbody>';
echo '</table>';

// Tableau pour la Moyenne Annuelle
 // Utilisation de la moyenne générale du trimestre
 $commentaire_trimestre1 = '';
 if ($moyenne_totale_formattee >= 0 && $moyenne_totale_formattee < 10) {
     $commentaire_trimestre1 = 'Travail insuffisant';
 } elseif ($moyenne_totale_formattee >= 10 && $moyenne_totale_formattee < 12) {
     $commentaire_trimestre1 = 'Travail passable';
 } elseif ($moyenne_totale_formattee >= 12 && $moyenne_totale_formattee < 14) {
     $commentaire_trimestre1 = 'Assez-bon Travail';
 } elseif ($moyenne_totale_formattee >= 14 && $moyenne_totale_formattee < 16) {
     $commentaire_trimestre1 = 'Bon Travail';
 } elseif ($moyenne_totale_formattee >= 16 && $moyenne_totale_formattee < 18) {
    $commentaire_trimestre1 = 'Très Bon Travail';
 } elseif ($moyenne_totale_formattee >= 18) {
     $commentaire_trimestre1 = 'Travail Excellent';
 }
// Affichage de la Moyenne Annuelle centrée
echo '<div class="text-center">';
echo '<h4 class="m-2 font-weight-bold text-primary">Moyenne Annuelle</h4>';
echo '</div>';
echo '<div class="table-responsive">';
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
echo '<thead>';
echo '<tr>';
echo '<th>Nom</th>';
echo '<th>Prénom</th>';
echo '<th>Moyenne Générale Trimestre 1</th>';
echo '<th>Moyenne Générale Trimestre 2</th>';
echo '<th>Moyenne Générale Trimestre 3</th>';
echo '<th>Moyenne Total</th>';

echo '<th>Résultat</th>'; // Nouvelle colonne ajoutée
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Calcul de la moyenne générale totale
$moyenne_totale = ($moyenne_generale_finale_formattee1 + $moyenne_generale_finale_formattee2 + $moyenne_generale_finale_formattee3) / 3;
// Formater la moyenne générale totale avec deux chiffres après la virgule
$moyenne_totale_formattee = number_format($moyenne_totale, 2);

// Déterminer le résultat (Admis ou Redouble)
$resultat = ($moyenne_totale >= 10) ? 'Admis' : 'Redouble';

echo '<tr>';
echo '<td>' . $nom_etudiant . '</td>';
echo '<td>' . $prenom_etudiant . '</td>';
echo '<td>' . $moyenne_generale_finale_formattee1  . '</td>';
echo '<td>' . $moyenne_generale_finale_formattee2 . '</td>';
echo '<td>' . $moyenne_generale_finale_formattee3 . '</td>';
echo '<td>' . $moyenne_totale_formattee . '</td>';

echo '<td>' . $resultat . '</td>'; // Afficher le résultat
echo '</tr>';

echo '</tbody>';
echo '</table>';
echo '</div>';


