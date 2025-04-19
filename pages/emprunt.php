<?php
session_start();
// Inclusion du fichier de connexion à la base de données
include '../includes/connection.php';
include '../includes/sidebar_eleve.php';

// Récupération de la liste des livres disponibles
$query_livres = "SELECT l.id_livre, l.nom AS nom_livre, e.date_retour
                 FROM livre l
                 LEFT JOIN emprunts e ON l.id_livre = e.id_livre
                 WHERE e.date_retour IS NULL OR e.date_retour <= CURDATE() and e.champ_visible=1";

$result_livres = mysqli_query($db, $query_livres) or die(mysqli_error($db));

echo '<div class="table-responsive">';
echo '<table class="table table-bordered table-striped" id="livresTable" width="100%" cellspacing="0">';
echo '<thead>';
echo '<tr><th scope="col">Nom du Livre</th><th scope="col">Statut</th><th scope="col">Action</th></tr>';
echo '</thead>';
echo '<tbody>';

while ($row_livre = mysqli_fetch_assoc($result_livres)) {
    $id_livre = $row_livre['id_livre'];
    $nom_livre = $row_livre['nom_livre'];
    $statut = 'Disponible';
    $action = '<button class="btn-emprunter btn btn-primary btn-sm" data-id="' . $id_livre . '">Emprunter</button>';

    echo '<tr>';
    echo '<td>' . $nom_livre . '</td>';
    echo '<td>' . $statut . '</td>';
    echo '<td>' . $action . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
?>

<style>
    /* Style général */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .table {
        margin-top: 20px;
        background-color: #ffffff;
    }

    /* Style des boutons */
    .btn-emprunter {
        display: inline-block;
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 5px;
    }

    .btn-emprunter:hover {
        background-color: #0056b3;
    }

    /* Style du formulaire dynamique */
    form {
        margin-top: 15px;
        padding: 15px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    form input, form button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    form button {
        background-color: #007bff;
        color: white;
        border: none;
    }

    form button:hover {
        background-color: #0056b3;
    }

    /* Responsive design pour les petits écrans */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        form {
            width: 90%;
            margin: auto;
        }
    }
</style>

<script>
    // Script JavaScript pour gérer les formulaires d'emprunt dynamiques
    document.addEventListener('DOMContentLoaded', function() {
        const btnsEmprunter = document.querySelectorAll('.btn-emprunter');

        btnsEmprunter.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault(); // Empêche le comportement par défaut
                const idLivre = this.getAttribute('data-id');
                showEmpruntForm(idLivre, this);
            });
        });

        function showEmpruntForm(idLivre, btnClicked) {
            // Vérifie s'il existe déjà un formulaire pour éviter les doublons
            const existingForm = btnClicked.parentNode.querySelector('form');
            if (existingForm) return;

            // Création dynamique du formulaire
            const form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'emprunt.php');

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
            inputNom.required = true;
            form.appendChild(inputNom);

            // Champ pour le prénom
            const inputPrenom = document.createElement('input');
            inputPrenom.setAttribute('type', 'text');
            inputPrenom.setAttribute('name', 'prenom');
            inputPrenom.setAttribute('placeholder', 'Prénom');
            inputPrenom.required = true;
            form.appendChild(inputPrenom);

            // Champ pour la classe
            const inputClasse = document.createElement('input');
            inputClasse.setAttribute('type', 'text');
            inputClasse.setAttribute('name', 'classe');
            inputClasse.setAttribute('placeholder', 'Classe');
            inputClasse.required = true;
            form.appendChild(inputClasse);

            // Champ pour la date d'emprunt
            const inputDateEmprunt = document.createElement('input');
            inputDateEmprunt.setAttribute('type', 'date');
            inputDateEmprunt.setAttribute('name', 'date_emprunt');
            inputDateEmprunt.required = true;
            form.appendChild(inputDateEmprunt);

            // Bouton de soumission
            const btnSubmit = document.createElement('button');
            btnSubmit.setAttribute('type', 'submit');
            btnSubmit.textContent = 'Emprunter';
            form.appendChild(btnSubmit);

            // Insérer le formulaire avant le bouton cliqué
            btnClicked.parentNode.insertBefore(form, btnClicked);
        }
    });
</script>
