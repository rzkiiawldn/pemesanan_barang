<?php $profil = $this->db->get('tb_profil')->row_array() ?>
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span><?= $profil['nama_website']; ?></span></strong>. All Rights Reserved
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/user/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/user/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url() ?>assets/user/js/main.js"></script>

</body>

</html>