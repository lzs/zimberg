<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zimberg
 */

get_header(); ?>

<?php
$seenPosts = array();

// WP_Query arguments
$args1 = array(
	'posts_per_page'    => 2,
	'post_type'     => 'post',  //choose post type here
	'order' => 'DESC',
);

// The Query
$query1 = new WP_Query( $args1 );

?>
	<?php
	if ( $query1->have_posts() ) :
	?>

<div id="z-b1">

	<?php
		/* Start Loop for most recent 2 posts */
		while ( $query1->have_posts() ) : $query1->the_post();
			$seenPosts[] = $post->ID;
	?>
	<div class="z-m1"><div class="main-inner">
		<?php
			/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
			get_template_part( 'template-parts/home-content', get_post_format() );
		?>
	</div></div><!-- .main-inner .z-m1 -->
	<?php

		endwhile;

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>


</div><!-- #z-b1 -->
<div id="z-b2">
	<div class="z-m2"><div class="main-inner">
		<h2>Technology</h2>

	<?php
	// WP_Query arguments
	$args2 = array(
		'cat' => 2,
		'post__not_in' => $seenPosts,
		'posts_per_page'    => 4,
		'post_type'     => 'post',  //choose post type here
		'order' => 'DESC',
	);
	$query2 = new WP_Query( $args2 );

	// WP_Query arguments
	$args3 = array(
		'category__not_in' => array( 2 ),
		'post__not_in' => $seenPosts,
		'posts_per_page'    => 4,
		'post_type'     => 'post',  //choose post type here
		'order' => 'DESC',
	);
	$query3 = new WP_Query( $args3 );

	?>
	<?php
		/* Start Loop for sub-column left */
		while ( $query2->have_posts() ) : $query2->the_post();
	?>
		<?php
			/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
			get_template_part( 'template-parts/home-content', get_post_format() );
		?>
	<?php

		endwhile;
	?>
	</div></div><!-- .main-inner .z-m2 -->
	<div class="z-m2"><div class="main-inner">
		<h2>Other Posts</h2>
	<?php

		/* Start Loop for sub-column right */
		while ( $query3->have_posts() ) : $query3->the_post();
	?>
		<?php
			/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
			get_template_part( 'template-parts/home-content', get_post_format() );
		?>
	<?php

		endwhile;

	?>
	</div></div><!-- .main-inner .z-m2 -->
<?php

	get_sidebar();
?>
</div><!-- #z-b2 -->
<?php

get_footer();
