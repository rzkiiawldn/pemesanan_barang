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
        <?php
        $id_role   = $this->session->userdata('id_role');
        // query tabel menu dan joinkan ke tabel user access menu
        $queryMenu       = "SELECT `tb_user_menu`.`id_menu`, `menu` FROM `tb_user_menu` JOIN `tb_user_access_menu` ON `tb_user_menu`.`id_menu` = `tb_user_access_menu`.`id_menu` WHERE `tb_user_access_menu`.`id_role` = $id_role";
        $dataMenu        = $this->db->query($queryMenu)->result_array();
        ?>

        <hr class="sidebar-divider">
        <!-- Looping menu -->
        <?php foreach ($dataMenu as $menu) { ?>
            <div class="sidebar-heading">
                <?= $menu['menu']; ?>
            </div>
            <!-- query sub menu untuk mengurutkan sesuai dengan tabel menu -->
            <?php
            $menuId         = $menu['id_menu'];
            $querySubMenu   = "SELECT * FROM `tb_user_sub_menu` JOIN `tb_user_menu` ON `tb_user_sub_menu`.`id_menu` = `tb_user_menu`.`id_menu` WHERE `tb_user_sub_menu`.`id_menu` = $menuId AND `tb_user_sub_menu`.`is_active` = 1 ORDER BY urutan ASC";
            $dataSubMenu    = $this->db->query($querySubMenu)->result_array();
            ?>
            <?php foreach ($dataSubMenu as $submenu) { ?>
                <!-- cara 1 menggunakan uri segment dengan pengkondisian jika url sama dengan url di database
                    <li class="nav-item <?= $this->uri->segment(1) == $submenu['url'] ? "active" : null; ?>">
                    cara 2 menggunakan data title dengan pengkondisian jika title sama dengan data judul -->
                <li class="nav-item <?= $judul == $submenu['submenu'] ? "active" : null; ?>">
                    <a class="nav-link pb-0" href="<?= base_url($submenu['url']) ?>">
                        <i class="<?= $submenu['icon'] ?>"></i>
                        <span><?= $submenu['submenu']; ?></span></a>
                </li>
            <?php } ?>
            <hr class="sidebar-divider mt-3">
        <?php } ?>

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
                            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('admin/barang') ?>">Lihat semua pesanan</a>
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