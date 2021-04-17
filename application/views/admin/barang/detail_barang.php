<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card">
                <div class="card-header">
                    <?= $judul; ?>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td width="40%">
                                <img src="<?= base_url('assets/user/img/barang/' . $barang['foto_barang']) ?>" alt="" class="img-fluid" width="100%">
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td class="font-weight-bold">Nama Barang</td>
                                        <td>: <?= $barang['nama_barang']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Harga Barang</td>
                                        <td>: Rp. <?= number_format($barang['harga_barang'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Keterangan</td>
                                        <td>: <?= nl2br($barang['keterangan']); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"><a href="<?= base_url('admin/barang/tambah_variasi/' . $barang['id_brg']) ?>" class="btn btn-primary btn-sm mt-3 mb-3 float-right">Tambah Variasi</a></div>
    </div>
    <?php if ($variasi->num_rows() < 1) {
    } else { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Variasi Barang
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <?php foreach ($variasi->result_array() as $data) { ?>
                                <tr>
                                    <td width="40%">
                                        <img src="<?= base_url('assets/user/img/barang/' . $data['foto_variasi']) ?>" alt="" class="img-fluid" width="100%">
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold">Nama Barang</td>
                                                <td>: <?= $data['nama_variasi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Harga Barang</td>
                                                <td>: Rp. <?= number_format($data['harga_variasi'], 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <form action="<?= base_url('admin/barang/hapus_variasi/' . $data['id_variasi']) ?>" method="post">
                                                        <a href="" data-toggle="modal" data-target="#editVariasi<?= $data['id_variasi'] ?>" class="btn btn-success btn-sm">Edit data</a>
                                                        <input type="hidden" name="id_brg" value="<?= $data['id_brg'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus data</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php foreach ($variasi->result_array() as $data) { ?>
    <div class="modal fade" id="editVariasi<?= $data['id_variasi'] ?>" tabindex="-1" role="dialog" aria-labelledby="editVariasiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVariasiLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/barang/edit_variasi/' . $data['id_variasi']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <input type="hidden" name="id_variasi" value="<?= $data['id_variasi'] ?>">
                        <input type="hidden" name="id_brg" value="<?= $data['id_brg'] ?>">
                        <div class="form-group">
                            <label for="nama_variasi">Nama Barang</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $data['nama_variasi'] ?>" name="nama_variasi" id="nama_variasi">
                        </div>
                        <div class="form-group">
                            <label for="harga_variasi">Harga Barang</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $data['harga_variasi'] ?>" name="harga_variasi" id="harga_variasi">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="foto_variasi">Foto Barang</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/user/img/barang/' . $data['foto_variasi']); ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="foto_variasi" class="custom-file-input">
                                            <label class="custom-file-label" for="custom-file">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php } ?>