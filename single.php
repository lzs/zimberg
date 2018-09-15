<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Zimberg
 */

get_header(); ?>

<div id="z-b">

	<main id="z-m"><div class="main-inner">

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation( array(
			'prev_text' => 'Prev: %title',
			'next_text' => 'Next: %title',
		) );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

	</div></main><!-- .main-inner #z-m -->

	<?php get_sidebar(); ?>

</div><!-- #z-b -->
<?php
get_footer();
