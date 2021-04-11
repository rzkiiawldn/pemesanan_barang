<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <form action="<?= base_url('admin/barang/edit_barang/' . $barang['id_brg']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_brg" id="id_brg" value="<?= $barang['id_brg'] ?>">
        <div class="card mb-3 col-lg-12">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang']; ?>">
                        <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <div class="input-group">
                            <input type="number" name="harga_barang" class="form-control" value="<?= $barang['harga_barang']; ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">harga / cm</span>
                            </div>
                        </div>
                        <?= form_error('harga_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="6" class="form-control"><?= $barang['keterangan']; ?></textarea>
                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="foto_barang">Foto Barang</label>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/user/img/barang/' . $barang['foto_barang']); ?>" class="img-thumbnail" for="foto_barang">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="foto_barang" class="custom-file-input" id="foto_barang">
                                        <label class="custom-file-label" for="custom-file">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary float-right">Edit</button>
                </div>
            </div>
        </div>
    </form>