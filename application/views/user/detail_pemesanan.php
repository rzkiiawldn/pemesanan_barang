<main id="main" data-aos="zoom-out">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $judul; ?></h2>
                <ol>
                    <li><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                    <li><a href="<?= base_url('user/barang/data_pemesanan') ?>">Riwayat Pemesanan</a></li>
                    <li><?= $judul; ?></li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->


    <section class="inner-page">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col mb-2">
                            <a href="<?= base_url('user/barang/invoice/' . $pemesanan['id_pemesanan']); ?>" target="_blank" class="btn btn-primary btn-sm float-right">Cetak invoice</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <?= $judul; ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th width="30%">Nama Pemesan</th>
                                    <td width="70%">: <?= $pemesanan['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Nomor Telepon</th>
                                    <td width="70%">: <?= $pemesanan['telepon']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Alamat</th>
                                    <td width="70%">: <?= $pemesanan['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Alamat Pemasangan</th>
                                    <td width="70%">: <?= $pemesanan['alamat_pemasangan']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Tanggal Pemesanan</th>
                                    <td width="70%">: <?= $pemesanan['tanggal_pemesanan']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Nama Barang</th>
                                    <td width="70%">: <?= $pemesanan['nama_barang']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Desain</th>
                                    <td width="70%">: <img src="<?= base_url('assets/user/img/desain/' . $pemesanan['desain_barang']) ?>" alt="" class="img" width="200px"></td>
                                </tr>
                                <tr>
                                    <th width="30%">Harga Barang /cm</th>
                                    <td width="70%">: Rp. <?= number_format($pemesanan['harga_barang'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Ukuran pemesanan</th>
                                    <td width="70%">: <?= $pemesanan['panjang'] . 'x' . $pemesanan['lebar']  ?> cm</td>
                                </tr>
                                <tr>
                                    <th width="30%">Total Harga</th>
                                    <td width="70%">: Rp. <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Status Pemesanan</th>
                                    <td width="70%">: <?= $pemesanan['status_pemesanan']; ?></td>
                                </tr>
                                <tr>
                                    <th width="30%">Status Pembayaran</th>
                                    <td width="70%">:
                                        <?php if ($pemesanan['bukti_pembayaran'] == null) { ?>
                                            Belum melakukan pembayaran | <a href="" class="badge badge-warning" data-toggle="modal" data-target="#uploadBukti<?= $pemesanan['id_pemesanan'] ?>">Upload bukti pembayaran</a>
                                        <?php } else { ?>
                                            Pembayaran sudah dilakukan | <a href="" class="badge badge-success" data-toggle="modal" data-target="#lihatBukti<?= $pemesanan['id_pemesanan'] ?>">Lihat bukti pembayaran</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <p style="height: 180px;"></p>

</main><!-- End #main -->
<?php foreach ($data_pemesanan->result_array() as $pesan) { ?>
    <div class="modal fade" id="uploadBukti<?= $pesan['id_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="uploadBuktiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadBuktiLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/barang/upload_bukti/' . $pesan['id_pemesanan']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="bukti_pembayaran">Upload Bukti</label>
                            <input type="hidden" name="id_pemesanan" value="<?= $pesan['id_pemesanan'] ?>">
                            <input type="file" class="form-control" required name="bukti_pembayaran" id="bukti_pembayaran">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="upload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- LIHAT BUKTI -->
<div class="modal fade" id="lihatBukti<?= $pemesanan['id_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="lihatBuktiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatBuktiLabel">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/barang/upload_bukti/' . $pemesanan['id_pemesanan']) ?>" method="post" enctype="multipart/form-data">
                <div class=" modal-body">
                    <div class="form-group">
                        <img src="<?= base_url('assets/user/img/bukti_pembayaran/' . $pemesanan['bukti_pembayaran']) ?>" class="img img-fluid" alt="">
                    </div>
                    <?php if ($pemesanan['status_pemesanan'] == 'Selesai') { ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            <?php } else { ?>
                <p>
                    <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Edit bukti pembarayan
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <div class="form-group">
                            <label for="bukti_pembayaran">Edit Bukti Pembayaran</label>
                            <input type="hidden" name="id_pemesanan" value="<?= $pemesanan['id_pemesanan'] ?>">
                            <input type="file" class="form-control" required name="bukti_pembayaran" id="bukti_pembayaran">
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
        </div>
        </form>
    <?php } ?>
    </div>
</div>
</div>