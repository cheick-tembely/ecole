<?php
// Include necessary files and start the session
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';
require_once 'fonctions.php';
$as = annee_scolaire_actuelle();

// Check if the user is logged in and get their information
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Fetch school-specific information based on user credentials
    $query1 = "SELECT e.nom_ecole FROM utilisateur u INNER JOIN ecole e ON u.nom_ecole = e.nom_ecole WHERE u.nom_user = '$nomUser' AND u.prenom_user = '$prenomUser'";
    $result1 = mysqli_query($db, $query1);
    $row = mysqli_fetch_assoc($result1);
    $nomEcole = $row['nom_ecole'];

        // Display the rest of your HTML content with the fetched school information
   
        echo '<div class="info">';
        echo '<div class="row">';

        // Professeurs
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-success shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Professeurs</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_professeurs = "SELECT COUNT(*) FROM professeur WHERE nom_ecole = '$nomEcole'";
        $result_professeurs = mysqli_query($db, $query_professeurs) or die(mysqli_error($db));
        $total_professeurs = mysqli_fetch_array($result_professeurs)[0];
        echo "$total_professeurs Professeur";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Etudiants
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-info shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Etudiants</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_etudiants = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole'";
        $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));
        $total_etudiants = mysqli_fetch_array($result_etudiants)[0];
        echo "$total_etudiants Etudiants";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Pointages
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-warning shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Livres</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_pointages = "SELECT COUNT(*) FROM livre WHERE nom_ecole = '$nomEcole'";
        $result_pointages = mysqli_query($db, $query_pointages) or die(mysqli_error($db));
        $total_pointages = mysqli_fetch_array($result_pointages)[0];
        echo "$total_pointages Livres";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Filles et pourcentage
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-pink shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Nbre Filles</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_filles = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Fille'";
        $result_filles = mysqli_query($db, $query_filles) or die(mysqli_error($db));
        $total_filles = mysqli_fetch_array($result_filles)[0];

        // Calcul du pourcentage de filles
        $percentage_filles = $total_etudiants > 0 ? ($total_filles / $total_etudiants) * 100 : 0;
        echo "$total_filles Filles (" . round($percentage_filles, 2) . "%)";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Garçons et pourcentage
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-blue shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-blue text-uppercase mb-1">Nbre Garçons</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_garcons = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Garçon'";
        $result_garcons = mysqli_query($db, $query_garcons) or die(mysqli_error($db));
        $total_garcons = mysqli_fetch_array($result_garcons)[0];

        // Calcul du pourcentage de garçons
        $percentage_garcons = $total_etudiants > 0 ? ($total_garcons / $total_etudiants) * 100 : 0;
        echo "$total_garcons Garçons (" . round($percentage_garcons, 2) . "%)";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Utilisateurs
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-danger shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Emprunts</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_utilisateurs = "SELECT COUNT(*) FROM emprunts WHERE nom_ecole = '$nomEcole'";
        $result_utilisateurs = mysqli_query($db, $query_utilisateurs) or die(mysqli_error($db));
        $total_utilisateurs = mysqli_fetch_array($result_utilisateurs)[0];
        echo "$total_utilisateurs Emprunts";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Classes
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-dark shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Nbre Classes</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        $query_classes = "SELECT COUNT(*) FROM classe WHERE nom_ecole = '$nomEcole'";
        $result_classes = mysqli_query($db, $query_classes) or die(mysqli_error($db));
        $total_classes = mysqli_fetch_array($result_classes)[0];
        echo "$total_classes Classes";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Année Scolaire
        echo '<div class="col-md-3 mb-3">';
        echo '<div class="card border-left-primary shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Année Scolaire</div>';
        echo '<div class="h6 mb-0 font-weight-bold text-gray-800">';
        echo $as . " Actif";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Fin de la row
    }

?>

