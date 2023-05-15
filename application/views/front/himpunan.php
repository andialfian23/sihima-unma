<section class="s-content s-content--top-padding">
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1 class="display-1 display-1--with-line-sep">HIMPUNAN MAHASISWA UNIVERSITAS MAJALENGKA</h1>
        </div>
    </div>
    <section class="s-content">
        <div class="row entries-wrap wide">
            <div class="entries">

                <?php foreach ($tampil as $t) { ?>

                    <article class="col-block">
                        <div class="item-entry" data-aos="zoom-in">
                            <div class="item-entry__thumb imgLogo">
                                <a href="<?= base_url("HM/info_hima/" . $t['singkatan']) ?>" class="item-entry__thumb-link">
                                    <img src="<?= base_url("images/logo/" . $t['logo']) ?>" alt="" class="hima">
                                </a>
                            </div>
                            <div class="item-entry__text mt-1">
                                <h2 class="item-entry__title">
                                    <a href="<?= base_url("HM/info_hima/" . $t['singkatan']) ?>"><?= $t['singkatan'] ?></a>
                                </h2>

                                <div class="item-entry__cat">
                                    <a href="<?= base_url("HM/info_hima/" . $t['singkatan']) ?>"><?= $t['nama_hima'] ?></a>
                                </div>
                            </div>
                        </div>
                    </article>

                <?php } ?>

            </div>
        </div>
    </section>

    <div class="row pagination-wrap">
        <div class="col-full">
            <?= $pagination; ?>
        </div>
    </div>
</section>