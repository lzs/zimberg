<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Zimberg
 */

if ( ! function_exists( 'zimberg_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function zimberg_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'zimberg' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$catlist = get_the_category_list( ', ' );

		echo '<span class="posted-on">' . $posted_on . '</span><span class="cat-links"> | ' . $catlist . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'zimberg_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function zimberg_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'zimberg' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<p class="cat-links">' . esc_html__( 'Posted in %1$s', 'zimberg' ) . '</p>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'zimberg' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<p><span class="tags-links">' . esc_html__( 'Tagged %1$s', 'zimberg' ) . '</p>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_search() && ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'zimberg' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

	}
endif;


function zimberg_pretty_date( $timestr = NULL ) {
	$time = strtotime( $timestr );
	$time_today = strtotime( "today" );

	if ( $time >= $time_today ) return "Today";
	if ( $time >= $time_today - 86400 ) return "Yesterday";
	if ( $time >= $time_today - 2*86400 ) return "2 days ago";
	if ( $time >= $time_today - 3*86400 ) return "3 days ago";

	$time_week = strtotime( "this week 00:00:00" ) - 86400;
	if ( $time >= $time_week) return "This week";
	if ( $time >= $time_week - 86400) return "Last week";

	$pyear = date( 'Y', $time);
	$tyear = date( 'Y', $time_today);

	$pyearmonth = $pyear * 12 + date( 'n', $time);
	$tyearmonth = $tyear * 12 + date( 'n', $time_today);

	if ( $pyearmonth == $tyearmonth) return "This month";
	if ( $pyearmonth == $tyearmonth ) return "Last month";

	if ( $pyear == $tyear) return "This year";
	if ( $pyear == $tyear - 1) return "Last year";
	return ( $tyear - $pyear ) . " years ago";
}


function zimberg_mini_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( zimberg_pretty_date( get_the_date() ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( zimberg_pretty_date( get_the_date() ) )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( '%s', 'post date', 'zimberg' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$catlist = get_the_category_list( ', ' );

	echo '<span class="posted-on">' . $posted_on . '</span><span class="cat-links"> &nbsp;|&nbsp; ' . $catlist . '</span>'; // WPCS: XSS OK.

}
