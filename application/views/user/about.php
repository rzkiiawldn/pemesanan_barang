<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center" data-aos="zoom-out">
                <h2><?= $judul; ?></h2>
                <ol>
                    <li><a href="<?= base_url('user/dashboard') ?>">Home</a></li>
                    <li><?= $judul; ?></li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page" data-aos="zoom-out">
        <div class="container">
            <?php foreach ($about as $data) { ?>
                <p>
                    <?= nl2br($data['tentang_perusahaan']); ?>
                </p>
            <?php } ?>
        </div>
    </section>
    <p style="height: 200px;"></p>

</main><!-- End #main -->