<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<div class="row">
    <div class="col-lg table-responsive">
        <!-- pesan error -->
        <?= form_error('submenu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= form_error('id_menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= form_error('icon', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= form_error('url', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <!-- akhir pesan error -->
        <?= $this->session->flashdata('pesan'); ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSubMenuModal"><i class="fas fa-plus"></i> Tambah SubMenu</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Submenu</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Urutan</th>
                    <th scope="col">Active</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($dataSubMenu as $submenu) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $submenu['submenu']; ?></td>
                        <td><?= $submenu['menu']; ?></td>
                        <td><?= $submenu['url']; ?></td>
                        <td><?= $submenu['icon']; ?></td>
                        <td><?= $submenu['urutan']; ?></td>
                        <td><?= $submenu['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                        <td>
                            <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editSubMenuModal<?= $submenu['id_sub'] ?>">edit</a>
                            <a href="<?= base_url('admin/menu/deleteSub/' . $submenu['id_sub']) ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal tambah menu baru -->
<div class="modal fade" id="tambahSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="tambahSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSubMenuModalLabel">Tambah SubMenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/submenu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Judul SubMenu</label>
                        <input type="text" class="form-control" placeholder="" value="<?= set_value('submenu') ?>" name="submenu">
                    </div>
                    <div class="form-group">
                        <label for="menu">Menu</label>
                        <select name="id_menu" id="menu" class="form-control" value="<?= set_value('id_menu') ?>">
                            <option value="">- pilih -</option>
                            <?php foreach ($dataMenu as $menu) { ?>
                                <option value="<?= $menu['id_menu'] ?>"><?= $menu['menu'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" placeholder="" value="<?= set_value('url') ?>" name="url">
                    </div>
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" class="form-control" placeholder="" value="<?= set_value('icon') ?>" name="icon">
                    </div>
                    <div class="form-group">
                        <label for="">Urutan</label>
                        <input type="number" min="1" class="form-control" placeholder="" value="<?= set_value('urutan') ?>" name="urutan">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active" checked>
                            <label for="" class="form-check-label">Aktif ?</label>
                        </div>
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
<?php foreach ($dataSubMenu as $submenu) { ?>
    <div class="modal fade" id="editSubMenuModal<?= $submenu['id_sub'] ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubMenuModalLabel">Edit SubMenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/menu/editSub/' . $submenu['id_sub']) ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_sub" value="<?= $submenu['id_sub'] ?>">
                        <div class="form-group">
                            <label for="">Judul SubMenu</label>
                            <input type="text" class="form-control" placeholder="" value="<?= $submenu['submenu'] ?>" name="submenu">
                        </div>
                        <div class="form-group">
                            <label for="menu">Menu</label>
                            <select name="id_menu" id="menu" class="form-control" value="<?= $submenu['id_menu'] ?>">
                                <option value="">- pilih -</option>
                                <?php foreach ($dataMenu as $menu) { ?>
                                    <?php if ($menu['id_menu'] == $submenu['id_menu']) { ?>
                                        <option value="<?= $menu['id_menu'] ?>" selected><?= $menu['menu'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $menu['id_menu'] ?>"><?= $menu['menu'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Url</label>
                            <input type="text" class="form-control" placeholder="" value="<?= $submenu['url'] ?>" name="url">
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="text" class="form-control" placeholder="" value="<?= $submenu['icon'] ?>" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="">Urutan</label>
                            <input type="number" min="1" class="form-control" placeholder="" value="<?= $submenu['urutan'] ?>" name="urutan">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <?php if ($submenu['is_active'] == 1) { ?>
                                    <input type="checkbox" value="<?= $submenu['is_active'] ?>" class="form-check-input" name="is_active" id="is_active" checked>
                                <?php } else { ?>
                                    <input type="checkbox" value="1" class="form-check-input" name="is_active" id="is_active">
                                <?php } ?>
                                <label for="" class="form-check-label">Aktif ?</label>
                            </div>
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