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
                <ul class="entry__header-meta">
                    <li class="date"><?php echo esc_html(get_the_date(  )); ?></li>
                    <li class="byline">
                    <?php
                    printf(esc_html__('By %s', 'wordsmith'), get_the_author_link(  ));
                    ?>
                    </li>
                </ul>
            </div>

            <div class="col-full entry__main">
                <?php
                the_content(  );

                wp_link_pages( array(
                    'before' => '<div class="page-links">'. esc_html__('Pages:', 'wordsmith'),
                    'after' => '</div>'
                ) );
                ?>

                <div class="entry__taxonomies">
                    <?php
                        $categories_list = get_the_category_list( esc_html__( ', ', 'wordsmith' ) );
								if ( $categories_list ) {
					?>
                    <div class="entry__cat">
                        <h5><?php echo __('Posted In:', 'wordsmith'); ?> </h5>
                        <span class="entry__tax-list">
                                    <?php echo wp_kses_post( $categories_list ); ?>
                        </span>
                        <?php
                            }
                        ?>
                    </div> <!-- end entry__cat -->

                    <?php
                        $tags_list = get_the_tag_list( esc_html__( ', ', 'wordsmith' ) );
								if ( $tags_list ) {
					?>
                    <div class="entry__tags">
                        <h5><?php echo __('Tags:', 'wordsmith'); ?></h5>
                        <span class="entry__tax-list entry__tax-list--pill">
                        <?php echo wp_kses_post( $tags_list ); ?>
                        </span>
                    <?php
                        }
                    ?>
  
                    </div> <!-- end entry__tags -->
                    <?php
                        get_template_part( 'template-parts/content', 'author' );
                    ?>
                </div> <!-- end s-content__taxonomies -->

            </div> <!-- s-entry__main -->

        </article> <!-- end entry/article -->