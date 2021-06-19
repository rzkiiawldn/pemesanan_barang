<?php $profil = $this->db->get('tb_profil')->row_array() ?>
<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fab fa-affiliatetheme"></i>
      </div>
      <div class="sidebar-brand-text mx-3"><?= $profil['nama_website']; ?></div>
    </a>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Admin
    </div>
    <li class="nav-item">
      <a class="nav-link pb-0" href="<?= base_url('admin/dashboard') ?>">
        <i class="fas fa-user"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link pb-0" href="<?= base_url('admin/user') ?>">
        <i class="fas fa-user"></i>
        <span>Data User</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('admin/about') ?>">
        <i class="fas fa-user"></i>
        <span>About Us</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      Barang
    </div>
    <li class="nav-item">
      <a class="nav-link pb-0" href="<?= base_url('admin/barang') ?>">
        <i class="fas fa-user"></i>
        <span>Data Barang</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link pb-0" href="<?= base_url('admin/barang/data_pemesanan') ?>">
        <i class="fas fa-user"></i>
        <span>Data Pemesanan</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('admin/barang/transaksi_selesai') ?>">
        <i class="fas fa-user"></i>
        <span>Transaksi Selesai</span></a>
    </li>

    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-shopping-cart fa-fw"></i>
              <!-- Counter - Alerts -->
              <span class="badge badge-danger badge-counter">
                <?php $total = $this->barang_model->notif_pemesanan(); ?>
                <?= $total->num_rows(); ?>+
              </span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Total Pemesanan
              </h6>
              <?php foreach ($total->result_array() as $ttl) { ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/barang/detail_pemesanan/' . $ttl['id_pemesanan']) ?>">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?= $ttl['tanggal_pemesanan']; ?></div>
                    <?= $ttl['nama']; ?>, memesan <?= $ttl['nama_barang']; ?>
                  </div>
                </a>
              <?php } ?>
              <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('admin/barang/data_pemesanan') ?>">Lihat semua pesanan</a>
            </div>
          </li>
          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
              <img class="img-profile rounded-circle" src="<?= base_url('assets/user/img/profil/' . $user['foto']) ?>" alt="foto">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?= base_url('admin/profil/edit_profil') ?>">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profil
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Keluar
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">