<?php
  require('session.php');
  confirm_logged_in();
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">

  <title> ECOLE-GEST </title>
  <!-- Favicon-->
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
    }
    
    .sidebar-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 0.375rem;
    }
    
    .sidebar-item.active {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 0.375rem;
    }
    
    #overlay {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5);
      z-index: 50;
      cursor: pointer;
    }
    
    #text {
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 1.5rem;
      color: white;
      transform: translate(-50%,-50%);
    }
  </style>
</head>

<body class="bg-gray-100">
  
          
  <!-- Page Wrapper -->
  <div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-gradient-to-b from-indigo-700 to-purple-800 text-white w-64 flex-shrink-0 transition-all duration-300 ease-in-out flex flex-col h-full">
      <!-- Sidebar - Brand -->
      <div class="flex items-center justify-center py-6 border-b border-indigo-800 flex-shrink-0">
        <div class="flex items-center space-x-3">
          <img src="ecole-gest.jpg" class="w-10 h-10 rounded-full">
          <div class="text-xl font-bold">ECOLE-GEST</div>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-b border-indigo-800 my-2 flex-shrink-0"></div>

      <!-- Nav Items -->
      <div class="px-4 py-2 overflow-y-auto flex-grow" style="max-height: calc(100vh - 150px);">
        <ul class="space-y-1">
          <!-- Dashboard -->
          <li>
            <a href="index.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-home w-5 h-5 mr-3"></i>
              <span>Accueil</span>
            </a>
          </li>
          
          <!-- Notes -->
          <li>
            <a href="note_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
              <span>Notes</span>
            </a>
          </li>
          
          <!-- Niveau Enseignement -->
          <li>
            <a href="niveau_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-chalkboard-teacher w-5 h-5 mr-3"></i>
              <span>Niveau Enseignement</span>
            </a>
          </li>
          
          <!-- Professeur -->
          <li>
            <a href="prof_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-users w-5 h-5 mr-3"></i>
              <span>Professeur</span>
            </a>
          </li>
          
          <!-- Message aux Professeurs -->
          <li>
            <a href="message_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-envelope w-5 h-5 mr-3"></i>
              <span>Message aux Professeurs</span>
            </a>
          </li>
          
          <!-- Message Grouper aux Parents d'Elèves -->
          <li>
            <a href="message_grouper_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-comments w-5 h-5 mr-3"></i>
              <span>Message Grouper aux Parents</span>
            </a>
          </li>
          
          <!-- Classe -->
          <li>
            <a href="classe_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i>
              <span>Classe</span>
            </a>
          </li>
          
          <!-- Matière -->
          <li>
            <a href="matiere_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-book-open w-5 h-5 mr-3"></i>
              <span>Matière</span>
            </a>
          </li>
          
          <!-- Attribution Des Cours -->
          <li>
            <a href="attri_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-cogs w-5 h-5 mr-3"></i>
              <span>Attribution Des Cours</span>
            </a>
          </li>
          
          <!-- Programmes -->
          <li>
            <a href="programme_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-list-alt w-5 h-5 mr-3"></i>
              <span>Programmes</span>
            </a>
          </li>
          
          <!-- Fiche de sequence -->
          <li>
            <a href="fiche_sequence_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
              <span>Fiche de sequence</span>
            </a>
          </li>
          
          <!-- Listes Des Parents d'Elèves -->
          <li>
            <a href="parent_eleve_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-users w-5 h-5 mr-3"></i>
              <span>Parents d'Elèves</span>
            </a>
          </li>
          
          <!-- Utilisateurs -->
          <li>
            <a href="user_admin.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-user w-5 h-5 mr-3"></i>
              <span>Utilisateurs</span>
            </a>
          </li>
          
          <!-- Envoyer Email -->
          <li>
            <a href="email.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-envelope w-5 h-5 mr-3"></i>
              <span>Envoyer Email</span>
            </a>
          </li>
          
          <!-- Réinitialiser Données -->
          <li>
            <a href="donnee.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-database w-5 h-5 mr-3"></i>
              <span>Réinitialiser Données</span>
            </a>
          </li>
          
          <!-- Liste des Transferts -->
          <li>
            <a href="transfert.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-exchange-alt w-5 h-5 mr-3"></i>
              <span>Liste des Transferts</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Divider -->
      <div class="border-b border-indigo-800 my-2 flex-shrink-0"></div>

      <!-- Sidebar Toggler -->
      <div class="text-center py-4 flex-shrink-0">
        <button id="sidebarToggle" class="p-2 rounded-full bg-indigo-800 text-white hover:bg-indigo-900 focus:outline-none">
          <i class="fas fa-chevron-left"></i>
        </button>
      </div>
    </div>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div class="flex-1 overflow-auto">
      

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        sidebarToggle.addEventListener('click', function() {
          if (sidebar.classList.contains('w-64')) {
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-20');
            document.querySelectorAll('.sidebar-item span').forEach(span => {
              span.classList.add('hidden');
            });
            this.innerHTML = '<i class="fas fa-chevron-right"></i>';
          } else {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-64');
            document.querySelectorAll('.sidebar-item span').forEach(span => {
              span.classList.remove('hidden');
            });
            this.innerHTML = '<i class="fas fa-chevron-left"></i>';
          }
        });
        
        // Highlight active menu item
        const currentPath = window.location.pathname;
        const filename = currentPath.substring(currentPath.lastIndexOf('/') + 1);
        
        document.querySelectorAll('.sidebar-item').forEach(item => {
          const href = item.getAttribute('href');
          if (href === filename) {
            item.classList.add('active');
          }
        });
      });
    </script>
<?php include_once 'topbar.php'; ?>