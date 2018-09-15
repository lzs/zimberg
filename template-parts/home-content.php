<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zimberg
 */

?>

<?php if ( has_post_thumbnail() ) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="cover-header">
		<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark" alt="">
		<?php
			the_post_thumbnail();
		?>
		</a>
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
		</div><!-- .cover-header -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<span class="entry-meta">
			<?php zimberg_mini_meta(); ?>
		</span><!-- .entry-meta -->
		&nbsp;|&nbsp;
		<span>
			<?php echo get_the_excerpt() ?>
		</span>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php else : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<span class="entry-meta">
			<?php zimberg_mini_meta(); ?>
		</span><!-- .entry-meta -->
		&nbsp;|&nbsp;
		<span>
			<?php echo get_the_excerpt(); ?>
		</span>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>
