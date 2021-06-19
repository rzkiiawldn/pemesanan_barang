<main id="main" data-aos="zoom-out">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $judul; ?></h2>
                <ol>
                    <li><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                    <li><a href="<?= base_url('user/barang/data_barang') ?>">Data Barang</a></li>
                    <li><a href="<?= base_url('user/barang/detail_barang/' . $barang['id_brg']) ?>">Detail Barang</a></li>
                    <li><?= $judul; ?></li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->

    <section id="team" class="team">
        <div class="container">
            <div class="section-title" data-aos="zoom-out">
                <h2><?= $judul; ?></h2>
            </div>
            <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

                <form action="<?= base_url('user/barang/proses') ?>" method="post" id="myForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                        <input type="hidden" name="id_brg" value="<?= $barang['id_brg'] ?>">
                        <div class="col-4">
                            <p>Nama</p>
                        </div>
                        <div class="col-8">
                            <p>: <?= $user['nama']; ?></p>
                        </div>
                        <div class="col-4">
                            <p>Nomor Telepon</p>
                        </div>
                        <div class="col-8">
                            <p>: <?= $user['telepon']; ?></p>
                        </div>
                        <div class="col-4">
                            <p>Alamat</p>
                        </div>
                        <div class="col-8">
                            <p>: <?= $user['alamat']; ?></p>
                        </div>
                        <div class="col-12">
                            <a class="float-right mb-3" href="<?= base_url('user/profil/edit_profil') ?>"><i>ubah data</i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Upload Desain</label>
                        <input type="file" name="desain_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Pemasangan</label>
                        <textarea class="form-control" rows="5" placeholder="Alamat Pemasangan" name="alamat_pemasangan"><?= set_value('alamat_pemasangan'); ?></textarea>
                        <?= form_error('alamat_pemasangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <?php if ($variasi->num_rows() < 1) { ?>
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="Nama Barang" value="<?= $barang['nama_barang'] ?>" readonly />
                            <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <input type="number" name="panjang" class="form-control" id="panjang" onchange="Panjang()" min="100" placeholder="P" aria-label="P" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <input type="number" name="lebar" class="form-control" id="lebar" onchange="Panjang()" min="50" placeholder="L" aria-label="L" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><b>Rp.</b></span>
                                    </div>
                                    <input type="hidden" name="harga_barang" value="<?= $barang['harga_barang'] ?>">
                                    <input type="text" class="form-control" placeholder="Harga /cm" readonly value="<?= number_format($barang['harga_barang'], 0, ',', '.',); ?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><b>Harga /cm</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input type="text" name="total_harga" class="form-control" placeholder="Total Harga" readonly id="total">
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <div>
                                        <label for=""><b>Pilih Barang</b></label>
                                        <div class="radio-inline">
                                            <?php foreach ($variasi->result_array() as $data) { ?>
                                                <input type="radio" id="nama_barang" name="brg" value="<?= $data['id_variasi'] ?>" class="ml-3"> <?= $data['nama_variasi'] ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <input type="number" name="panjang" class="form-control" id="panjang_variasi" onchange="Panjang_variasi()" min="100" placeholder="P" aria-label="P" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <input type="number" name="lebar" class="form-control" id="lebar_variasi" onchange="Panjang_variasi()" min="50" placeholder="L" aria-label="L" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><b>Rp.</b></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Harga /cm" readonly id="harga_barang" name="harga_barang">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><b>Harga /cm</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <input type="hidden" class="form-control" readonly id="nama_variasi" name="nama_barang">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input type="text" name="total_harga" class="form-control" placeholder="Total Harga" readonly id="total_harga">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn text-white float-right" style="background-color: #2a2c39;">Kirim</button>
                </form>

            </div>
        </div>
    </section>
    <p style="height: 100px;"></p>

</main><!-- End #main -->

<script>
    $(document).ready(function() {
        $('#myForm input').on('change', function() {
            var id = $("[type='radio']:checked").val();
            // $('#harga_barang').val($("[type='radio']:checked").val());
            $.ajax({
                url: "<?php echo base_url(); ?>user/barang/get_id_variasi",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {

                    //alert(data);
                    // var html = '';
                    // var i;
                    // html += '<option>-- Pilih --</option>';
                    for (i = 0; i < data.length; i++) {
                        $('#harga_barang').val(data[i].harga_variasi);
                        $('#nama_variasi').val(data[i].nama_variasi);
                        Panjang_variasi();
                    }
                    // $('#cmbSubGroup').html(html);
                }
            });
        });
    });


    function Panjang() {
        var p = document.getElementById("panjang").value;
        var l = document.getElementById("lebar").value;
        document.getElementById("total").value = ("<?= $barang['harga_barang']; ?>" * p * l) / 100;
    }

    // function Panjang_variasi() {
    //     var h = document.getElementById("harga_barang").value;
    //     var p = document.getElementById("panjang_variasi").value;
    //     var l = document.getElementById("lebar_variasi").value;
    //     document.getElementById("total_harga").value = (h * p * l) / 100;
    // }

    function Panjang_variasi() {
        var harga = $("#harga_barang").val();
        var p = $("#panjang_variasi").val();
        var l = $("#lebar_variasi").val();
        total = (p * l * harga) / 100;
        $("#total_harga").val(total);
    }
</script>