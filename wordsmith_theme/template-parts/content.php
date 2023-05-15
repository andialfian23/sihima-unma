<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wordsmith
 */

?>

<article id="post-id-<?php the_ID(  ); ?>" <?php post_class( 'col-block' ) ?>>
                    
	<div class="item-entry" data-aos="zoom-in">
		<?php
		if(has_post_thumbnail(  )):
			?>
		<div class="item-entry__thumb">
			<a href="<?php the_permalink(  ) ?>" class="item-entry__thumb-link">
				<?php the_post_thumbnail(  ); ?>
			</a>
		</div>
		<?php
		endif;
		?>

		<div class="item-entry__text">
			<?php
			if(get_post_type(  ) == 'post'){
				
				$categories_list = get_the_category_list( esc_html__( ', ', 'wordsmith' ) );
				if ( $categories_list ) {
					?>
					<div class="item-entry__cat">
						<?php echo $categories_list ?>
					</div>
					<?php
				}
			}
			?>
			<h1 class="item-entry__title"><a href="<?php the_permalink(  ); ?>"><?php the_title(  ); ?></a></h1>
			
			<?php
			if(get_post_type(  ) == 'post'){
				?>
			<div class="item-entry__date">
				<a href="<?php the_permalink(  ); ?>"><?php echo esc_html(get_the_date(  )); ?></a>
			</div>
			<?php
			}
			?>
		</div>
	</div> <!-- item-entry -->
    
</article> <!-- end article -->
