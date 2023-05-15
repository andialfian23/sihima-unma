<header class="s-header header bg-dark d-print-none">
    <div class="header__logo">
        <a class="logo" href="<?= base_url("HM") ?>">
            <img src="<?= base_url() ?>assets/images/unmaku_250.png" alt="Homepage">
        </a>
    </div> <!-- end header__logo -->
    <a class="header__search-trigger" href="#0"></a>
    <div class="header__search">

        <form role="search" method="get" class="header__search-form" action="<?= base_url('HM/cari') ?>">
            <label>
                <span class="hide-content">Search for:</span>
                <input type="search" class="search-field" placeholder="Judul Postingan" value="" name="search" title="Search for:" autocomplete="off">
            </label>
            <!-- <input type="submit" class="search-submit" value="Search"> -->
        </form>

        <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

    </div> <!-- end header__search -->
    <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
    <nav class="header__nav-wrap">

        <h2 class="header__nav-heading h6">Navigasi</h2>

        <ul class="header__nav">
            <li class="current"><a href="<?= base_url("HM") ?>" title="">Home</a></li>
            <li>
                <a href="<?= base_url("HM/kategori/") ?>berita">Berita</a>
            </li>
            <li class="has-children">
                <a href="#0" title="">Kegiatan</a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url("HM/kategori/") ?>pelatihan">Pelatihan</a>
                    </li>
                    <li>
                        <a href="<?= base_url("HM/kategori/") ?>perlombaan">Perlombaan</a>
                    </li>
                    <li>
                        <a href="<?= base_url("HM/kategori/") ?>sosialisasi">Sosialisasi</a>
                    </li>
                    <li>
                        <a href="<?= base_url("HM/kategori/") ?>seminar">Seminar</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?= base_url("HM/himpunan") ?>">Himpunan Mahasiswa</a>
            </li>
            <li>
                <a href="<?= base_url("HM/register") ?>">Registrasi</a>
            </li>
            <li>
                <?php if (!empty($_SESSION['nama'])) {
                    echo '<a href="' . base_url("Dashboard") . '">Dashboard</a>';
                } else {
                    echo '<a href="' . base_url("Dashboard") . '">Login</a>';
                } ?>


            </li>
        </ul> <!-- end header__nav -->

        <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

    </nav> <!-- end header__nav-wrap -->

</header>