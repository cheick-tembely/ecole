<?php
include '../includes/connection.php';
include '../includes/sidebar_surv.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Liste Des Parents d'Elèves</h4>
    </div>
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Nom Elève</th>
                        <th>Prenom Elève</th>
                        <th>Nom du Tuteur</th>
                        <th>Prenom du Tuteur</th>
                        <th>Telephone du Tuteur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = 'SELECT * FROM etudiant where nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'")and champ_visible=1 ';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td>' . $row['prenom'] . '</td>';
                        echo '<td>' . $row['nom_tuteur'] . '</td>';
                        echo '<td>' . $row['prenom_tuteur'] . '</td>';
                        echo '<td>' . $row['telephone_tuteur'] . '</td>';
                        echo '<td align="right">
                                <a type="button" class="btn btn-primary bg-gradient-primary" style="color:white;" data-toggle="modal" data-target="#messageModal' . $row['id_etudiant'] . '">
                                    <i class="fas fa-envelope"></i> Envoyer un message
                                </a>
                              </td>';
                        echo '</tr>';

                        // Modal pour le message
                        echo '<div class="modal fade" id="messageModal' . $row['id_etudiant'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Envoyer un message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="envoyer_message_surv.php" method="POST">
                                                <input type="hidden" name="destinataire_id" value="' . $row['id_etudiant'] . '">
                                                <div class="form-group">
                                                    <label for="envoyeur">Nom de l\'envoyeur :</label>
                                                    <input type="text" class="form-control" id="envoyeur" name="envoyeur" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nom_destinataire">Nom du destinataire :</label>
                                                    <input type="text" class="form-control" id="nom_destinataire" name="nom_destinataire" value="' . $row['nom_tuteur'] . '" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom_destinataire">Prénom du destinataire :</label>
                                                    <input type="text" class="form-control" id="prenom_destinataire" name="prenom_destinataire" value="' . $row['prenom_tuteur'] . '" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="poste_envoyeur">Poste de l\'envoyeur :</label>
                                                    <input type="text" class="form-control" id="poste_envoyeur" name="poste_envoyeur" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Message :</label>
                                                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Envoyer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>
