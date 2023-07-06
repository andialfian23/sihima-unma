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
    <?php $this->load->view("front/template/navbar") ?>

    <!-- end-header -->
    <?php $this->load->view('front/' . $file) ?>

    <!-- s-extra
    ================================================== -->
    <?php $this->load->view('front/template/s_extra'); ?>
    <!-- end s-extra -->

    <!-- s-footer ================================================== -->
    <?php $this->load->view('front/template/footer') ?>

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