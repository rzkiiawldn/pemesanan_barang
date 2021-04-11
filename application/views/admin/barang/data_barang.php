<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahBarang"><i class="fas fa-plus"></i> Tambah data</a>
        <a href="" class="btn btn-primary mb-3 mr-2"><i class="fas fa-print"></i> Cetak data</a>
    </div>
</div>
<?= $this->session->flashdata('pesan'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang/cm</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $brg) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $brg['nama_barang']; ?></td>
                            <td>Rp. <?= number_format($brg['harga_barang'], 0, ',', '.'); ?></td>
                            <td><?= nl2br($brg['keterangan']); ?></td>
                            <td><?= $brg['foto_barang']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/barang/hapus_barang/' . $brg['id_brg']) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data barang ?')">hapus</a>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#editBarang<?= $brg['id_brg'] ?>">edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah user baru -->
<div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledby="tambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang/proses') ?>" method="post" enctype="multipart/form-data">
                <div class=" modal-body">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" placeholder="" required value="<?= set_value('nama_barang') ?>" name="nama_barang" id="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga Barang/cm</label>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping">Rp.</span>
                            </div>
                            <input type="number" class="form-control" placeholder="" required value="<?= set_value('harga_barang') ?>" name="harga_barang" id="harga_barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"><?= set_value('keterangan'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_barang">Foto Barang</label>
                        <input type="text" name="foto_barang" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($barang as $brg) { ?>
    <div class="modal fade" id="editBarang<?= $brg['id_brg'] ?>" tabindex="-1" role="dialog" aria-labelledby="editBarangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangLabel">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/barang/proses/' . $brg['id_brg']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $brg['nama_barang'] ?>" name="nama_barang" id="nama_barang">
                        </div>
                        <div class="form-group">
                            <label for="harga_barang">Harga Barang/cm</label>
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping">Rp.</span>
                                </div>
                                <input type="number" class="form-control" placeholder="" required value="<?= $brg['harga_barang'] ?>" name="harga_barang" id="harga_barang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"><?= $brg['keterangan']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto_barang">Foto Barang</label>
                            <input type="text" name="foto_barang" class="form-control" required value="<?= $brg['foto_barang'] ?>">
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