<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zimberg
 */

get_header(); ?>

<div id="z-b">

	<main id="z-m"><div class="main-inner">

	<?php
	if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<div>
			Select archive by month:
			<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
				<option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option>
				<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 )
); ?>
			</select>
		</div>

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
			get_template_part( 'template-parts/home-content', get_post_format() );

		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</div></main><!-- .main-inner #z-m -->

	<?php get_sidebar(); ?>

</div><!-- #z-b -->
<?php
get_footer();
