<?php
include '../includes/connection.php';
?>
<style>
    /* Styles pour corriger la largeur de la topbar */
    #wrapper {
        width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    #content-wrapper {
        width: 100% !important;
    }

    .navbar {
        width: 100% !important;
        margin: 0 !important;
    }
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'envoi d'e-mail</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen w-screen">
    <?php include '../includes/sidebar_minis.php'; ?>
    <div class="container mx-auto px-4 py-8 h-full w-full max-w-full">
        <div class="h-[calc(100vh-200px)] flex flex-col w-full">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Formulaire d'envoi d'e-mail</h1>
                <p class="text-gray-600">Envoyez vos messages en toute simplicité</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 flex-1 flex flex-col w-full mx-auto border border-gray-100">
                <form action="envoi_email_minis.php" method="post" class="space-y-12 flex-1 flex flex-col w-full">
                    <div class="w-full">
                        <label for="destinataire" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>
                            Adresse du destinataire
                        </label>
                        <input type="email" 
                               id="destinataire" 
                               name="destinataire" 
                               required 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 shadow-sm"
                               placeholder="exemple@email.com">
                    </div>

                    <div class="flex-1 w-full">
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-pen-fancy text-blue-500 mr-2"></i>
                            Message
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  required 
                                  class="w-full h-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none shadow-sm"
                                  placeholder="Écrivez votre message ici..."></textarea>
                    </div>

                    <div class="flex justify-end pt-4 w-full">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-xl transition-all duration-200 flex items-center shadow-lg hover:shadow-blue-200 hover:-translate-y-1">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
<?php
include'../includes/footer.php';
?>
