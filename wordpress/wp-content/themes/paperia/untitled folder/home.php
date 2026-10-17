<?php
/**
 * Blog posts index (Settings → Reading → Posts page).
 *
 * @package Paperia
 */

get_header();

$paperia_post_count = paperia_get_published_post_count();
$paperia_blog_meta  = '';

if ( $paperia_post_count > 0 ) {
	$paperia_blog_meta = sprintf(
		/* translators: %s: localized published post count. */
		__( '%s نوشته', 'paperia' ),
		number_format_i18n( $paperia_post_count )
	);
}
?>

<div class="blog">
	<?php
	get_template_part(
		'template-parts/blog/header',
		null,
		array(
			'title'       => paperia_get_blog_title(),
			'description' => paperia_get_blog_description(),
			'meta'        => $paperia_blog_meta,
		)
	);
	?>

	<div class="blog__main">
		<?php get_template_part( 'template-parts/blog/loop' ); ?>
	</div>
</div>

<?php
get_footer();
