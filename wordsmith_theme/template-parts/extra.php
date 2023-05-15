<!-- s-extra
    ================================================== -->

    <?php
    if(! is_active_sidebar( 'sidebar-1' )){
        return;
    }
    ?>
    <section class="s-extra">

        <div class="row">

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

        </div> <!-- end row -->

    </section> <!-- end s-extra -->