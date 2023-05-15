<?php $segment =  $this->uri->segment('2'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <!-- Primary Meta Tags -->
    <title><?= $title ?></title>
    <meta name="title" content="Himpunan Mahasiswa Universitas Majalengka - Bernas Karena Kualitas">
    <meta name="keywords" content="Himpunan, Mahasiswa, Universitas, Majalengka, Hima">
    <meta name="description" content="Dokumentasi Kegiatan Himpunan Mahasiswa Universitas Majalengka">
    <meta name="author" content="Andi Alfian">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('wordsmith_theme/') ?>css/base.css">
    <link rel="stylesheet" href="<?= base_url('wordsmith_theme/') ?>css/vendor.css">
    <link rel="stylesheet" href="<?= base_url('wordsmith_theme/') ?>css/main.css">
    <!-- CSS AING
    ================================================== -->
    <?php if ($segment != 'posts') : ?>
        <link rel="stylesheet" href="<?= base_url('wordsmith_theme/') ?>bootstrap_andy.css">
        <link rel="stylesheet" href="<?= base_url('wordsmith_theme/') ?>andy_style.css">


    <?php endif;
    if ($segment == 'register') : ?>
        <link rel="stylesheet" href="<?= base_url() ?>extra-libs/datatables/dataTables.bootstrap4.min.css">

    <?php endif; ?>
    <!-- script
    ================================================== -->
    <script src="<?= base_url('wordsmith_theme/') ?>js/modernizr.js"></script>
    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo_100.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/images/logo_100.png">

</head>

<body id="top">

    <!-- preloader ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- header ================================================== -->
    <?php $this->load->view("front/header") ?>

    <!-- end-header -->
    <?php $this->load->view('front/' . $file) ?>

    <!-- s-extra
    ================================================== -->
    <section class="s-extra d-print-none">

        <div class="row">

            <div class="col-six md-six tab-full popular">
                <h3>Populer</h3>

                <div class="block-1-1 block-m-full popular__posts">

                    <?php
                    $populer = $this->post->post_populer();
                    foreach ($populer as $p) {
                        $nama = json_npm($p['id_mahasiswa_pt'])['nm_pd'];
                    ?>
                        <article class="col-block popular__post">
                            <a href="<?= base_url("HM/post/" . $p['slug']) ?>" class="popular__thumb">
                                <img src="<?= img_post($p['cover']) ?>" alt="">
                            </a>
                            <a href="<?= base_url("HM/post/" . $p['slug']) ?>">
                                <h5><?= $p['judul']; ?></h5>
                            </a>
                            <section class="popular__meta">
                                <span class="popular__author"><span>Oleh</span> <a href="#0"><?= $nama ?></a></span>
                                <span class="popular__date">
                                    <span>|</span>
                                    <time datetime="<?= $p['created_at'] ?>">
                                        <?= date('d M Y', strtotime($p['created_at'])) ?>
                                    </time>
                                </span>
                            </section>
                        </article>
                    <?php } ?>
                </div>

                <!-- end popular_posts -->

            </div>
            <!-- end popular -->
            <div class="col-six md-six tab-full end">
                <div class="row">
                    <div class="col-six md-six mob-full categories">
                        <h3>Kategori</h3>

                        <ul class="linklist">

                            <?php
                            foreach ($this->post->categories() as $kt) :
                            ?>
                                <li>
                                    <a href="<?= base_url("HM/kategori/" . $kt['slug']) ?>"><?= $kt['nama_kategori'] . ' (<b>' . $kt['jml'] . '</b>)'; ?></a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div> <!-- end categories -->

                    <div class="col-six md-six mob-full sitelinks">
                        <h3>UNMA</h3>

                        <ul class="linklist">
                            <li><a href="https://unma.ac.id">Website</a></li>
                            <li><a href="https://satu.unma.ac.id">UNMAKU</a></li>
                            <li><a href="https://p3m.unma.ac.id">P3M</a></li>
                            <li><a href="https://pmb.unma.ac.id">PMB</a></li>
                        </ul>
                    </div> <!-- end sitelinks -->
                </div>
            </div>
        </div> <!-- end row -->

    </section>
    <!-- end s-extra -->

    <!-- s-footer ================================================== -->
    <?php $this->load->view('front/footer') ?>

    <!-- end s-footer -->

    <!-- Java Script
    ================================================== -->
    <?php if ($segment == 'register') : ?>

        <script src="<?= base_url('extra-libs/') ?>datatables/jquery.min.js"></script>
        <script src="<?= base_url('extra-libs/') ?>datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('extra-libs/') ?>datatables/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    language: {
                        url: "<?= base_url('assets/ID.json') ?>",
                    },
                });
            });
        </script>

    <?php else : ?>

        <script src="<?= base_url('wordsmith_theme/') ?>js/jquery.min.js"></script>

    <?php endif; ?>

    <script src="<?= base_url('wordsmith_theme/') ?>js/plugins.js"></script>
    <script src="<?= base_url('wordsmith_theme/') ?>js/main.js"></script>


</body>

</html>