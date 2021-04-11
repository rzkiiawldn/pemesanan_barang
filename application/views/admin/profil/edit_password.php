<div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">
    <?= $this->session->flashdata('pesan'); ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="password_lama" style="font-size: 14px">Password Lama</label>
            <div class="col-sm-9">
                <input type="password" name="password_lama" class="form-control" id="password_lama" />
                <?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="validate"></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="password_baru" style="font-size: 14px">Password Baru</label>
            <div class="col-sm-9">
                <input type="password" name="password_baru" class="form-control" id="password_baru" />
                <?= form_error('password_baru', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="validate"></div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="konfirmasi_password" style="font-size: 14px">Ulangi Password</label>
            <div class="col-sm-9">
                <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" />
                <?= form_error('konfirmasi_password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="validate"></div>
        </div>
        <button type="submit" class="btn btn-primary float-right">Edit Password</button>
    </form>
</div>