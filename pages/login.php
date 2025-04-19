<?php require('session.php');?>
<?php if(logged_in()){ ?>
    <script type="text/javascript">
        window.location = "index.php";
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ECOLE-GEST - Système de gestion scolaire">
    <meta name="author" content="">
    <title>ECOLE-GEST</title>
    <link rel="icon" type="image/x-icon" href="../pages/ecole-gest.jpg" />
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
            border-bottom: 2px solid #667eea;
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
            color: #667eea;
        }
        .logo-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-5">
    <div class="container max-w-5xl mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="login-card rounded-xl overflow-hidden">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Left side with image -->
                        <div class="lg:w-1/2 relative hidden lg:block">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-90"></div>
                            <img src="../pages/ecole-gest.jpg" class="h-full w-full object-cover" alt="ECOLE-GEST">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-10">
                                <div class="logo-animation mb-6">
                                    <i class="fas fa-graduation-cap text-6xl"></i>
                                </div>
                                <h2 class="text-3xl font-bold mb-4 text-center">ECOLE-GEST</h2>
                                <p class="text-center mb-6">Système de gestion scolaire complet et moderne</p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Gestion des notes</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Suivi des élèves</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle mr-3"></i>
                                        <span>Communication avec les parents</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right side with login form -->
                        <div class="lg:w-1/2 p-8 lg:p-12">
                            <div class="text-center mb-8">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Bienvenue</h1>
                                <p class="text-gray-600">Connectez-vous à votre compte</p>
                            </div>
                            
                            <form class="space-y-6" role="form" action="processlogin.php" method="post">
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           name="user" type="text" required>
                                    <label class="text-gray-500">Nom d'utilisateur</label>
                                </div>
                                
                                <div class="input-effect">
                                    <input class="w-full px-4 py-3 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none" 
                                           name="password" type="password" required>
                                    <label class="text-gray-500">Mot de passe</label>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" id="customCheck" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="customCheck" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
                                </div>
                                
                                <button class="btn-primary w-full py-3 px-4 rounded-lg text-white font-medium focus:outline-none" 
                                        type="submit" name="btnlogin">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                                </button>
                                
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">ou</span>
                                    </div>
                                </div>
                                
                                <a href="eleve_login.php" class="block w-full text-center py-3 px-4 rounded-lg border-2 border-indigo-500 text-indigo-600 font-medium hover:bg-indigo-50 transition-colors duration-300">
                                    <i class="fas fa-user-graduate mr-2"></i>Connexion pour les élèves
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
    <script src="../vendor/jquery/jquery.min.js"></script>
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
</body>
</html>
