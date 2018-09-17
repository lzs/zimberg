<?php
/**
 * Zimberg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Zimberg
 */

include 'archive-link-widget.php';

if ( ! function_exists( 'zimberg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zimberg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on zimberg, use a find and replace
		 * to change 'zimberg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'zimberg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 580, 290, array( 'center', 'center') );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header', 'zimberg' ),
		) );

		register_nav_menus( array(
			'menu-2' => esc_html__( 'Footer 1', 'zimberg' ),
		) );

		register_nav_menus( array(
			'menu-3' => esc_html__( 'Footer 2', 'zimberg' ),
		) );

		register_nav_menus( array(
			'menu-4' => esc_html__( 'Footer 3', 'zimberg' ),
		) );

		register_sidebar( array(
			'name'          => __( 'Blog Sidebar', 'zimberg' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'sidebar' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'zimberg' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'zimberg' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'zimberg' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'zimberg' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'zimberg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zimberg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zimberg_content_width', 640 );
}
add_action( 'after_setup_theme', 'zimberg_content_width', 0 );

/**
 * Register Google Fonts
 */
function zimberg_fonts_url() {

	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'zimberg' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Glegoo|Oxygen|Inconsolata';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function zimberg_scripts() {
	wp_enqueue_style( 'teimbergbase-style', get_stylesheet_uri() );

	$fonts_css = get_theme_mod( 'z_fonts_css' );

	if ($fonts_css) {
		echo '<style>' .  $fonts_css . '</style>';
	}
	else {
		wp_enqueue_style( 'zimberg-fonts', zimberg_fonts_url() );
	}

	wp_enqueue_script( 'zimberg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'zimberg-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zimberg_scripts' );

function zimberg_editor_styles() {
	wp_enqueue_style( 'zimberg-editor-styles', get_theme_file_uri( '/editor-style.css' ), false, '1.0', 'all' );
	if ($fonts_css) {
		echo '<style>' .  $fonts_css . '</style>';
	}
	else {
		wp_enqueue_Style( 'zimberg-editor-fonts', zimberg_fonts_url() );
	}
}

add_action( 'enqueue_block_editor_assets', 'zimberg_editor_styles' );

/**
 * Add our custom excerpt text.
 */
function zimberg_get_the_excerpt( $excerpt, $post ) {
	return zimberg_custom_excerpt();
}
add_filter( 'get_the_excerpt', 'zimberg_get_the_excerpt', 10, 2 );

/**
 * Add Archive Link widget
 */

add_action('widgets_init',
	create_function('', 'return register_widget("zimberg_archive_link");')
);

/*
 * $mode = 0: count by characters
 *         1: count by words
 */
function zimberg_custom_excerpt( $post = null, $mode = 0, $max_count = 0 ) {
	$max_chars = 230;
	$max_words = 50;
	$text;

	if ($max_count == 0) {
		if ($mode) {
			$max_count = 50;
		}
		else {
			$max_count = 230;
		}
	} 
 
	$post = get_post( $post );

	if ( has_excerpt() ) {
		$text = $post->post_excerpt . ' &nbsp;|&nbsp; ';
	}

	if ($mode) {
		/* Limit by words */
		$count = str_word_count( $text );
		if ($count > $max_count) {
			$count = $max_count;
		}
		$count = $max_count - $count;
		if ($count > 0) {
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = strip_tags( $content );
			$words = preg_split( '/[\s]+/', trim( $content ) );
			#$words = explode( ' ', $content );
			$content = implode( ' ', array_slice( $words, 0, min( $count, count( $words ) ) ) );
			$text .= ' | ' . $content;
		}
		return $text;

	}
	else {
		/* Limit by characters */
		$count = strlen( $text );
		if ($count > $max_chars) {
			$count = $max_count;
		}
		$count = $max_count - $count;
		if ($count > 0) {
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = trim( strip_tags( $content ) );
			$content = substr( $content, 0, strrpos( substr( $content, 0, $count ), ' ' ) );
			$text .= $content . ' ...';
		}
		return $text;

	}
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

