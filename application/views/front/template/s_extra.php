<section class="s-extra d-print-none">

    <div class="row">
        <div class="col-six md-six tab-full popular">
            <h3>Populer</h3>

            <div class="block-1-1 block-m-full popular__posts">
                <?php
                $populer = $this->post->post_populer();
                foreach ($populer as $p) {
                ?>
                    <article class="col-block popular__post">
                        <a href="<?= base_url("HM/post/" . $p['slug']) ?>" class="popular__thumb">
                            <img src="<?= img_post($p['cover']) ?>" alt="">
                        </a>
                        <a href="<?= base_url("HM/post/" . $p['slug']) ?>">
                            <h5><?= $p['judul']; ?></h5>
                        </a>
                        <section class="popular__meta">
                            <span class="popular__author"><span>Oleh</span> <a href="#0"><?= $p['author'] ?></a></span>
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