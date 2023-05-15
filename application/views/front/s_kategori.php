<section class="s-content s-content--top-padding">


    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <?php
            if ($kategori != null) {
                echo '<h1 class="display-1 display-1--with-line-sep">' . $kategori . '</h1>';
            }
            ?>

        </div>
    </div>

    <?php $this->load->view('front/content2') ?>

</section>