<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<?= $this->session->flashdata('pesan'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="60%">About</th>
                        <th width="15%">Nama Web</th>
                        <th width="15%">Logo</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($about as $data) { ?>
                        <tr>
                            <td><?= nl2br($data['tentang_perusahaan']); ?></td>
                            <td><?= $data['nama_website']; ?></td>
                            <td><img src="<?= base_url('assets/user/img/' . $data['logo_website']) ?>" alt="" class="img-thumbnail"></td>
                            <td>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#editUser<?= $data['id'] ?>">edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($about as $data) { ?>
    <div class="modal fade" id="editUser<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/about/proses/' . $data['id']) ?>" method="post" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <div class="form-group">
                            <label for="tentang_perusahaan">About Us</label>
                            <textarea name="tentang_perusahaan" id="tentang_perusahaan" cols="30" rows="10" class="form-control"><?= $data['tentang_perusahaan']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Nama Website">Nama Website</label>
                            <input type="text" class="form-control" name="nama_website" id="Nama Website" value="<?= $data['nama_website'] ?>">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="logo_website">Logo Website</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/user/img/' . $data['logo_website']); ?>" class="img-thumbnail" for="logo_website">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" name="logo_website" class="custom-file-input" id="logo_website">
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