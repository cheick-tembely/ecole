<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis sont remplis
    if (isset($_FILES['photo']['tmp_name']) && isset($_POST['classe']) && isset($_POST['annee']) && isset($_FILES['logo']['tmp_name'])) {
        // Récupérer les données du formulaire
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $classe = $_POST['classe'];
        $annee = $_POST['annee'];
        $logo_tmp = $_FILES['logo']['tmp_name'];

        // Chemin de destination pour enregistrer les fichiers
        $photo_destination = 'uploads/' . basename($_FILES['photo']['name']);
        $logo_destination = 'uploads/' . basename($_FILES['logo']['name']);

        // Déplacer les fichiers téléchargés vers le dossier de destination
        move_uploaded_file($photo_tmp, $photo_destination);
        move_uploaded_file($logo_tmp, $logo_destination);

        // Afficher les données sur la carte
        echo '<div class="profile-card">';
        echo '<div class="profile-picture">';
        echo '<img src="' . $photo_destination . '" alt="Photo de l\'élève" style="width: 100%; height: 100%;">';
        echo '</div>';
        echo '<div class="class-info">';
        echo '<p>Classe : ' . $classe . '</p>';
        echo '<p>Année Scolaire : ' . $annee . '</p>';
        echo '</div>';
        echo '<div class="school-logo">';
        echo '<img src="' . $logo_destination . '" alt="Logo de l\'école" style="width: 100%; height: 100%;">';
        echo '</div>';
        echo '<h3 class="card-title">Profil de l\'Élève</h3>';
        echo '</div>';
    } 
} else {
    // Si le formulaire n'a pas été soumis via POST, afficher un message d'erreur
    echo "Le formulaire doit être soumis via POST.";
}
?>
