<?php
/**
 * Blog archive and single-post helpers.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Posts page ID when Reading is set to a static front page.
 *
 * @return int
 */
function paperia_get_posts_page_id() {
	if ( 'page' !== get_option( 'show_on_front' ) ) {
		return 0;
	}

	return (int) get_option( 'page_for_posts' );
}

/**
 * Title for the blog index.
 *
 * @return string
 */
function paperia_get_blog_title() {
	$page_id = paperia_get_posts_page_id();

	if ( $page_id > 0 ) {
		$title = get_the_title( $page_id );
		if ( is_string( $title ) && '' !== $title ) {
			return $title;
		}
	}

	return __( 'وبلاگ', 'paperia' );
}

/**
 * Optional intro under the blog title, from the posts page excerpt.
 *
 * @return string
 */
function paperia_get_blog_description() {
	$page_id = paperia_get_posts_page_id();

	if ( $page_id <= 0 ) {
		return '';
	}

	$excerpt = get_post_field( 'post_excerpt', $page_id );
	if ( ! is_string( $excerpt ) ) {
		return '';
	}

	return trim( wp_strip_all_tags( $excerpt ) );
}

/**
 * Published post count for the blog header.
 *
 * @return int
 */
function paperia_get_published_post_count() {
	$counts = wp_count_posts( 'post' );

	if ( ! isset( $counts->publish ) ) {
		return 0;
	}

	return (int) $counts->publish;
}

/**
 * First non-default category for a post.
 *
 * @param int $post_id Post ID. Defaults to the current post.
 * @return WP_Term|null
 */
function paperia_get_primary_category( $post_id = 0 ) {
	$post_id    = $post_id > 0 ? (int) $post_id : (int) get_the_ID();
	$categories = get_the_category( $post_id );

	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return null;
	}

	$default_id = (int) get_option( 'default_category' );

	foreach ( $categories as $category ) {
		if ( (int) $category->term_id === $default_id || paperia_is_placeholder_category( $category ) ) {
			continue;
		}

		return $category;
	}

	return null;
}

/**
 * Whether a category is an empty "uncategorized" bucket.
 *
 * @param WP_Term $category Category term.
 * @return bool
 */
function paperia_is_placeholder_category( $category ) {
	if ( ! $category instanceof WP_Term ) {
		return false;
	}

	$name = trim( (string) $category->name );
	$slug = (string) $category->slug;

	if ( in_array( $name, array( 'دسته‌بندی نشده', 'دسته بندی نشده', 'Uncategorized' ), true ) ) {
		return true;
	}

	return str_contains( $slug, 'uncategorized' );
}

/**
 * Plain-text card excerpt, trimmed for the blog grid.
 *
 * @param int $word_count Maximum words.
 * @return string
 */
function paperia_get_card_excerpt( $word_count = 32 ) {
	$excerpt = wp_strip_all_tags( get_the_excerpt() );
	$excerpt = preg_replace( '/[✅✔️✓☑]/u', '', $excerpt );
	$excerpt = trim( (string) $excerpt );

	if ( '' === $excerpt ) {
		return '';
	}

	return wp_trim_words( $excerpt, (int) $word_count, '…' );
}

/**
 * Estimated reading time label for a post.
 *
 * @param int $post_id Post ID. Defaults to the current post.
 * @return string Empty when the post has no readable text.
 */
function paperia_get_reading_time( $post_id = 0 ) {
	$post = get_post( $post_id );

	if ( ! $post instanceof WP_Post ) {
		return '';
	}

	$text  = trim( wp_strip_all_tags( $post->post_content ) );
	$words = preg_split( '/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY );
	$count = is_array( $words ) ? count( $words ) : 0;

	if ( $count < 1 ) {
		return '';
	}

	$minutes = max( 1, (int) ceil( $count / 180 ) );

	return sprintf(
		/* translators: %s: localized minute count. */
		__( '%s دقیقه مطالعه', 'paperia' ),
		number_format_i18n( $minutes )
	);
}

/**
 * Related posts, preferring the current post's categories.
 *
 * @param int $post_id Post to exclude.
 * @param int $limit   Number of posts.
 * @return WP_Query
 */
function paperia_get_related_posts( $post_id, $limit = 3 ) {
	$post_id    = (int) $post_id;
	$categories = wp_get_post_categories( $post_id );
	$query_args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => (int) $limit,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	if ( ! empty( $categories ) ) {
		$query_args['category__in'] = $categories;
	}

	return new WP_Query( $query_args );
}

/**
 * Drop the "Category:" / "Tag:" prefix so archive titles are just the name.
 *
 * @param string $prefix Archive title prefix.
 * @return string
 */
function paperia_archive_title_prefix( $prefix ) {
	if ( is_category() || is_tag() || is_author() ) {
		return '';
	}

	return $prefix;
}
add_filter( 'get_the_archive_title_prefix', 'paperia_archive_title_prefix' );
