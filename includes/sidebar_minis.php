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
            <a href="index_minis.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-home w-5 h-5 mr-3"></i>
              <span>Accueil</span>
            </a>
          </li>

          <!-- Message aux Administrateur Local -->
          <li>
            <a href="email_minis.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-envelope w-5 h-5 mr-3"></i>
              <span>Message aux Administrateur Local</span>
            </a>
          </li>

          <!-- Administrateur Local -->
          <li>
            <a href="user_minis_provi.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-users w-5 h-5 mr-3"></i>
              <span>Administrateur Local</span>
            </a>
          </li>

          <!-- Ecole -->
          <li>
            <a href="ecole_minis.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-school w-5 h-5 mr-3"></i>
              <span>Ecole</span>
            </a>
          </li>

          <!-- Paramétrage des Ecoles -->
          <li>
            <a href="parametrage_minis.php" class="sidebar-item flex items-center px-4 py-3 text-white hover:text-white transition-colors duration-200">
              <i class="fas fa-cogs w-5 h-5 mr-3"></i>
              <span>Paramétrage des Ecoles</span>
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

    <?php include_once 'topbar.php'; ?>
