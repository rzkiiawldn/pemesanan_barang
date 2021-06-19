<?php $profil = $this->db->get('tb_profil')->row_array() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $judul; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Favicons -->
    <link href="<?= base_url('assets/user/img/' . $profil['logo_website']) ?>" rel="icon">
    <link href="<?= base_url() ?>assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/owl.carousel/<?= base_url() ?>assets/user/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/user/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/user/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Selecao - v2.3.1
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center  <?= $this->uri->segment(2) == 'dashboard' ? 'header-transparent' : null; ?> ">
        <div class="container d-flex align-items-center">

            <div class="logo mr-auto">
                <h1 class="text-light"><a href="<?= base_url('user/dashboard') ?>"><?= $profil['nama_website']; ?></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="<?= base_url() ?>assets/user/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>
            <?php
            $id_role   = 2;
            // query tabel menu dan joinkan ke tabel user access menu
            $queryMenu       = "SELECT `tb_user_menu`.`id_menu`, `menu` FROM `tb_user_menu` JOIN `tb_user_access_menu` ON `tb_user_menu`.`id_menu` = `tb_user_access_menu`.`id_menu` WHERE `tb_user_access_menu`.`id_role` = $id_role";
            $dataMenu        = $this->db->query($queryMenu)->result_array();
            ?>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <?php if ($this->session->userdata('email')) { ?>
                        <?php foreach ($dataMenu as $menu) { ?>
                            <?php $menu['menu']; ?>
                            <?php
                            $menuId         = $menu['id_menu'];
                            $querySubMenu   = "SELECT * FROM `tb_user_sub_menu` JOIN `tb_user_menu` ON `tb_user_sub_menu`.`id_menu` = `tb_user_menu`.`id_menu` WHERE `tb_user_sub_menu`.`id_menu` = $menuId AND `tb_user_sub_menu`.`is_active` = 1 ORDER BY urutan ASC";
                            $dataSubMenu    = $this->db->query($querySubMenu)->result_array();
                            ?>
                            <?php foreach ($dataSubMenu as $submenu) { ?>
                                <li class="<?= $judul == $submenu['submenu'] ? "active" : null; ?>"><a href="<?= base_url($submenu['url']) ?>"><?= $submenu['submenu']; ?></a></li>
                            <?php } ?>
                        <?php } ?>
                        <!-- <li class="<?= $this->uri->segment('2') == 'dashboard' ? 'active' : null; ?>"><a href="<?= base_url() ?>"><i class="bx bxs-basket"></i><span style="font-size: 12px;"> 0</span></a></li> -->
                        <li class="drop-down text-capitalize"><a href=""><?= $user['nama']; ?></a>
                            <ul>
                                <li><a href="<?= base_url('user/profil/edit_profil') ?>">Edit Profil</a></li>
                                <li><a href="<?= base_url('auth/logout') ?>" onclick="return confirm('yakin ingin keluar ?')">Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class=""><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                        <li class=""><a href="<?= base_url('user/about') ?>">About Us</a></li>
                        <li><a href="<?= base_url('auth/') ?>">Login</a></li>
                    <?php } ?>

                </ul>
            </nav><!-- .nav-menu -->

        </div>
    </header><!-- End Header -->