<main id="main" data-aos="zoom-out">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $judul; ?></h2>
                <ol>
                    <li><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                    <li><a href="<?= base_url('user/barang/data_barang') ?>">Data Barang</a></li>
                    <li><?= $judul; ?></li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container">
            <div class="section-title" data-aos="zoom-out">
                <h2><?= $judul; ?></h2>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= base_url('assets/user/img/barang/' . $barang['foto_barang']) ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php foreach ($variasi->result_array() as $data) { ?>
                                <div class="carousel-item">
                                    <img src="<?= base_url('assets/user/img/barang/' . $data['foto_variasi']) ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php } ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 ml-2">
                    <h2><b><?= $barang['nama_barang']; ?></b></h2>
                    <div style="color: chocolate;" class="mb-3">
                        <h2 style="font-family: Geneva, Tahoma, sans-serif;"><b>Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?> /cm</b></h2>
                    </div>
                    <?php if ($variasi->num_rows() < 1) {
                    } else { ?>
                        <h6><b>Variasi</b></h6>
                    <?php } ?>
                    <ul>
                        <?php foreach ($variasi->result_array() as $data) { ?>
                            <li><?= $data['nama_variasi'] . ' ( Rp. ' . $data['harga_variasi'] . ' )' ?></li>
                        <?php } ?>
                    </ul>
                    <p style="font-size: 15px;"><?= nl2br($barang['keterangan']); ?></p>
                    <a href="<?= base_url('user/barang/pesan/' . $barang['id_brg']) ?>" class="btn text-white mt-5 float-right" style="background-color: #2a2c39;">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </section>
    <p style="height: 100px;"></p>

</main><!-- End #main -->