<?php
// Include necessary files and start the session
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements
include '../includes/connection.php';
include '../includes/sidebar.php';
require_once 'fonctions.php';
$as = annee_scolaire_actuelle();

// Check if the user is logged in and get their information
if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) {
    $nomUser = $_SESSION['nom_user'];
    $prenomUser = $_SESSION['prenom_user'];

    // Fetch school-specific information based on user credentials
    $query = "SELECT nom, prenom, academie, nom_ecole, lieu, statut, logo_path, antenne FROM ecole WHERE nom = '$nomUser' AND prenom = '$prenomUser'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display school-specific information
        $row = mysqli_fetch_assoc($result);
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $academie = $row['academie'];
        $nomEcole = $row['nom_ecole'];
        $lieu = $row['lieu'];
        $statut = $row['statut'];
        $antenne = $row['antenne'];
        $logo_path = $row['logo_path'];
        
        // Intégration de Tailwind CSS et Font Awesome
        echo '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">';
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">';
        
         // En-tête du tableau de bord avec style Tailwind
         echo '<div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 rounded-xl shadow-xl mb-8 mx-4">';
         echo '<h1 class="text-center text-3xl font-bold text-white mb-2">Tableau de Bord - ' . $nomEcole . '</h1>';
         echo '<p class="text-center text-white opacity-90 mb-2"><i class="fas fa-map-marker-alt mr-2"></i>' . $lieu . ' | <i class="fas fa-university ml-2 mr-2"></i>' . $academie . '</p>';
         echo '<p class="text-center text-white opacity-90"><i class="fas fa-calendar-alt mr-2"></i>Année Scolaire: ' . $as . '</p>';
         echo '</div>';
        
        // Conteneur des cartes statistiques
        echo '<div class="px-4">';
        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">';

        // Professeurs
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-green-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-green-500 opacity-20 text-4xl"><i class="fas fa-chalkboard-teacher"></i></div>';
        echo '<div class="text-xs font-bold text-green-600 uppercase mb-2">Professeurs</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_professeurs = "SELECT COUNT(*) FROM professeur WHERE nom_ecole = '$nomEcole'";
        $result_professeurs = mysqli_query($db, $query_professeurs) or die(mysqli_error($db));
        $total_professeurs = mysqli_fetch_array($result_professeurs)[0];
        echo "$total_professeurs";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Enseignants</div>';
        echo '</div>';
        echo '</div>';

        // Étudiants
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-blue-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-blue-500 opacity-20 text-4xl"><i class="fas fa-user-graduate"></i></div>';
        echo '<div class="text-xs font-bold text-blue-600 uppercase mb-2">Étudiants</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_etudiants = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole'";
        $result_etudiants = mysqli_query($db, $query_etudiants) or die(mysqli_error($db));
        $total_etudiants = mysqli_fetch_array($result_etudiants)[0];
        echo "$total_etudiants";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Apprenants</div>';
        echo '</div>';
        echo '</div>';

        // Pointages
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-yellow-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-yellow-500 opacity-20 text-4xl"><i class="fas fa-clipboard-check"></i></div>';
        echo '<div class="text-xs font-bold text-yellow-600 uppercase mb-2">Pointages</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_pointages = "SELECT COUNT(*) FROM pointage WHERE nom_ecole = '$nomEcole'";
        $result_pointages = mysqli_query($db, $query_pointages) or die(mysqli_error($db));
        $total_pointages = mysqli_fetch_array($result_pointages)[0];
        echo "$total_pointages";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Enregistrements</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Filles et pourcentage
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-pink-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-pink-500 opacity-20 text-4xl"><i class="fas fa-female"></i></div>';
        echo '<div class="text-xs font-bold text-pink-600 uppercase mb-2">Filles</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_filles = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Fille'";
        $result_filles = mysqli_query($db, $query_filles) or die(mysqli_error($db));
        $total_filles = mysqli_fetch_array($result_filles)[0];

        // Calcul du pourcentage de filles
        $percentage_filles = $total_etudiants > 0 ? ($total_filles / $total_etudiants) * 100 : 0;
        echo "$total_filles <span class=\"text-sm text-pink-500\">(" . round($percentage_filles, 2) . "%)</span>";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Étudiantes</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Garçons et pourcentage
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-indigo-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-indigo-500 opacity-20 text-4xl"><i class="fas fa-male"></i></div>';
        echo '<div class="text-xs font-bold text-indigo-600 uppercase mb-2">Garçons</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_garcons = "SELECT COUNT(*) FROM etudiant WHERE nom_ecole = '$nomEcole' AND sexe = 'Garçon'";
        $result_garcons = mysqli_query($db, $query_garcons) or die(mysqli_error($db));
        $total_garcons = mysqli_fetch_array($result_garcons)[0];

        // Calcul du pourcentage de garçons
        $percentage_garcons = $total_etudiants > 0 ? ($total_garcons / $total_etudiants) * 100 : 0;
        echo "$total_garcons <span class=\"text-sm text-indigo-500\">(" . round($percentage_garcons, 2) . "%)</span>";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Étudiants</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Utilisateurs
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-red-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-red-500 opacity-20 text-4xl"><i class="fas fa-users"></i></div>';
        echo '<div class="text-xs font-bold text-red-600 uppercase mb-2">Utilisateurs</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_utilisateurs = "SELECT COUNT(*) FROM utilisateur WHERE nom_ecole = '$nomEcole'";
        $result_utilisateurs = mysqli_query($db, $query_utilisateurs) or die(mysqli_error($db));
        $total_utilisateurs = mysqli_fetch_array($result_utilisateurs)[0];
        echo "$total_utilisateurs";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Comptes actifs</div>';
        echo '</div>';
        echo '</div>';

        // Nbre Classes
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-gray-700">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-gray-700 opacity-20 text-4xl"><i class="fas fa-school"></i></div>';
        echo '<div class="text-xs font-bold text-gray-700 uppercase mb-2">Classes</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        $query_classes = "SELECT COUNT(*) FROM classe WHERE nom_ecole = '$nomEcole'";
        $result_classes = mysqli_query($db, $query_classes) or die(mysqli_error($db));
        $total_classes = mysqli_fetch_array($result_classes)[0];
        echo "$total_classes";
        echo '</div>';
        echo '<div class="text-sm text-gray-500">Salles</div>';
        echo '</div>';
        echo '</div>';

        // Année Scolaire
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border-l-4 border-purple-500">';
        echo '<div class="p-6 text-center relative">';
        echo '<div class="absolute top-4 right-4 text-purple-500 opacity-20 text-4xl"><i class="fas fa-calendar-alt"></i></div>';
        echo '<div class="text-xs font-bold text-purple-600 uppercase mb-2">Année Scolaire</div>';
        echo '<div class="text-2xl font-bold text-gray-800">';
        echo $as;
        echo '</div>';
        echo '<div class="text-sm text-gray-500 bg-green-100 text-green-800 rounded-full px-2 py-1 inline-block">Actif</div>';
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Fin de la grid
        echo '</div>'; // Fin du container px-4

        echo '<div class="px-4 mt-8 mb-8">';
        echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';

        // Filles and Garçons Stats - Amélioration du design
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">';
        echo '<div class="text-center">';
        echo '<div class="text-sm font-bold text-indigo-600 uppercase mb-4">Répartition Filles / Garçons</div>';
        echo '<canvas id="genderChart" class="max-h-64 mx-auto"></canvas>';
        echo '</div>';
        echo '</div>';

        // Validation Status Stats - Amélioration du design
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">';
        echo '<div class="text-center">';
        echo '<div class="text-sm font-bold text-emerald-600 uppercase mb-4">Pointage Professeur</div>';
        echo '<canvas id="statusChart" class="max-h-64 mx-auto"></canvas>';
        echo '</div>';
        echo '</div>';

        // Regulier vs Candidat Libre Stats - Amélioration du design
        echo '<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">';
        echo '<div class="text-center">';
        echo '<div class="text-sm font-bold text-amber-600 uppercase mb-4">Statut des Étudiants</div>';
        echo '<canvas id="statutChart" class="max-h-64 mx-auto"></canvas>';
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Fin de la grid
        echo '</div>'; // Fin du container px-4

        // Close the row
        echo '</div>';

        // JavaScript for Chart.js
        echo '
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        // Gender Chart
        var ctx1 = document.getElementById("genderChart").getContext("2d");
        var genderChart = new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: ["Filles", "Garçons"],
                datasets: [{
                    label: "Répartition",
                    data: [' . $percentage_filles . ', ' . $percentage_garcons . '],
                    backgroundColor: ["#d946ef", "#3b82f6"],
                    borderColor: ["#ffffff", "#ffffff"],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: "70%",
                plugins: {
                    legend: {
                        position: "bottom",
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        },
                        backgroundColor: "rgba(0,0,0,0.7)",
                        padding: 10,
                        cornerRadius: 6
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
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
                    backgroundColor: ["#10b981", "#ef4444"],
                    borderColor: ["#10b981", "#ef4444"],
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        },
                        backgroundColor: "rgba(0,0,0,0.7)",
                        padding: 10,
                        cornerRadius: 6
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
                    backgroundColor: ["#3b82f6", "#f59e0b"],
                    borderColor: ["#3b82f6", "#f59e0b"],
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ": " + tooltipItem.raw.toFixed(2) + "%";
                            }
                        },
                        backgroundColor: "rgba(0,0,0,0.7)",
                        padding: 10,
                        cornerRadius: 6
                    }
                }
            }
        });
        </script>
        ';

        // Fin du script pour les graphiques
        echo '</script>
        ';
        } // Fermeture du if (result && mysqli_num_rows > 0) qui commence à la ligne 18
        } // Fermeture du if (isset($_SESSION['nom_user']) && isset($_SESSION['prenom_user'])) qui commence avant la ligne 18
        ?>
        <?php
include'../includes/footer.php';
?>
       