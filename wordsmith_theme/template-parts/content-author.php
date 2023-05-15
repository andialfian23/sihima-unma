<div class="entry__author">
    <img src="<?php echo esc_url(get_avatar_url( get_the_author_meta( 'ID' ) )); ?>" alt="">

    <div class="entry__author-about">
        <h5 class="entry__author-name">
            <span><?php echo __('Posted by', 'wordsmith') ?></span>
            <a href="<?php echo esc_url(get_the_author_meta('url')); ?>">
            <?php echo esc_html(get_the_author(  )); ?></a>
        </h5>

        <div class="entry__author-desc">
            <p>
                <?php echo __(get_the_author_meta( 'description' )); ?>
            </p>
        </div>
    </div>
</div>