<!-- Style CSS -->
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
    }

    .text-gray-800 {
        color: #333;
    }

    .text-uppercase {
        text-transform: uppercase;
    }

    .card-body {
        padding: 20px;
    }

    .card .text-xs {
        font-size: 12px;
    }

    .h6 {
        font-size: 16px;
    }

    .font-weight-bold {
        font-weight: bold;
    }

    .mb-1 {
        margin-bottom: 1rem;
    }

    .shadow-lg {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
<?php

        // Fetch statistics for the graphs
        $query_etudiants = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole'";
        $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));
        $total_etudiants = mysqli_fetch_array($result_etudiants)[0];

        $query_etudiants = "SELECT COUNT(*) FROM pointage WHERE nom_ecole = '$nomEcole'";
        $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));
        $total_pointage = mysqli_fetch_array($result_etudiants)[0];

        $query_filles = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Fille'";
        $result_filles = mysqli_query($db, $query_filles) or die(mysqli_error($db));
        $total_filles = mysqli_fetch_array($result_filles)[0];

        $query_garcons = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Garçon'";
        $result_garcons = mysqli_query($db, $query_garcons) or die(mysqli_error($db));
        $total_garcons = mysqli_fetch_array($result_garcons)[0];

        // Calculate percentages
        $percentage_filles = $total_etudiants > 0 ? ($total_filles / $total_etudiants) * 100 : 0;
        $percentage_garcons = $total_etudiants > 0 ? ($total_garcons / $total_etudiants) * 100 : 0;

        // Fetch students' validation status statistics
        $query_valide = "SELECT COUNT(*) FROM pointage WHERE nom_ecole = '$nomEcole' AND statut = 'Payer'";
        $result_valide = mysqli_query($db, $query_valide) or die(mysqli_error($db));
        $total_payer = mysqli_fetch_array($result_valide)[0];

        $query_non_valide = "SELECT COUNT(*) FROM pointage WHERE nom_ecole = '$nomEcole' AND statut = 'Valider'";
        $result_non_valide = mysqli_query($db, $query_non_valide) or die(mysqli_error($db));
        $total_valider = mysqli_fetch_array($result_non_valide)[0];

        // Fetch students' status Regulier vs Candidat Libre
        $query_regulier = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND statut = 'Régulier'";
        $result_regulier = mysqli_query($db, $query_regulier) or die(mysqli_error($db));
        $total_regulier = mysqli_fetch_array($result_regulier)[0];

        $query_candidat_libre = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND statut = 'Candidat Libre'";
        $result_candidat_libre = mysqli_query($db, $query_candidat_libre) or die(mysqli_error($db));
        $total_candidat_libre = mysqli_fetch_array($result_candidat_libre)[0];

        // Calculate percentages for Regulier vs Candidat Libre
        $percentage_regulier = $total_etudiants > 0 ? ($total_regulier / $total_etudiants) * 100 : 0;
        $percentage_candidat_libre = $total_etudiants > 0 ? ($total_candidat_libre / $total_etudiants) * 100 : 0;

        $percentage_payer = $total_pointage > 0 ? ($total_payer / $total_pointage) * 100 : 0;
        $percentage_valider = $total_pointage > 0 ? ($total_valider / $total_pointage) * 100 : 0;
        echo '<br>';
        echo '<br>';
        // Cards with stats
        echo '<div class="row">';

        // Filles and Garçons Stats
        echo '<div class="col-md-4 mb-3">';
        echo '<div class="card shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Répartition Filles / Garçons</div>';
        echo '<canvas id="genderChart"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Validation Status Stats
        echo '<div class="col-md-4 mb-3">';
        echo '<div class="card shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pointage Professeur (Payer /  Validé)</div>';
        echo '<canvas id="statusChart"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Regulier vs Candidat Libre Stats
        echo '<div class="col-md-4 mb-3">';
        echo '<div class="card shadow-lg h-100 py-4">';
        echo '<div class="card-body text-center">';
        echo '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Statut des Étudiants (Régulier / Candidat Libre)</div>';
        echo '<canvas id="statutChart"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Close the row
        echo '</div>';

        // JavaScript for Chart.js
        echo '
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        // Gender Chart
        var ctx1 = document.getElementById("genderChart").getContext("2d");
        var genderChart = new Chart(ctx1, {
            type: "pie",
            data: {
                labels: ["Filles", "Garçons"],
                datasets: [{
                    label: "Répartition",
                    data: [' . $percentage_filles . ', ' . $percentage_garcons . '],
                    backgroundColor: ["#f78c42", "#4e73df"],
                    borderColor: ["#f78c42", "#4e73df"],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "top",
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        }
                    }
                }
            }
        });

        // Status Chart (Payer vs Validé)
        var ctx2 = document.getElementById("statusChart").getContext("2d");
        var statusChart = new Chart(ctx2, {
            type: "bar",
            data: {
                labels: ["Payer", "Validé"],
                datasets: [{
                    label: "Pointage des Professeurs",
                    data: [' . $percentage_payer . ', ' . $percentage_valider . '],
                    backgroundColor: ["#28a745", "#dc3545"],
                    borderColor: ["#28a745", "#dc3545"],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        }
                    }
                }
            }
        });

        // Statut Chart (Régulier vs Candidat Libre)
        var ctx3 = document.getElementById("statutChart").getContext("2d");
        var statutChart = new Chart(ctx3, {
            type: "bar",
            data: {
                labels: ["Régulier", "Candidat Libre"],
                datasets: [{
                    label: "Statut des Étudiants",
                    data: [' . $percentage_regulier . ', ' . $percentage_candidat_libre . '],
                    backgroundColor: ["#007bff", "#ffc107"],
                    borderColor: ["#007bff", "#ffc107"],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        }
                    }
                }
            }
        });
        </script>
        ';

?>

<?php
include'../includes/footer.php';
?>