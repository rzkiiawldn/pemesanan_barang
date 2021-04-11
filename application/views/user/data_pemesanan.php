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


    <section class="inner-page">
        <div class="container">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal Order</th>
                            <th>Nama Barang</th>
                            <th>Ukuran</th>
                            <th>Total</th>
                            <th>Status Pesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <?php if ($pemesanan->num_rows() < 1) { ?>
                        <tbody>
                            <td colspan="8" class="text-center text-black-50">Riwayat pemesanan kosong, silahkan lakukan transaksi</td>
                        </tbody>
                </table>
                <p style="height: 150px;"></p>
            <?php } else { ?>
                <tbody>
                    <?php $no = 1;
                        foreach ($pemesanan->result_array() as $pesan) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pesan['tanggal_pemesanan']; ?></td>
                            <td><?= $pesan['nama_barang']; ?></td>
                            <td><?= 'P ' . $pesan['panjang'] . ' x ' . 'L ' . $pesan['lebar']; ?> cm</td>
                            <td>Rp. <?= number_format($pesan['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= $pesan['status_pemesanan']; ?></td>
                            <td>
                                <?php if ($pesan['bukti_pembayaran'] == null) { ?>
                                    <a href="" class="badge badge-warning" data-toggle="modal" data-target="#uploadBukti<?= $pesan['id_pemesanan'] ?>">Upload bukti pembarayan</a>
                                <?php } else { ?>
                                    <a href="" data-toggle="modal" data-target="#lihatBukti<?= $pesan['id_pemesanan'] ?>" class="badge badge-success">Lihat bukti pembarayan</a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('user/barang/detail_pemesanan/' . $pesan['id_pemesanan']); ?>" class="badge badge-info">Detail</a>
                                <?php if ($pesan['bukti_pembayaran'] == null) { ?>
                                    <a href="<?= base_url('user/barang/batalkan/' . $pesan['id_pemesanan']) ?>" onclick="return confirm('Yakin ingin membatalkan pesanan ? ');" class="badge badge-danger">Batalkan</a>
                                <?php } else { ?>

                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            <?php } ?>
            </div>
        </div>
    </section>
    <p style="height: 180px;"></p>

</main><!-- End #main -->

<?php foreach ($pemesanan->result_array() as $pesan) { ?>
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
<?php foreach ($pemesanan->result_array() as $pesan) { ?>
    <div class="modal fade" id="lihatBukti<?= $pesan['id_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="lihatBuktiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihatBuktiLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/barang/upload_bukti/' . $pesan['id_pemesanan']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <div class="form-group">
                            <img src="<?= base_url('assets/user/img/bukti_pembayaran/' . $pesan['bukti_pembayaran']) ?>" class="img img-fluid" alt="">
                        </div>
                        <?php if ($pesan['status_pemesanan'] == 'Selesai') { ?>
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
                                <input type="hidden" name="id_pemesanan" value="<?= $pesan['id_pemesanan'] ?>">
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
    </div>
<?php } ?>