<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wordsmith
 */

?>

<article id="post-id-<?php the_ID(  ); ?>" <?php post_class( 'row entry' ) ?>>

            <?php
            if(has_post_thumbnail(  )){
            ?>
            <div class="entry__media col-full">
                <div class="entry__post-thumb">
                    <?php the_post_thumbnail(  ); ?>
                </div>
            </div>
            <?php
            }
            ?>

            <div class="entry__header col-full">
                <h1 class="entry__header-title display-1">
                    <?php the_title(  ); ?>
                </h1>

            </div>

            <div class="col-full entry__main">
                <?php
                the_content(  );

                wp_link_pages( array(
                    'before' => '<div class="page-links">'. esc_html__('Pages:', 'wordsmith'),
                    'after' => '</div>'
                ) );
                ?>



            </div> <!-- s-entry__main -->

        </article> <!-- end entry/article -->


