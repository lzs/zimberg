<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zimberg
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="theme-color" content="#003366"/>
	<meta name="msapplication-navbutton-color" content="#003366">
	<meta name="apple-mobile-web-app-status-bar-style" content="#003366">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="site" class="site">
	<a class="skip-link screen-reader-text" href="#site-main"><?php esc_html_e( 'Skip to content', 'zimberg' ); ?></a>
	<header id="z-h">
		<div id="z-brand">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 id="z-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p id="z-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p id="z-desc"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- #z-brand-->

			<nav id="site-navigation">
				<input class="menu-btn" type="checkbox" id="menu-btn" />
				<label class="menu-icon" for="menu-btn">
					<span class="navicon"></span>
				</label>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="navfill"></div>
