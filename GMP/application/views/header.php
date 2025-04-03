<!DOCTYPE html>
<html lang="en">
<style>
  .navbar-nav {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
    }

    .navbar-nav > li {
      margin-right: 15px;
    }

    .navbar-nav.ml-auto {
      justify-content: flex-end;
    }

    .navbar-nav .nav-link {
      font-size: 15px; 
    }

    .paint {
      font-size: 17px; 
    }

     .dropdown-item {
      font-size: 15px; 
    }

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GMP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition light-mode sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo base_url()?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light fixed-top">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="paint">GMP</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="paint">GajaLaxmi Metal Productions</a>
    </li>
         <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reports</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="<?php echo base_url('material-report')?>" class="dropdown-item">Raw Materials Stock</a></li>
              <li><a href="<?php echo base_url('purchase-report')?>" class="dropdown-item">Purchase Order</a></li>
              <li><a href="<?php echo base_url('mfd-report')?>" class="dropdown-item">Manufacturing Stock</a></li>
              <li><a href="<?php echo base_url('ready-mfd-report')?>" class="dropdown-item">Ready Manufacturing </a></li>
              <!-- <li><a href="<?php echo base_url('settings-master')?>" class="dropdown-item">Settings</a></li> -->
              <li><a href="<?php echo base_url('sales-report')?>" class="dropdown-item">Sales</a></li>
              <!-- End Level two -->
            </ul>
          </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="<?php echo base_url('logout')?>" class="btn btn-danger" role="button">Logout</a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard')?>" class="brand-link">
      <img src="<?php echo base_url()?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GMP</span>
    </a>

     <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!--  <li class="nav-item">
            <a href="<?php echo base_url('admin-vendor-page')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Vendor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin-user-page')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-tree"></i>
              <p>
                Masters
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('units-master')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Units</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo base_url('raw-master')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Raw Material</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pieces-master')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Piece Per Packets</p>
                </a>
              </li>
            </ul>
          </li>
             <li class="nav-item">
            <a href="<?php echo base_url('settings')?>" class="nav-link">
              <i class="fa fa-cog"></i>
              <p>
               Settings
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              <p>
               Registrations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('customer-reg')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Customers</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo base_url('supplier-reg')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Suppliers</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="<?php echo base_url('labour-reg')?>" class="nav-link">
                  <i class="fa fa-sort"></i>
                  <p>Labours</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url('purchase-order')?>" class="nav-link">
              <i class="fas fa-shopping-basket"></i>
              <p>
                Purchase Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('purchase-cash-entry')?>" class="nav-link">
              <i class="fa fa-check-square"></i>
              <p>
                Purchase Entry
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url('manufacturing-stock')?>" class="nav-link">
              <i class="fa fa-cubes"></i>
              <p>
                Manufacturing Stock
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url('daily-mfd-stock')?>" class="nav-link">
              <i class="fa fa-cubes"></i>
              <p>
                Daily Manufacturing Stock
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('sales')?>" class="nav-link">
              <i class="fas fa-poll"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url('sales-cash-entry')?>" class="nav-link">
              <i class="fas fa-poll"></i>
              <p>
                Sales Cash Entry
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar --> -->
  </aside>