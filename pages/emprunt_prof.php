<?php
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_prof.php';

// Récupération de la liste des livres avec leur statut de disponibilité (seulement les livres disponibles)
$query_livres = "SELECT l.id_livre, l.nom AS nom_livre, e.date_retour
                 FROM livre l
                 LEFT JOIN emprunts e ON l.id_livre = e.id_livre
                 WHERE (e.date_retour IS NULL OR e.date_retour <= CURDATE()) AND l.nom_ecole = (SELECT nom_ecole FROM utilisateur WHERE nom_user = '".$_SESSION['nom_user']."' AND prenom_user = '".$_SESSION['prenom_user']."'limit 1)";


$result_livres = mysqli_query($db, $query_livres) or die(mysqli_error($db));

echo '<div class="table-responsive">';
echo '<table class="table table-bordered table-striped" id="livresTable" width="100%" cellspacing="0">';
echo '<thead>';
echo '<tr><th scope="col">Nom du Livre</th><th scope="col">Statut</th><th scope="col">Action</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row_livre = mysqli_fetch_assoc($result_livres)) {
    $id_livre = $row_livre['id_livre'];
    $nom_livre = $row_livre['nom_livre']; // Nom du livre à afficher dans la table
    $date_retour = $row_livre['date_retour'];

    $statut = 'Disponible'; // Comme nous ne récupérons que les livres disponibles, le statut est toujours "Disponible"
    $action = '<button class="btn-emprunter" data-id="' . $id_livre . '">Emprunter</button>'; // Bouton pour emprunter

    echo '<tr>';
    echo '<td>'. $nom_livre .'</td>';
    echo '<td>'. $statut .'</td>';
    echo '<td>'. $action .'</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Inclusion du fichier de pied de page

?>

<script>
    // Script JavaScript pour afficher le formulaire d'emprunt lorsque l'utilisateur clique sur "Emprunter"
    document.addEventListener('DOMContentLoaded', function() {
        const btnsEmprunter = document.querySelectorAll('.btn-emprunter');

        btnsEmprunter.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du bouton
                const idLivre = this.getAttribute('data-id');
                showEmpruntForm(idLivre, this);
            });
        });

        function showEmpruntForm(idLivre, btnClicked) {
            // Création dynamique du formulaire d'emprunt
            const form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'emprunt.php'); // Action du formulaire vers votre fichier PHP de traitement

            // Champ caché pour l'ID du livre
            const hiddenInputIdLivre = document.createElement('input');
            hiddenInputIdLivre.setAttribute('type', 'hidden');
            hiddenInputIdLivre.setAttribute('name', 'id_livre');
            hiddenInputIdLivre.setAttribute('value', idLivre);
            form.appendChild(hiddenInputIdLivre);

            // Champ pour le nom
            const inputNom = document.createElement('input');
            inputNom.setAttribute('type', 'text');
            inputNom.setAttribute('name', 'nom');
            inputNom.setAttribute('placeholder', 'Nom');
            form.appendChild(inputNom);

            // Champ pour le prénom
            const inputPrenom = document.createElement('input');
            inputPrenom.setAttribute('type', 'text');
            inputPrenom.setAttribute('name', 'prenom');
            inputPrenom.setAttribute('placeholder', 'Prénom');
            form.appendChild(inputPrenom);

            // Champ pour la classe
            const inputClasse = document.createElement('input');
            inputClasse.setAttribute('type', 'text');
            inputClasse.setAttribute('name', 'classe');
            inputClasse.setAttribute('placeholder', 'Classe');
            form.appendChild(inputClasse);

            // Champ pour la date d'emprunt
            const inputDateEmprunt = document.createElement('input');
            inputDateEmprunt.setAttribute('type', 'date');
            inputDateEmprunt.setAttribute('name', 'date_emprunt');
            form.appendChild(inputDateEmprunt);

            // Bouton de soumission du formulaire
            const btnSubmit = document.createElement('button');
            btnSubmit.setAttribute('type', 'submit');
            btnSubmit.textContent = 'Emprunter';
            form.appendChild(btnSubmit);

            // Insérer le formulaire avant le bouton cliqué
            btnClicked.parentNode.insertBefore(form, btnClicked);
        }
    });
</script>

<?php
// Vérification si le formulaire d'emprunt a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Récupération des données du formulaire
$id_livre = $_POST['id_livre'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$classe = $_POST['classe'];
$date_emprunt = $_POST['date_emprunt'];

// Préparation de la requête d'insertion dans la table commande
$query_commande = "INSERT INTO commande (id_livre, nom, prenom, classe, date_emprunt) 
                   VALUES ('$id_livre', '$nom', '$prenom', '$classe', '$date_emprunt')";

// Exécution de la requête d'insertion
$result_commande = mysqli_query($db, $query_commande);

if ($result_commande) {
    echo "Les données ont été insérées avec succès dans la table commande.";
} else {
    echo "Erreur lors de l'insertion des données dans la table commande: " . mysqli_error($db);
}
}
