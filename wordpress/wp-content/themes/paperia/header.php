<?php
/**
 * Main document header.
 *
 * Concept: get_header() in templates loads this file. Keep layout chrome here
 * (doctype, head, opening body, site header); page content stays in templates.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_scheme = paperia_get_color_scheme();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( $paperia_scheme ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'paperia' ); ?></a>

<?php get_template_part( 'template-parts/header/site', 'header' ); ?>

<main id="main" class="site-main">
