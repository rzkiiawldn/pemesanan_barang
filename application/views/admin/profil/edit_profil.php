<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_user" id="id_user" value="<?= $user['id_user'] ?>">
        <div class="card mb-3 col-lg-12">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $user['email']; ?>" readonly>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $user['nama']; ?>">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" name="telepon" class="form-control" value="<?= $user['telepon']; ?>">
                        <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"><?= $user['alamat']; ?></textarea>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="foto">Foto</label>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/user/img/profil/' . $user['foto']); ?>" class="img-thumbnail" for="foto">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="foto" class="custom-file-input" id="foto">
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
                    <a href="<?= base_url('admin/profil/edit_password') ?>" type="submit" class="btn btn-success mr-2 float-right">Edit Password</a>
                </div>
            </div>
        </div>
    </form>