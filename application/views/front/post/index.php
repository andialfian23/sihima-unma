<section class="s-content s-content--top-padding">
    <div class="row entries-wrap wide">
        <div class="entries">

            <?php foreach ($posts as $post) { ?>

                <article class="col-block">
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="<?= base_url("HM/post/" . $post['slug']) ?>" class="item-entry__thumb-link">
                                <img src="<?= img_post($post['cover']) ?>" alt="">
                            </a>
                        </div>
                        <div class="item-entry__text">
                            <div class="item-entry__cat">
                                <?php $jenis = $this->uri->segment(2);
                                if ($jenis == 'kategori') :
                                ?>
                                    <a href="<?= base_url("HM/hima/" . $post['singkatan']) ?>"><?= $post['singkatan'] ?></a>
                                <?php else : ?>
                                    <a href="<?= base_url("HM/kategori/" . $post['slug_k']) ?>"><?= $post['nama_kategori'] ?></a>
                                <?php endif; ?>
                            </div>

                            <h1 class="item-entry__title">
                                <a href="<?= base_url("HM/post/" . $post['slug']) ?>"><?= $post['judul'] ?></a>
                            </h1>


                            <div class="item-entry__date">
                                <a href="<?= base_url("HM/post/" . $post['slug']) ?>"><?= $post['created_at'] ?></a>
                            </div>
                        </div>
                    </div> <!-- item-entry -->
                </article> <!-- end article -->

            <?php } ?>

        </div> <!-- end entries -->
    </div> <!-- end entries-wrap -->

    <div class="row pagination-wrap">
        <div class="col-full">
            <?= $pagination; ?>
        </div>
    </div>

</section>