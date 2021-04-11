<html><head>
    <title><?= $judul; ?></title>

    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 14px;
        }

        table tr .text {
            text-align: center;
            font-size: 14px;
        }

        table tr td {
            font-size: 14px;
        }

        .besar {
            text-transform: uppercase;
        }
    </style>

</head><body>

    <center>
        <table width="800">
            <tr>
                <td width="100%">
                    <center>
                        <font size="7" class="besar"><b>Nama Company</b></font><br>
                        <font size="3"><i>Data Pemesanan</i></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <table width="780">
                <tr>
                    <td class="text2">Jakarta, <?= date('l d F Y'); ?></td>
                </tr>
            </table>
        </table>

        <table width="750" style="text-align: left;margin-top: 5px;">
            <tr style="margin-bottom: 5">
                <td width="50px"><b>No</b></td>
                <td width="120px"><b>Tanggal Pemesanan</b></td>
                <td width="120px"><b>Nama Pemesan</b></td>
                <td width="120px"><b>Nama Barang</b></td>
                <td width="120px"><b>Harga Barang /cm</b></td>
                <td width="120px"><b>Ukuran</b></td>
                <td width="120px"><b>Total Harga</b></td>

            </tr>
            <?php $no = 1;
            foreach ($pemesanan as $pesan) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pesan['tanggal_pemesanan']; ?></td>
                    <td><?= $pesan['nama']; ?></td>
                    <td><?= $pesan['nama_barang']; ?></td>
                    <td><?= $pesan['harga_barang']; ?></td>
                    <td><?= $pesan['panjang']; ?> x <?= $pesan['lebar']; ?> cm</td>
                    <td><?= $pesan['total_harga']; ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </center>
</body></html>