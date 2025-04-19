<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="bg-white shadow-md px-4 py-3 flex items-center justify-between">
      <!-- Sidebar Toggle (Topbar) - Mobile only -->
      <button id="sidebarToggleTop" class="md:hidden text-indigo-600 hover:text-indigo-800 focus:outline-none">
        <i class="fa fa-bars text-xl"></i>
      </button>

      <!-- School Name - Desktop only -->
      <div class="hidden md:block">
        <h2 class="text-gray-700 font-semibold">
          <?php 
            if(isset($_SESSION['nom_ecole'])) {
              echo $_SESSION['nom_ecole']; 
            } else {
              echo "ECOLE-GEST";
            }
          ?>
        </h2>
      </div>

      <!-- Topbar Navbar -->
      <div class="flex items-center space-x-4">
        <!-- Current Date -->
        <div class="hidden md:block text-sm text-gray-600">
          <i class="far fa-calendar-alt mr-1"></i> <?php echo date('d/m/Y'); ?>
        </div>

        <div class="h-6 border-r border-gray-300 hidden md:block"></div>

        <!-- Nav Item - User Information -->
        <div class="relative">
          <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
            <span class="hidden md:block text-sm text-gray-700">
              <?php echo $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']; ?>
            </span>
            <img class="h-9 w-9 rounded-full border-2 border-indigo-200"
              <?php
                if (isset($_SESSION['GENDER']) && $_SESSION['GENDER'] == 'MASCULIN') {
                  echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS0rikanm-OEchWDtCAWQ_s1hQq1nOlQUeJr242AdtgqcdEgm0Dg"';
                } else {
                  echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNngF0RFPjyGl4ybo78-XYxxeap88Nvsyj1_txm6L4eheH8ZBu"';
                }
              ?> alt="Profile">
          </button>

          <!-- Dropdown - User Information -->
          <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100 transform transition-all duration-150">
            <button onclick="on()" class="block w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition-colors duration-150 flex items-center">
              <i class="fas fa-user fa-sm fa-fw mr-3 text-indigo-500"></i>
              <span>Profil</span>
            </button>
            <div class="border-t border-gray-100 my-1"></div>
            <a class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition-colors duration-150 flex items-center" href="#" data-target="#logoutModal" onclick="openLogoutModal()">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3 text-red-500"></i>
              <span>Se Déconnecter</span>
            </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="p-4">

    <!-- Alpine.js for dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <script>
      // Toggle user dropdown menu
      document.addEventListener('DOMContentLoaded', function() {
        const userButton = document.getElementById('userDropdownBtn');
        const userMenu = document.getElementById('userMenu');
        
        userButton.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          userMenu.classList.toggle('hidden');
        });
        
        // Ensure profile button works
        const profileBtn = userMenu.querySelector('button');
        profileBtn.addEventListener('click', function(e) {
          // The on() function will be called directly via onclick
          userMenu.classList.add('hidden'); // Hide menu after click
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
          if (!userButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
          }
        });
      });
      
      // Fonction pour ouvrir le modal de déconnexion
      function openLogoutModal() {
        const logoutModal = document.getElementById('logoutModal');
        if (logoutModal) {
          logoutModal.classList.remove('hidden');
          logoutModal.classList.add('flex');
        }
      }
      
      // Fonction pour afficher le profil
      function on() {
        const overlay = document.getElementById("overlay");
        if (overlay) {
          overlay.style.display = "flex";
          document.getElementById("text").style.display = "none"; // Masquer le texte "Processing..."
        }
      }
    </script>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- Initialize dropdown manually if needed -->
    <script>
    $(document).ready(function() {
      $('#userDropdown').dropdown();
    });
    </script>

  </body>
</html>
