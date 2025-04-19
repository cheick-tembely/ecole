<?php
// Commencer ou reprendre une session - must be at the very top before any output
session_start();

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs saisies
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom_tuteur = htmlspecialchars($_POST['nom_tuteur']);
    $prenom_tuteur = htmlspecialchars($_POST['prenom_tuteur']);
    $telephone_tuteur = htmlspecialchars($_POST['telephone_tuteur']);

    // Enregistrer les informations dans des variables de session
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom_tuteur'] = $nom_tuteur;
    $_SESSION['prenom_tuteur'] = $prenom_tuteur;
    $_SESSION['telephone_tuteur'] = $telephone_tuteur;

    // Redirection vers une autre page après connexion réussie
    header('Location:index_eleve.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECOLE-GEST - Espace Élève</title>
    <link rel="icon" type="image/x-icon" href="ecole-gest.jpg" />
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            background-size: cover;
            height: 100vh;
        }
        .login-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background-image: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 206, 162, 0.4);
        }
        .input-effect {
            position: relative;
            margin-bottom: 30px;
        }
        .input-effect input {
            transition: all 0.3s ease;
            border-bottom: 2px solid #ddd;
        }
        .input-effect input:focus {
            border-bottom: 2px solid #43cea2;
            box-shadow: none;
        }
        .input-effect label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .input-effect input:focus ~ label,
        .input-effect input:valid ~ label {
            top: -20px;
            font-size: 0.8rem;
            color: #43cea2;
        }
        .logo-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('https://i.imgur.com/ZAts69f.png');
            background-size: 1000px 100px;
        }
        .wave.wave1 {
            animation: animate 30s linear infinite;
            z-index: 1000;
            opacity: 1;
            animation-delay: 0s;
            bottom: 0;
        }
        .wave.wave2 {
            animation: animate2 15s linear infinite;
            z-index: 999;
            opacity: 0.5;
            animation-delay: -5s;
            bottom: 10px;
        }
        .wave.wave3 {
            animation: animate 30s linear infinite;
            z-index: 998;
            opacity: 0.2;
            animation-delay: -2s;
            bottom: 15px;
        }
        .wave.wave4 {
            animation: animate2 5s linear infinite;
            z-index: 997;
            opacity: 0.7;
            animation-delay: -5s;
            bottom: 20px;
        }
        @keyframes animate {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1000px;
            }
        }
        @keyframes animate2 {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: -1000px;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-5 overflow-hidden">
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
    
    <div class="container max-w-5xl mx-auto relative z-10">
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="login-card rounded-xl overflow-hidden">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Left side with image -->
                        <div class="lg:w-1/2 relative hidden lg:block">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-blue-600 opacity-90"></div>
                            <img src="ecole-gest.jpg" class="h-full w-full object-cover" alt="ECOLE-GEST">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-10">
                                <div class="logo-animation mb-6">
                                    <i class="fas fa-user-graduate text-6xl"></i>
                                </div>
                                <h2 class="text-3xl font-bold mb-4 text-center">Espace Élève</h2>
                                <p class="text-center mb-6">Accédez à vos informations scolaires en toute simplicité</p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Consultez vos notes</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Suivez votre emploi du temps</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Communiquez avec vos enseignants</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right side with login form -->
                        <div class="lg:w-1/2 p-8 lg:p-12">
                            <div class="text-center mb-8">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Bienvenue</h1>
                                <p class="text-gray-600">Connectez-vous à votre espace élève</p>
                            </div>
                            
                            <form class="space-y-6" action="" method="post">
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           id="nom" name="nom" type="text" required>
                                    <label class="text-gray-500">Nom</label>
                                </div>
                                
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           id="prenom" name="prenom" type="text" required>
                                    <label class="text-gray-500">Prénom</label>
                                </div>
                                
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           id="nom_tuteur" name="nom_tuteur" type="text" required>
                                    <label class="text-gray-500">Nom du Tuteur</label>
                                </div>
                                
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           id="prenom_tuteur" name="prenom_tuteur" type="text" required>
                                    <label class="text-gray-500">Prénom du Tuteur</label>
                                </div>
                                
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           id="telephone_tuteur" name="telephone_tuteur" type="tel" required>
                                    <label class="text-gray-500">Téléphone du Tuteur</label>
                                </div>
                                
                                <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium focus:outline-none">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                                </button>
                                
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">ou</span>
                                    </div>
                                </div>
                                
                                <a href="login.php" class="block w-full text-center py-3 px-4 rounded-lg border-2 border-blue-500 text-blue-600 font-medium hover:bg-blue-50 transition-colors duration-300">
                                    <i class="fas fa-user-shield mr-2"></i>Espace Administration
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-6 text-white text-sm">
                    <p>&copy; <?php echo date('Y'); ?> ECOLE-GEST. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Animation for input fields
        $(document).ready(function() {
            // Check if inputs have values on page load
            $('input').each(function() {
                if ($(this).val() !== '') {
                    $(this).siblings('label').addClass('active');
                }
            });
            
            // Add subtle animation when page loads
            $('.login-card').css('opacity', 0);
            setTimeout(function() {
                $('.login-card').css({
                    'opacity': 1,
                    'transition': 'opacity 0.8s ease'
                });
            }, 300);
        });
    </script>
