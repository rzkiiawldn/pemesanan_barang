<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pemesanan</title>
</head>

<body>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal Order</th>
            <th>Nama Pelanggan</th>
            <th>Nama Barang</th>
            <th>Ukuran</th>
            <th>Total</th>
        </tr>
        <?php $no = 1;
        foreach ($pemesanan as $pesan) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pesan['tanggal_pemesanan']; ?></td>
                <td><?= $pesan['nama']; ?></td>
                <td><?= $pesan['nama_barang']; ?></td>
                <td><?= $pesan['panjang']; ?> x <?= $pesan['lebar']; ?> cm</td>
                <td>Rp. <?= number_format($pesan['total_harga'], 0, ',', '.'); ?></td>
            </tr>
        <?php } ?>
    </table>
    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>