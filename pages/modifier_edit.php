<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_bibli.php';
$row_ecole = mysqli_fetch_assoc(mysqli_query($db, 'SELECT nom_ecole FROM utilisateur WHERE nom_user = "'.$_SESSION['nom_user'].'" AND prenom_user = "'.$_SESSION['prenom_user'].'"'));
$nom_ecole = $row_ecole['nom_ecole'];
// Vérification si l'ID de la commande est spécifié dans l'URL
if (isset($_GET['id'])) {
    $id_commande = $_GET['id'];

    // Préparation de la requête pour récupérer les informations de la commande
    $query_commande_info = "SELECT c.*, l.nom AS nom_livre 
                            FROM commande c 
                            INNER JOIN livre l ON c.id_livre = l.id_livre 
                            WHERE c.id_commande = $id_commande and c.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."')";
    $result_commande_info = mysqli_query($db, $query_commande_info);

    if ($result_commande_info && mysqli_num_rows($result_commande_info) > 0) {
        $row_commande_info = mysqli_fetch_assoc($result_commande_info);
        $id_livre = $row_commande_info['id_livre'];
        $nom_livre = $row_commande_info['nom_livre'];
        $nom_emprunteur = $row_commande_info['nom'];
        $prenom_emprunteur = $row_commande_info['prenom'];
        $date_emprunt = $row_commande_info['date_emprunt'];

        // Maintenant, vous pouvez utiliser ces variables pour pré-remplir le formulaire
    } else {
        echo "Erreur : Commande non trouvée.";
    }
} else {
    echo "Erreur : ID de la commande non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commande</title>
</head>
<body>
    <h1>Modifier Commande</h1>
    <form method="post" action="traitement_modifier.php">
    <input type="hidden" name="id_commande" value="<?php echo $id_commande; ?>">
    <div class="form-group">
        <label for="nom_livre">Nom Livre:</label>
        <input type="text" id="nom_livre" name="nom_livre" value="<?php echo $nom_livre; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="nom_emprunteur">Nom Emprunteur:</label>
        <input type="text" id="nom_emprunteur" name="nom_emprunteur" value="<?php echo $nom_emprunteur; ?>" required>
    </div>
    <div class="form-group">
        <label for="prenom_emprunteur">Prénom Emprunteur:</label>
        <input type="text" id="prenom_emprunteur" name="prenom_emprunteur" value="<?php echo $prenom_emprunteur; ?>" required>
    </div>
    <div class="form-group">
        <label for="date_emprunt">Date Emprunt:</label>
        <input type="date" id="date_emprunt" name="date_emprunt" value="<?php echo $date_emprunt; ?>" required>
    </div>
    <div class="form-group">
        <label for="date_retour">Date Retour:</label>
        <input type="date" id="date_retour" name="date_retour" required>
    </div>
    <div class="form-group">
        <label for="nom_ecole">Ecole:</label>
        <input  name="nom_ecole" value="<?php echo $nom_ecole; ?>" required readonly>
    </div>
    <button type="submit">Enregistrer</button>
</form>

</body>
</html>
<?php
include'../includes/footer.php';
?>