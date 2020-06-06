<?php
/**
 * zimberg Theme Customizer
 *
 * @package Zimberg
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zimberg_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.z-title a',
			'render_callback' => 'zimberg_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.z-desc',
			'render_callback' => 'zimberg_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_setting(
		'z_featured_cat',
		array( 'default' => 'Uncategorized', )
	);
	$wp_customize->add_setting(
		'z_front_posts',
		array( 'default' => 5 )
	);
	$wp_customize->add_setting(
		'z_copyright_text',
		array( 'default' => '', )
	);
	$wp_customize->add_setting(
		'z_comment_policy_page',
		array( 'default' => '', )
	);
	$wp_customize->add_setting(
		'z_opensearch_url',
		array( 'default' => '', )
	);
	$wp_customize->add_setting(
		'z_fonts_css',
		array( 'default' => '', )
	);

	$wp_customize->add_section( 'zimberg_settings_section' , array(
		'title'      => __( 'Zimberg Theme Settings', 'zimberg' ),
		'priority'   => 30,
	) );

	$wp_customize->add_control(
		'z_featured_cat',
		array(
			'label'      => __( 'Featured Category', 'zimberg' ),
			'section'    => 'zimberg_settings_section',
			'settings'   => 'z_featured_cat',
			'description'	=> __( 'Name of featured category', 'zimberg' ),
		)
	);
	$wp_customize->add_control(
		'z_copyright_text',
		array(
			'label'      => __( 'Copyright Text', 'zimberg' ),
			'section'    => 'zimberg_settings_section',
			'settings'   => 'z_copyright_text',
			'description'	=> __( 'Copyright text in page footer', 'zimberg' ),
		)
	);
	$wp_customize->add_control(
		'z_comment_policy_page',
		array(
			'label'      => __( 'Comment Policy Page', 'zimberg' ),
			'section'    => 'zimberg_settings_section',
			'settings'   => 'z_comment_policy_page',
			'description'	=> __( 'Page name for comment policy', 'zimberg' ),
		)
	);
	$wp_customize->add_control(
		'z_front_posts',
		array(
			'label'      => __( 'Number of Front Column Posts', 'zimberg' ),
			'section'    => 'zimberg_settings_section',
			'settings'   => 'z_front_posts',
			'description'	=> __( 'Number of posts in columns on front page', 'zimberg' ),
		)
	);
	$wp_customize->add_control(
		'z_opensearch_url',
		array(
			'label'      => __( 'Open Search Description URL', 'zimberg' ),
			'section'    => 'zimberg_settings_section',
			'settings'   => 'z_opensearch_url',
			'description'	=> __( 'URL to Open Search Description XML', 'zimberg' ),
		)
	);
	$wp_customize->add_control(
		'z_fonts_css',
		array(
			'label'		=> __( 'Use own fonts', 'zimberg' ),
			'section'	=> 'zimberg_settings_section',
			'settings'	=> 'z_fonts_css',
			'type'		=> 'textarea',
			'description'	=> __( 'Specify own fonts CSS to replace link to Google Font API', 'zimberg' ),
		)
	);

}
add_action( 'customize_register', 'zimberg_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function zimberg_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function zimberg_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zimberg_customize_preview_js() {
	wp_enqueue_script( 'zimberg-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'zimberg_customize_preview_js' );
