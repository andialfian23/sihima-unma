<section class="s-content s-content--top-padding">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <a href="<?= base_url('HM/info_hima/' . $hima['singkatan']) ?>">
                <img src="<?= base_url('images/logo/' . $hima['logo']) ?>" alt="" width="230px">
                <?php
                if ($judul_posts != null) {
                    echo '<h5 class="display-1 display-1--with-line-sep">' . $judul_posts . '</h5>';
                }
                ?>
            </a>
        </div>
    </div>

    <?php $this->load->view('front/post/index') ?>

</section>