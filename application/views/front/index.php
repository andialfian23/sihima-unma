<!-- featured ================================================== -->

<?php
$this->load->view('front/template/feature')
?>

<!-- end s-featured -->

<section class="s-content">
    <div class="row entries-wrap wide">
        <div class="entries">

            <?php foreach ($posts as $row) { ?>

                <article class="col-block">
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="<?= base_url("HM/post/" . $row['slug']) ?>" class="item-entry__thumb-link">
                                <img src="<?= img_post($row['cover']) ?>" alt="">
                            </a>
                        </div>
                        <div class="item-entry__text">
                            <div class="item-entry__cat">
                                <a href="<?= base_url("HM/kategori/" . $row['slug_k']) ?>"><?= $row['nama_kategori'] ?></a>
                            </div>

                            <h1 class="item-entry__title">
                                <a href="<?= base_url("HM/post/" . $row['slug']) ?>"><?= $row['judul'] ?></a>
                            </h1>

                            <div class="item-entry__date">
                                <a href="<?= base_url("HM/post/" . $row['slug']) ?>"><?= $row['created_at'] ?></a>
                            </div>
                        </div>
                    </div> <!-- item-entry -->
                </article> <!-- end article -->

            <?php } ?>

        </div> <!-- end entries -->
    </div> <!-- end entries-wrap -->

    <div class="row">
        <div class="col-full text-center">
            <a href="<?= base_url('HM/posts') ?>" class="btn btn--primary">Lihat Postingan Lainnya</a>
        </div>
    </div>
</section>