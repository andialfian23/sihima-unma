<!-- featured 
================================================== -->
<?php

$wordsmith_display_banner = get_theme_mod( 'display_banner', false );

if($wordsmith_display_banner == false){
    return;
}

$wordsmith_banner_category = get_theme_mod( 'banner_category', 0 );
$wordsmith_banner_no_of_posts = get_theme_mod( 'banner_no_of_posts', 3 );

$wordsmith_query_banner_posts = new WP_Query(array(
    'post_type' => 'post',
    'cat' => absint($wordsmith_banner_category),
    'posts_per_page' => absint($wordsmith_banner_no_of_posts),
));

if($wordsmith_query_banner_posts->have_posts()){
?>
<section class="s-featured">
    <div class="row">
        <div class="col-full">

            <div class="featured-slider featured" data-aos="zoom-in">
                <?php
                while($wordsmith_query_banner_posts->have_posts(  )):

                    $wordsmith_query_banner_posts->the_post(  );

                ?>

                <div class="featured__slide">
                    <div class="entry">

                        <div class="entry__background" style="background-image:url(<?php 
                        echo esc_url(get_the_post_thumbnail_url(  )); ?>);"></div>
                        
                        <div class="entry__content">
                        <?php
                        if(get_post_type(  ) == 'post'){
                            
                            $categories_list = get_the_category_list( esc_html__( ', ', 'wordsmith' ) );
                            if ( $categories_list ) {
                                ?>
                                <span class="entry__category">
                                    <?php echo $categories_list ?>
                            </span>
                                <?php
                            }
                        }
                        ?>

                            <h1><a href="<?php the_permalink(  ); ?>" title=""><?php the_title(  ) ?></a></h1>

                            <div class="entry__info">
                                <a href="<?php echo esc_url(get_the_author_meta('url')); ?>" class="entry__profile-pic">
                                    <img class="avatar" src="<?php echo esc_url(get_avatar_url( get_the_author_meta( 'ID' ) )); ?>" alt="">
                                </a>
                                <ul class="entry__meta">
                                    <li><a href="<?php echo esc_url(get_the_author_meta('url')); ?>"><?php echo esc_html(get_the_author(  )); ?></a></li>
                                    <li><?php echo esc_html(get_the_date(  )); ?></li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->
                        
                    </div> <!-- end entry -->
                </div> <!-- end featured__slide -->
                <?php
                endwhile;
                wp_reset_postdata(  );
                ?>
                
            </div> <!-- end featured -->

        </div> <!-- end col-full -->
    </div>
</section> <!-- end s-featured -->
<?php
}
?>