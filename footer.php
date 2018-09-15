<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zimberg
 */

?>

<footer id="z-f"><div class="inner">
	<nav>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'menu-2',
			'menu_id'        => 'footer-menu-1',
		) );
		wp_nav_menu( array(
			'theme_location' => 'menu-3',
			'menu_id'        => 'footer-menu-2',
		) );
		wp_nav_menu( array(
			'theme_location' => 'menu-4',
			'menu_id'        => 'footer-menu-3',
		) );
		?>
	</nav>
	<div class="site-info">
		<?php
			printf( esc_html__( 'Copyright &copy; 2004-2018 by Lai Zit Seng' ) );
		?>
		<span class="sep"> | </span>
		<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %s', 'zimberg' ), '<a href="https://zitseng.com/">Zimberg</a>' );
		?>
	</div><!-- .site-info -->
</div></footer><!-- .inner --><!-- #z-f -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
