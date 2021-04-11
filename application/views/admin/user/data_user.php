<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahUser"><i class="fas fa-plus"></i> Tambah data</a>
        <a href="<?= base_url('admin/user/cetak_data') ?>" target="_blank" class="btn btn-primary mb-3 mr-2"><i class="fas fa-print"></i> Cetak data</a>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data_user as $user) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['telepon']; ?></td>
                            <td><?= $user['alamat']; ?></td>
                            <td><img src="<?= base_url('assets/user/img/profil/' . $user['foto']); ?>" width="80px"></td>
                            <td>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#editUser<?= $user['id_user'] ?>">edit data</a>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editPass<?= $user['id_user'] ?>">edit pass</a>
                                <a href="<?= base_url('admin/user/hapus_user/' . $user['id_user']) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus user ?')">hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah user baru -->
<div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="tambahUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/user/proses') ?>" method="post" enctype="multipart/form-data">
                <div class=" modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" placeholder="" required value="<?= set_value('nama') ?>" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="" required value="<?= set_value('email') ?>" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="number" class="form-control" placeholder="" required value="<?= set_value('telepon') ?>" name="telepon" id="telepon">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" placeholder="" required value="<?= set_value('alamat') ?>" name="alamat" id="alamat">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="" required value="<?= set_value('password') ?>" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
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

<?php foreach ($data_user as $user) { ?>
    <div class="modal fade" id="editUser<?= $user['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/user/proses/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="" required value="<?= $user['email'] ?>" name="email" id="email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $user['nama'] ?>" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="number" class="form-control" placeholder="" required value="<?= $user['telepon'] ?>" name="telepon" id="telepon">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $user['alamat'] ?>" name="alamat" id="alamat">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="foto">Foto Profil</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/user/img/profil/' . $user['foto']); ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="foto" class="custom-file-input">
                                            <label class="custom-file-label" for="custom-file">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<?php foreach ($data_user as $user) { ?>
    <div class="modal fade" id="editPass<?= $user['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editPassLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPassLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/user/edit_password/' . $user['id_user']) ?>" method="post">
                    <div class=" modal-body">
                        <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="" required value="<?= $user['password'] ?>" name="password" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>