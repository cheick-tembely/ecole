<?php
  require('session.php');
  confirm_logged_in();
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
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
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">


  <title> ECOLE-GEST </title>
  <!-- <link rel="icon" href="https://www.freeiconspng.com/uploads/sales-icon-7.png"> -->
 <!-- Favicon-->
 <link rel="icon" type="image/x-icon" href="../pages/ecole-gest.jpg" />
 <link rel="stylesheet" href="../vendor/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendor/flag-icon-css/css/flag-icon.min.css">
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
          
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_provi.php">
      <div class="sidebar-brand-icon ">
    <!-- Insérer le logo de l'école -->
    <img src="ecole-gest.jpg" style="width: 50px; height: 50px;">
</div>
    <div class="sidebar-brand-text mx-3">ECOLE-GEST</div>
</a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index_provi.php">
        <i class="fas fa-home"></i>
        <span>Accueil</span>
    </a>
</li>
<li class="nav-item">
        <a class="nav-link" href="pointage_compte_provi.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Pointage par professeur</span></a>
      </li>

<!-- Fiches de pointage -->


<!-- Reporting -->


<!-- Graphique -->


      
      <!-- Tables Buttons -->
      
    
      <li class="nav-item">
      <a class="nav-link" href="note_provi.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Notes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="prof_provi.php">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Professeur</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="message_provi.php">
        <i class="fas fa-bell"></i>
        <span>Notification</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="classe_provi.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Classe</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="matiere_provi.php">
        <i class="fas fa-book-open"></i>
        <span>Matière</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="attri_provi.php">
        <i class="fas fa-cogs"></i>
        <span>Attribution Des Cours</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="programme_provi.php">
        <i class="fas fa-list-alt"></i>
        <span>Programmes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="fiche_sequence_provi.php">
        <i class="fas fa-file-alt"></i>
        <span>Fiche de sequence</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="emploi_du_temp_provi.php">
        <i class="fas fa-calendar-alt"></i>
        <span>Emploi du Temps</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="parent_eleve_provi.php">
        <i class="fas fa-users"></i>
        <span>Listes Des Parents d'Elèves</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="user.php">
        <i class="fas fa-users"></i>
        <span>Utilisateurs</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="email_provi.php">
        <i class="fas fa-envelope"></i>
        <span>Envoyer Email</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="transfert_provi.php">
        <i class="fas fa-exchange-alt"></i>
        <span>Liste des Transferts</span>
      </a>
    </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar_provi.php'; ?>
