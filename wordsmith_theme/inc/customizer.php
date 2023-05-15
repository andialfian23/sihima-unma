<?php
/**
 * Wordsmith Theme Customizer
 *
 * @package Wordsmith
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wordsmith_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	require get_template_directory(  ). '/inc/sanitize-callback.php';

	$category_terms = get_terms( 'category' );
	//empty variable to store category list
	$categories = array();

	//check if category terms is empty
	if($category_terms){

		foreach($category_terms as $cat_term){
			//store term_id as key and name as value
			$categories[$cat_term->term_id] = $cat_term->name;
		}
	}

	$wp_customize->add_panel('wordsmith_theme_options', array(
		'title' => __('Theme Options', 'wordsmith'),
	));

	$wp_customize-> add_section('wordsmith_banner_options', array(
		'title' => __('Banner Options', 'wordsmith'),
		'panel' => 'wordsmith_theme_options',

	));

	$wp_customize-> add_setting('display_banner', array(
		'default' => false,
		'sanitize_callback' => 'wp_validate_boolean',
	));

	$wp_customize-> add_control('display_banner', array(
		'label' => __('Display Banner', 'wordsmith'),
		'type' => 'checkbox',
		'section' => 'wordsmith_banner_options',
	));

	$wp_customize->add_setting('banner_category', array(
		'default' => 0,
		'sanitize_callbak' => 'wordsmith_sanitize_choice',
	));

	$wp_customize-> add_control('banner_category', array(
		'label' => __('select Category', 'wordsmith'),
		'type' => 'select',
		'section' => 'wordsmith_banner_options',
		'choices' => $categories,
	));

	//no of posts for banner
	$wp_customize->add_setting('banner_no_of_posts', array(
		'default' =>3,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('banner_no_of_posts', array(
		'label' => __('Number of Posts','wordsmith'),
		'type' => 'number',
		'section' => 'wordsmith_banner_options',
	));

	$wp_customize->add_section('wordsmith_footer_options',array(
		'title' => __('Footer Options', 'wordsmith'),
		'panel' => 'wordsmith_theme_options',
	));

	$wp_customize->add_setting('facebook_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('facebook_link', array(
		'label' => __('Facebook Link', 'wordsmith'),
		'type' => 'url',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_setting('twitter_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('twitter_link', array(
		'label' => __('Twitter Link', 'wordsmith'),
		'type' => 'url',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_setting('instagram_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('instagram_link', array(
		'label' => __('Instagram Link', 'wordsmith'),
		'type' => 'url',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_setting('youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('youtube_link', array(
		'label' => __('Youtube Link', 'wordsmith'),
		'type' => 'url',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_setting('pinterest_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('pinterest_link', array(
		'label' => __('Pinterest Link', 'wordsmith'),
		'type' => 'url',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_setting('copyright_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('copyright_text', array(
		'label' => __('Copyright Text', 'wordsmith'),
		'type' => 'text',
		'section' => 'wordsmith_footer_options',
	));

	$wp_customize->add_section('wordsmith_extra_options',array(
		'title' => __('Extra Options', 'wordsmith'),
		'panel' => 'wordsmith_theme_options',
	));

	$wp_customize->add_setting('display_preloader',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('display_preloader', array(
		'label' => __('Display Preloader', 'wordsmith'),
		'type' => 'checkbox',
		'section' => 'wordsmith_extra_options',
	));

	$wp_customize->add_setting('display_scroll_to_top_btn',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('display_scroll_to_top_btn', array(
		'label' => __('Display Scroll to Top Button', 'wordsmith'),
		'type' => 'checkbox',
		'section' => 'wordsmith_extra_options',
	));

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wordsmith_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wordsmith_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'wordsmith_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wordsmith_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wordsmith_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wordsmith_customize_preview_js() {
	wp_enqueue_script( 'wordsmith-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wordsmith_customize_preview_js' );
