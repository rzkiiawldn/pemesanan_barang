<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<?= $this->session->flashdata('pesan'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Alamat Pemasangan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pemesanan as $pesan) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pesan['tanggal_pemesanan']; ?></td>
                            <td><?= $pesan['nama']; ?></td>
                            <td><?= $pesan['nama_barang']; ?></td>
                            <td><?= 'P ' . $pesan['panjang'] . ' x ' . 'L ' . $pesan['lebar']; ?> cm</td>
                            <td><?= $pesan['alamat_pemasangan']; ?></td>
                            <td>Rp. <?= number_format($pesan['total_harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="<?= base_url('admin/barang/detail_pemesanan/' . $pesan['id_pemesanan']) ?>" class="badge badge-info">detail</a>
                                <a href="<?= base_url('admin/barang/hapus_pemesanan/' . $pesan['id_pemesanan']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus pesanan ini ?')" class="badge badge-danger">hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>