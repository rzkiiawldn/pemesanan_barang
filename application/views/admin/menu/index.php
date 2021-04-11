<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= form_error('urutan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('pesan'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMenuModal"><i class="fas fa-plus"></i> Tambah Menu</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="70%">Menu</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataMenu as $menu) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $menu['menu']; ?></td>
                        <td>
                            <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editMenuModal<?= $menu['id_menu'] ?>">edit</a>
                            <a href="<?= base_url('admin/menu/delete/' . $menu['id_menu']) ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal tambah menu baru -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMenuModalLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/index') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Menu</label>
                        <input type="text" class="form-control" placeholder="" required value="<?= set_value('menu') ?>" name="menu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit menu -->
<?php foreach ($dataMenu as $menu) { ?>
    <div class="modal fade" id="editMenuModal<?= $menu['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/menu/edit/' . $menu['id_menu']) ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                        <div class="form-group">
                            <label for="">Menu</label>
                            <input type="text" class="form-control" placeholder="" required value="<?= $menu['menu'] ?>" name="menu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>