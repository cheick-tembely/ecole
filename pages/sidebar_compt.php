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
  <meta name="author" content="">

  <title> POINTAGE-GEST </title>
  <!-- <link rel="icon" href="https://www.freeiconspng.com/uploads/sales-icon-7.png"> -->
 <!-- Favicon-->
 <link rel="icon" type="image/x-icon" href="../img/calendrier (1).png" />
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_cens.php">
      <div class="sidebar-brand-icon ">
    <!-- Insérer le logo de l'école -->
    <img src="LOGO.jpeg" style="width: 50px; height: 50px;">
</div>
    <div class="sidebar-brand-text mx-3">ECOLE-GEST</div>
</a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index_compt.php">
        <i class="mdi mdi-home"></i>
        <span>Accueil</span>
    </a>
</li>

<!-- Fiches de pointage -->
<li class="nav-item">
    <a class="nav-link" href="pointage_compt.php">
        <i class="mdi mdi-file"></i>
        <span>Fiches de pointage</span>
    </a>
</li>

<!-- Reporting -->
<li class="nav-item">
    <a class="nav-link" href="reporting_compt.php">
        <i class="mdi mdi-chart-bar"></i>
        <span>Reporting</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="somme_globale.php">
        <i class="mdi mdi-chart-bar"></i>
        <span>Montant Total Payé</span>
    </a>
</li>
</li>
<li class="nav-item">
    <a class="nav-link" href="livre.php">
        <i class="mdi mdi-chart-bar"></i>
        <span>Insertion des Livres</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="livre_emprunt.php">
        <i class="mdi mdi-chart-bar"></i>
        <span>Insertion des Emprunts</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="tenu.php">
        <i class="mdi mdi-chart-bar"></i>
        <span>Gestion des Tenues Scolaires</span>
    </a>
</li>
<!-- Graphique -->


      
     
      <!-- Tables Buttons -->
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>
