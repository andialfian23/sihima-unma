<?php

class Wordsmith_Post_Widget extends WP_Widget{

    public function __construct(){
        parent:: __construct(
            'wordsmith-post-widget',
            __('Wordsmith: Post Widget', 'wordsmith'),
            array(
                'description' => __('Displays list of posts', 'wordsmith'),
                'classname' => ' md-six tab-full popular',
            )
        );
    }

    public function widget($args, $instance){

        $title = isset($instance['title']) ? $instance['title'] : '';
        $no_of_posts = isset($instance['no_of_posts']) ? $instance['no_of_posts'] : 5;
        $display_author = isset($instance['display_author']) ? $instance['display_author'] : false;
        $display_date = isset($instance['display_date']) ? $instance['display_date'] : false;

        $query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => absint($no_of_posts),
        ));

        if( ! $query->have_posts() ){
            return;
        }

        echo $args['before_widget'];

        if($title){
            echo $args['before_title'];

            echo esc_html($title);

            echo $args['after_title'];
        }
        ?>
        <div class="block-1-2 block-m-full popular__posts">
            <?php
            while($query->have_posts()){
                $query->the_post(  );
                ?>

        <article class="col-block popular__post">
            <a href="<?php the_permalink(  ); ?>" class="popular__thumb">
                <?php the_post_thumbnail( 'thumbnail' ) ?>
            </a>
            <h5><?php the_title(  ) ?></h5>

                <?php
                if($display_author==true || $display_date==true){
                ?>

            <section class="popular__meta">
                <?php
                if($display_author==true){
                ?>
                <span class="popular__author"><span><?php echo __('By', 'wordsmith') ?></span>
                 <a href="<?php echo esc_url(get_the_author_meta( 'url' )); ?>">
                 <?php echo esc_html(get_the_author_meta( 'display_name' )); ?></a></span>
                 <?php
                }
                if($display_date==true){
                ?>
                <span class="popular__date"><span><?php echo __('on', 'wordsmith') ?></span>
                 <time datetime="<?php echo esc_attr(get_the_date(  )); ?>">
                 <?php echo esc_html(get_the_date(  )); ?></time></span>
                 <?php
                }
                ?>
            </section>
            <?php
                }
                ?>
        </article>
        <?php
            }
            wp_reset_postdata(  );
        ?>

        </div> <!-- end popular_posts -->

            <?php

        echo $args['after_widget'];
        
    }

    public function form($instance){

        $title = isset($instance['title']) ? $instance['title'] : '';
        $no_of_posts = isset($instance['no_of_posts']) ? $instance['no_of_posts'] : 5;
        $display_author = isset($instance['display_author']) ? $instance['display_author'] : false;
        $display_date = isset($instance['display_date']) ? $instance['display_date'] : false;

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo __('Title', 'wordsmith'); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
            name="<?php echo ($this->get_field_name('title')); ?>"
            value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>"><?php echo __('Number of Posts', 'wordsmith'); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>" 
            name="<?php echo ($this->get_field_name('no_of_posts')); ?>"
            value="<?php echo esc_attr($no_of_posts); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_author')); ?>">
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('display_author')); ?>" 
            name="<?php echo ($this->get_field_name('display_author')); ?>"
            <?php checked($display_author,true) ?>">
            <?php echo __('Display Author name', 'wordsmith'); ?></label>
            
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_date')); ?>">
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('display_date')); ?>" 
            name="<?php echo ($this->get_field_name('display_date')); ?>"
            <?php checked($display_date,true) ?>">
            <?php echo __('Display Date', 'wordsmith'); ?></label>
            
        </p>
        
        <?php

    }

    public function update($new_instance, $old_instance){

        $instance = $old_instance;
        $instance['title'] = isset($new_instance['title'])? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['no_of_posts'] = isset($new_instance['no_of_posts'])?absint($new_instance['no_of_posts']):5;
        $instance['display_author'] = isset($new_instance['display_author'])?wp_validate_boolean( $new_instance['display_author'] ):false;
        $instance['display_date'] = isset($new_instance['display_date'])?wp_validate_boolean( $new_instance['display_date'] ):false;

        return $instance;


    }

}

