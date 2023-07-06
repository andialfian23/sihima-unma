<section class="s-content s-content--top-padding s-content--narrow">

    <article class="row entry format-standard">

        <div class="entry__media col-full">
            <div class="entry__post-thumb">
                <img src="<?= img_post($post['cover']) ?>" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
            </div>
        </div>

        <div class="entry__header col-full">
            <h1 class="entry__header-title display-1"><?= $post['judul'] ?></h1>
            <ul class="entry__header-meta">
                <li class="date"><?= $post['created_at'] ?></li>
                <li class="byline">
                    Oleh <?= $post['author'] ?>
                </li>
                <li>
                    DIBACA <?= $post['dilihat'] ?> KALI
                </li>
            </ul>
        </div>

        <div class="col-full entry__main">

            <?= $post['body'] ?>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <!-- <div class="addthis_inline_share_toolbox"></div> -->

            <div class="fb-comments" data-href="<?= base_url("HM/post/" . $post['slug']) ?>" data-width="100%" data-numposts="5"></div>

            <div class="entry__author">
                <img src="<?= img_logo($post['logo']) ?>" alt="">

                <div class="entry__author-about">
                    <h5 class="entry__author-name">
                        <span>Oleh</span>
                        <a href="#0"><?= $post['author'] ?></a>
                    </h5>

                    <div class="entry__author-desc">
                        <p>
                            <a href="<?= base_url("HM/hima/" . $post['singkatan']) ?>">
                                <?= $post['nama_hima'] ?>
                            </a> <br>
                            <a href="<?= base_url("HM/info_hima/" . $post['singkatan']) ?>">
                                <?= $post['singkatan'] . ' ' . $post['periode1'] . '/' . $post['periode2']; ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div> <!-- s-entry__main -->

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <!-- <div class="addthis_relatedposts_inline"></div> -->

    </article> <!-- end entry/article -->
</section>