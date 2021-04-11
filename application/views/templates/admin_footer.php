<?php if ($this->uri->segment(1) == 'auth') { ?>

<?php } else { ?>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php $profil = $this->db->get('tb_profil')->row_array() ?>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; <?= $profil['nama_website']; ?> <?= date('Y'); ?></span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" jika ingin mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/admin/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/admin/') ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/admin/') ?>js/demo/datatables-demo.js"></script>

<!-- Script hak akses user -->
<script>
    // menangkap elemen yang class form-check-input
    $('.form-check-input').on('click', function() {
        // dan ketika di klik menjalakan fungsi berikut
        // membuat variabel
        // data(diambil dari nama datanya diinput)
        const menuId = $(this).data('menu')
        const roleId = $(this).data('role')

        // jalankan ajax
        $.ajax({
            // arahkan url ke controller admin
            url: "<?= base_url('admin/menu/ubahAkses'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            // ketika semua berhasil arahkan ke controller admin
            success: function() {
                document.location.href = "<?= base_url('admin/menu/hak_akses/') ?>" + roleId;
            }

            // 
        });
    });
</script>

</body>

</html>