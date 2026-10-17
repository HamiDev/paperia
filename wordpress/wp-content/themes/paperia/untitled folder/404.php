<?php
/**
 * 404 template.
 *
 * @package Paperia
 */

get_header();
?>

<div class="container">
	<section class="error-404">
		<h1 class="error-404__title"><?php esc_html_e( 'Page not found', 'paperia' ); ?></h1>
		<p><?php esc_html_e( 'The page you requested could not be found.', 'paperia' ); ?></p>
		<p>
			<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Back to home', 'paperia' ); ?>
			</a>
		</p>
	</section>
</div>

<?php
get_footer();
