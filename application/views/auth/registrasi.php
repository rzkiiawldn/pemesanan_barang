<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                        </div>
                        <form class="user" method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" placeholder="Nama Lengkap" name="nama" value="<?= set_value('nama') ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Aktif" name="email" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" placeholder="Telepon" name="telepon" value="<?= set_value('telepon') ?>">
                                <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" id="" cols="20" rows="3" placeholder="Alamat anda.." class="form-control form-control-user "><?= set_value('email') ?></textarea>
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password1">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Konfirmasi Password" name="password2">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Buat Akun Baru
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth') ?>">Sudah Punya Akun? Silahkan Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>