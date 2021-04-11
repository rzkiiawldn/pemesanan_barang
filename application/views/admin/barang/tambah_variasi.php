<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <?= form_open_multipart() ?>
    <input type="hidden" name="id_brg" value="<?= $barang['id_brg'] ?>">
    <div class="card mb-3 col-lg-12">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_variasi" class="form-control" value="<?= set_value('nama_variasi'); ?>">
                    <?= form_error('nama_variasi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harga Barang</label>
                    <div class="input-group">
                        <input type="number" name="harga_variasi" class="form-control" value="<?= set_value('harga_variasi'); ?>">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">harga / cm</span>
                        </div>
                    </div>
                    <?= form_error('harga_variasi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Foto Barang</label>
                    <input type="file" name="foto_variasi" class="form-control">
                    <?= form_error('foto_variasi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary float-right">Tambah</button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>