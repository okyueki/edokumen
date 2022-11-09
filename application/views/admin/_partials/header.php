<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
  <meta http-equiv="Pragma" content="no-cache">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>eDokumen || RS. Aisyiyah Siti Fatimah Tulangan</title>
	<!-- core:css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/core/core.css">
	<!-- endinject -->
	<!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/dropify/dist/dropify.min.css">
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/feather-font/css/iconfont.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon.ico" />
</head>
<body>
<div class="main-wrapper">
    	<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          e<span>Dokumen</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>dashboard" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Surat</li>
           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Surat</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="<?php echo base_url();?>suratmasuk" class="nav-link">Surat Masuk</a>
                </li>
                 <li class="nav-item">
                  <a href="<?php echo base_url();?>suratkeluar" class="nav-link">Surat Keluar</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>ecuti" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">eCuti</span>
            </a>
          </li>
          <li class="nav-item nav-category">Dokumen</li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>lihatdokumen/spo" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">SPO</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>lihatdokumen/pedoman" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Pedoman</span>
            </a>
          </li>    

          <li class="nav-item nav-category">Master</li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>datadokumen" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Data Dokumen</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>ebook" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">eBook</span>
            </a>
          </li>
          <?php
          
            if($this->session->userdata('hak_akses')=="Super Admin"){
          ?>
          <li class="nav-item nav-category">User</li>
         <li class="nav-item">
            <a href="<?php echo base_url();?>pegawai" class="nav-link">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Pegawai</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>hakakses" class="nav-link">
              <i class="link-icon" data-feather="unlock"></i>
              <span class="link-title">Hak Akses</span>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url();?>unit" class="nav-link">
              <i class="link-icon" data-feather="grid"></i>
              <span class="link-title">Unit</span>
            </a>
          </li>
          <li class="nav-item nav-category">Penyimpanan Dokumen</li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>lemari" class="nav-link">
              <i class="link-icon" data-feather="folder-plus"></i>
              <span class="link-title">Lemari</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>rak" class="nav-link">
              <i class="link-icon" data-feather="folder-plus"></i>
              <span class="link-title">Rak</span>
            </a>
          </li>
          <li class="nav-item nav-category">Lain - Lain</li>
           <li class="nav-item">
            <a href="<?php echo base_url();?>jenisdokumen" class="nav-link">
              <i class="link-icon" data-feather="layers"></i>
              <span class="link-title">Jenis Dokumen</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>jeniscuti" class="nav-link">
              <i class="link-icon" data-feather="layers"></i>
              <span class="link-title">Jenis Cuti</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>sifat" class="nav-link">
              <i class="link-icon" data-feather="grid"></i>
              <span class="link-title">Sifat</span>
            </a>
          </li>
          
          <?php
            }
          ?>
        </ul>
      </div>
    </nav>
		<!-- partial -->
	
		<div class="page-wrapper">