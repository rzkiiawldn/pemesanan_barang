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

        .besar{
                text-transform: uppercase;
            }

    </style>

</head><body>

    <center>
        <table width="500">
            <tr>
                <td width="60"><img src="<?= $profil['logo_website']; ?>" width="70" height="70"></td>
                <td width="400">
                <center>
                    <font size="7" class="besar"><b>Nama Company</b></font><br>
                    <font size="3"><i>Data User</i></font>
                </center>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        <table width="500">
            <tr>
                <td class="text2">Jakarta, <?= date('l d F Y'); ?></td>
            </tr>
        </table>
        </table>

        <table width="550" style="text-align: left;margin-top: 5px;">
            <tr style="margin-bottom: 5">
                <td width="50px"><b>No</b></td>
                <td width="200px"><b>Nama</b></td>
                <td width="150px"><b>Email</b></td>
                <td width="100px"><b>No.Telp</b></td>
                <td width="200px"><b>Alamat</b></td>
            </tr>
            <?php $no=1; foreach ($user as $u): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $u['nama']; ?></td>
                <td><?= $u['email']; ?></td>
                <td><?= $u['telepon']; ?></td>
                <td><?= $u['alamat']; ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </center>
</body></html>