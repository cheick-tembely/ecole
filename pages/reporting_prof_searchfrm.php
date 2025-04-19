<?php
error_reporting(E_ERROR | E_PARSE); // Désactive les avertissements

include '../includes/connection.php';
include '../includes/sidebar_prof.php';

$id_professeur = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_professeur) {
    // Vérifier si le formulaire a été soumis pour obtenir le prix personnalisé
    $prix = isset($_POST['prix']) ? $_POST['prix'] : 10000; // Valeur par défaut

    // Déterminer le mois et l'année précédents
    $mois_precedent = date('m', strtotime('-1 month'));
    $annee_precedente = date('Y');

    $query = "SELECT p.*, pr.nom_professeur, pr.prenom_professeur, cl.code_classe, m.libelle_matiere 
              FROM pointage p
              JOIN professeur pr ON p.id_professeur = pr.id_professeur
              JOIN classe cl ON p.id_classe = cl.id_classe
              JOIN matiere m ON p.id_matiere = m.id_matiere
              WHERE p.id_professeur = $id_professeur
              AND MONTH(p.date_debut) = $mois_precedent
              AND YEAR(p.date_debut) = $annee_precedente";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if (mysqli_num_rows($result) > 0) {
        $total_a_payer = 0;
?>
        <!-- Formulaire pour saisir le prix -->
        <form method="POST" action="">
            <label for="prix">Prix par heure :</label>
            <input type="text" id="prix" name="prix" value="<?php echo $prix; ?>" >

        </form>

        <!-- Tableau des fiches de pointage -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold text-primary">Fiches de Pointage du Mois Précédent</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Code Classe</th>
                                <th>Matière</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Volume horaire</th>
                                <th>Statut</th>
                                <th>Prix</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $date_debut = new DateTime($row['date_debut']);
                                $date_fin = new DateTime($row['date_fin']);
                                $volume_horaire = $date_debut->diff($date_fin)->format('%H:%I');

                                // Calcul du total en fonction du prix saisi
                                $total = $volume_horaire * $prix;
                                $total_a_payer += $total;

                                echo '<tr>';
                                echo '<td>'. $row['nom_professeur'].'</td>';
                                echo '<td>'. $row['prenom_professeur'].'</td>';
                                echo '<td>'. $row['code_classe'].'</td>';
                                echo '<td>'. $row['libelle_matiere'].'</td>';
                                echo '<td>'. $row['date_debut'].'</td>';
                                echo '<td>'. $row['date_fin'].'</td>';
                                echo '<td>'. $volume_horaire.'</td>';
                                echo '<td>'. $row['statut'].'</td>';
                                echo '<td>'. $prix.'</td>';
                                echo '<td>'. $total.'</td>';
                                echo '<td align="right">
                                        <a type="button" class="btn btn-primary bg-gradient-primary" href="facture_prof.php?id='.$row['id_professeur'].'"><i class="fas fa-file-invoice"></i> Facture</a>
                                      </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10" align="right"><strong>Total à Payer :</strong></td>
                                <td><?php echo $total_a_payer; ?> FCFA</td>
                              
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.payer-tous-btn').click(function() {
                    // Envoyer une requête Ajax vers le script PHP pour effectuer la mise à jour dans la base de données
                    $.ajax({
                        url: 'mise_a_jour_statut.php',
                        method: 'POST',
                        success: function(response) {
                            // Actualiser la page pour refléter les changements dans le tableau
                            window.location.reload(true);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            console.log(status);
                            console.log(error);
                        }
                    });
                });
            });
        </script>
<?php
    } else {
        echo "<p>Aucune fiche de pointage trouvée pour ce professeur au mois précédent.</p>";
    }
} else {
    echo "<p>Aucun ID de professeur spécifié.</p>";
}

include '../includes/footer.php';
?>
