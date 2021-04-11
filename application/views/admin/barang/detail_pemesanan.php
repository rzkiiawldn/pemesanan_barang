<div class="container">
    <div class="row">

        <div class="col-lg-12">
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
                                    Belum melakukan pembayaran
                                <?php } else { ?>
                                    Pembayaran sudah dilakukan | <a href="" class="badge badge-info" data-toggle="modal" data-target="#lihatBukti<?= $pemesanan['id_pemesanan'] ?>">Lihat bukti pembayaran</a>
                                <?php } ?>
                            </td>
                            <?php if ($pemesanan['bukti_pembayaran'] == null) {
                            } else { ?>
                        <tr>
                            <th width="30%"></th>
                            <td width="70%">
                                <?php if ($pemesanan['status_pemesanan'] == 'Selesai') { ?>
                                    <a class="btn btn-success btn-sm">Pesanan Selesai</a>
                                <?php } else { ?>
                                    <form action="<?= base_url('admin/barang/selesai/' . $pemesanan['id_pemesanan']) ?>" method="post">
                                        <input type="hidden" name="status_pemesanan" value="Selesai">
                                        : <button type="submit" class="btn btn-danger btn-sm">Konfirmasi pesanan</button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>

                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lihatBukti<?= $pemesanan['id_pemesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="lihatBuktiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatBuktiLabel">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class=" modal-body">
                <div class="form-group">
                    <img src="<?= base_url('assets/user/img/bukti_pembayaran/' . $pemesanan['bukti_pembayaran']) ?>" class="img img-fluid" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>