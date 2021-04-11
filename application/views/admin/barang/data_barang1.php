<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary mb-3" href="<?= base_url('admin/barang/tambah_barang') ?>"><i class="fas fa-plus"></i> Tambah data</a>
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
                        <th>Gambar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $brg) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $brg['nama_barang']; ?></td>
                            <td>Rp. <?= number_format($brg['harga_barang'], 0, ',', '.'); ?></td>
                            <!-- <td><?= nl2br($brg['keterangan']); ?></td> -->
                            <td><img src="<?= base_url('assets/user/img/barang/' . $brg['foto_barang']); ?>" width="80px"></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/barang/tambah_variasi/' . $brg['id_brg']) ?>" class="badge badge-primary">tambah variasi</a>
                                <a href="<?= base_url('admin/barang/detail_barang/' . $brg['id_brg']) ?>" class="badge badge-info">detail</a>
                                <br>
                                <a href="<?= base_url('admin/barang/edit_barang/' . $brg['id_brg']) ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('admin/barang/hapus_barang/' . $brg['id_brg']) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data barang ?')">hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>