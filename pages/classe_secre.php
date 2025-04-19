<?php
include '../includes/connection.php';
include '../includes/sidebar_secre.php';
?>

<!-- Contenu principal -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Enregistrez une classe&nbsp;
            <button type="button" class="btn btn-primary bg-gradient-primary" data-toggle="modal" data-target="#ClasseModal" style="border-radius: 0px;">
                <i class="fas fa-fw fa-plus"></i>
            </button>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Code Classe</th>
                        <th>Libellé Classe</th>
                        <th>Année Scolaire</th>
                        <th>Niveau</th>
                        <th>Nombre de Tables</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM classe WHERE nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '" . $_SESSION['nom_user'] . "' AND prenom_user = '" . $_SESSION['prenom_user'] . "')";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    $row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "' . $_SESSION['nom_user'] . '" AND prenom_user = "' . $_SESSION['prenom_user'] . '"'));
                    $nom_ecole = $row_ecole['nom_ecole'];
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['code_classe'] . '</td>';
                        echo '<td>' . $row['libelle_classe'] . '</td>';
                        echo '<td>' . $row['annee_scolaire'] . '</td>';
                        echo '<td>' . $row['niveau'] . '</td>';
                        echo '<td>' . $row['nombre_table'] . '</td>';
                        echo '<td align="right"> 
                                <a type="button" class="btn btn-primary bg-gradient-primary" href="classe_secre_searchfrm.php?action=edit&id=' . $row['id_classe'] . '">
                                    <i class="fas fa-fw fa-list-alt"></i> Details
                                </a>
                              </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal pour enregistrer une classe -->
<div class="modal fade" id="ClasseModal" tabindex="-1" role="dialog" aria-labelledby="ClasseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ClasseModalLabel">Enregistrez une Classe</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="classe_secre_transac.php?action=add">
                    <div class="form-group">
                        <input class="form-control" placeholder="Code Classe" name="code_classe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Libellé Classe" name="libelle_classe" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="niveau" required>
                            <option value="" disabled selected>Sélectionnez un niveau</option>
                            <option>10éme-CG</option>
                            <option>11éme-SCIENCE</option>
                            <option>11éme-SES</option>
                            <option>11éme-LETTRE</option>
                            <option>12éme-TSE</option>
                            <option>12éme-TSEXP</option>
                            <option>12éme-TSS</option>
                            <option>12éme-TSECO</option>
                            <option>12éme-TLL</option>
                            <option>12éme-TAL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Année Scolaire" name="annee_scolaire" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Nombre de Tables" name="nombre_table" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="École" name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Envoyez</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> Effacez</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
    // Assurez-vous que la bibliothèque jQuery et Bootstrap JS sont chargées
    // Si la modale ne s'ouvre toujours pas, vérifiez les erreurs JS dans la console.
</script>
