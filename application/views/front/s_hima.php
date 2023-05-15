<section class="s-content s-content--top-padding">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <a href="<?= base_url('HM/info_hima/' . $col['singkatan']) ?>">
                <img src="<?= base_url('images/logo/' . $col['logo']) ?>" alt="" width="230px">
                <?php
                if ($kategori != null) {
                    echo '<h5 class="display-1 display-1--with-line-sep">' . $kategori . '</h5>';
                }
                ?>
            </a>
        </div>
    </div>

    <?php $this->load->view('front/content') ?>

</section>