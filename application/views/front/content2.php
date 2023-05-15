<!-- s-content
    ================================================== -->

<section class="s-content">
    <div class="row entries-wrap wide">
        <div class="entries">

            <?php foreach ($tampil as $t) { ?>

                <article class="col-block">
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="<?= base_url("HM/post/" . $t['slug']) ?>" class="item-entry__thumb-link">
                                <img src="<?= img_post($t['cover']) ?>" alt="">
                            </a>
                        </div>
                        <div class="item-entry__text">
                            <div class="item-entry__cat">
                                <a href="<?= base_url("HM/hima/" . $t['singkatan']) ?>"><?= $t['singkatan'] ?></a>
                            </div>

                            <h1 class="item-entry__title">
                                <a href="<?= base_url("HM/post/" . $t['slug']) ?>"><?= $t['judul'] ?></a>
                            </h1>

                            <div class="item-entry__date">
                                <a href="<?= base_url("HM/post/" . $t['slug']) ?>"><?= $t['created_at'] ?></a>
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


<!-- end s-content -->