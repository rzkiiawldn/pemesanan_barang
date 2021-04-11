<main id="main" data-aos="zoom-out">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $judul; ?></h2>
                <ol>
                    <li><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
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
            <?php if ($barang->num_rows() < 1) { ?>
                <p style="height: 250px;" class="text-center text-black-50">barang kosong</p>
            <?php } else { ?>
                <div class="row">
                    <?php foreach ($barang->result_array() as $brg) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card mb-3" style="width: 17rem;">
                                <a href="<?= base_url('user/barang/detail_barang/' . $brg['id_brg']) ?>"><img src="<?= base_url('assets/user/img/barang/' . $brg['foto_barang']) ?>" class="card-img-top" alt="foto barang.." height="200px"></a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $brg['nama_barang']; ?></h5>
                                    <p class="card-text" style="font-size: 16px;color:chocolate"><b>Rp. <?= number_format($brg['harga_barang'], 0, ',', '.'); ?> /cm</b></p>
                                    <p class="card-text" style="font-size: 14px;"><?= $brg['keterangan']; ?>.</p>
                                    <a href="<?= base_url('user/barang/pesan/' . $brg['id_brg']) ?>" class="btn btn-sm text-white float-right mr-2" style="background-color: #2a2c39;">Pesan</a>
                                    <a href="<?= base_url('user/barang/detail_barang/' . $brg['id_brg']) ?>" class="btn btn-sm text-dark float-right mr-2" style="background-color: #aaa;">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <p style="height: 100px;"></p>

</main><!-- End #main -->