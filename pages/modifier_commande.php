<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';

// Récupération de la liste des commandes avec les noms des livres correspondants
$query_commandes = "SELECT c.id_commande, c.id_livre, c.nom AS nom_emprunteur, c.prenom AS prenom_emprunteur, c.classe, c.date_emprunt, l.nom AS nom_livre
                    FROM commande c
                    INNER JOIN livre l ON c.id_livre = l.id_livre and c.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."') and c.champ_visible=1";
$result_commandes = mysqli_query($db, $query_commandes) or die(mysqli_error($db));

echo '<div class="table-responsive">';
echo '<table class="table table-bordered table-striped" id="commandesTable" width="100%" cellspacing="0">';
echo '<thead>';
echo '<tr><th scope="col">ID Commande</th><th scope="col">Nom Livre</th><th scope="col">Nom Emprunteur</th><th scope="col">Prénom Emprunteur</th><th scope="col">Classe</th><th scope="col">Date Emprunt</th><th scope="col">Action</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row_commande = mysqli_fetch_assoc($result_commandes)) {
    $id_commande = $row_commande['id_commande'];
    $nom_livre = $row_commande['nom_livre'];
    $nom_emprunteur = $row_commande['nom_emprunteur'];
    $prenom_emprunteur = $row_commande['prenom_emprunteur'];
    $classe = $row_commande['classe'];
    $date_emprunt = $row_commande['date_emprunt'];

    echo '<tr>';
    echo '<td>'. $id_commande .'</td>';
    echo '<td>'. $nom_livre .'</td>';
    echo '<td>'. $nom_emprunteur .'</td>';
    echo '<td>'. $prenom_emprunteur .'</td>';
    echo '<td>'. $classe .'</td>';
    echo '<td>'. $date_emprunt .'</td>';
    
    echo '<td><a href="modifier_edit.php?id=' . $id_commande . '">Modifier</a></td>';

    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Inclusion du fichier de pied de page
?>
<?php
include'../includes/footer.php';
?>