<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Selamat Datang</h2>
                <p class="animate__animated fanimate__adeInUp">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates dicta placeat repellat..</p>
            </div>
        </div>
        <!-- 
        <div class="carousel-item">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
        </div>

        <div class="carousel-item">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a> -->

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>About</h2>
                <p>About Us</p>
            </div>

            <div class="row content" data-aos="fade-up">
                <div class="col-md-8">
                    <?php foreach ($about as $data) { ?>
                        <p><?= nl2br($data['tentang_perusahaan']); ?></p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <section id="team" class="team">
        <div class="container">
            <div class="section-title" data-aos="zoom-out">
                <h2>Barang</h2>
            </div>
            <?php if ($barang->num_rows() < 1) { ?>
                <p style="height: 250px;" class="text-center text-black-50">barang kosong</p>
            <?php } else { ?>
                <div class="row" data-aos="zoom-out">
                    <?php foreach ($barang->result_array() as $brg) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card mb-3" style="width: 17rem;">
                                <a href="<?= base_url('user/barang/detail_barang/' . $brg['id_brg']) ?>"><img src="<?= base_url('assets/user/img/barang/' . $brg['foto_barang']) ?>" class="card-img-top" alt="foto barang.." height="200px"></a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $brg['nama_barang']; ?></h5>
                                    <p class="card-text" style="font-size: 16px;color:chocolate"><b>Rp. <?= number_format($brg['harga_barang'], 0, ',', '.'); ?></b></p>
                                    <p class="card-text" style="font-size: 14px;"><?= $brg['keterangan']; ?>.</p>
                                    <a href="<?= base_url('user/barang/detail_barang/' . $brg['id_brg']) ?>" class="btn btn-sm text-white float-right" style="background-color: #2a2c39;">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row justify-content-center" data-aos="zoom-out">
                    <a href="<?= base_url('user/barang/data_barang') ?>">Selengkapnya ...</a>
                </div>
            <?php } ?>
        </div>
    </section>
</main>
<p style="height: 100px;"></p>