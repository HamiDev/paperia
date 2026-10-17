<?php
/**
 * Site-wide leaf field.
 *
 * Fixed behind every page. Each leaf drifts at its own rate via a
 * CSS scroll timeline, so the layer stays decorative and click-through.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_leaf_uri = PAPERIA_URI . '/assets/images/leaves/';

$paperia_leaves = array(
	array(
		'file'   => 'sprig.webp',
		'class'  => 'leaf-parallax__item--sprig',
		'width'  => 272,
		'height' => 358,
	),
	array(
		'file'   => 'branch.webp',
		'class'  => 'leaf-parallax__item--branch',
		'width'  => 335,
		'height' => 424,
	),
	array(
		'file'   => 'fern.webp',
		'class'  => 'leaf-parallax__item--fern',
		'width'  => 373,
		'height' => 399,
	),
	array(
		'file'   => 'cluster.webp',
		'class'  => 'leaf-parallax__item--cluster',
		'width'  => 387,
		'height' => 509,
	),
	array(
		'file'   => 'sprig.webp',
		'class'  => 'leaf-parallax__item--sprig-alt',
		'width'  => 272,
		'height' => 358,
	),
	array(
		'file'   => 'branch.webp',
		'class'  => 'leaf-parallax__item--branch-alt',
		'width'  => 335,
		'height' => 424,
	),
	array(
		'file'   => 'fern.webp',
		'class'  => 'leaf-parallax__item--fern-alt',
		'width'  => 373,
		'height' => 399,
	),
	array(
		'file'   => 'cluster.webp',
		'class'  => 'leaf-parallax__item--cluster-alt',
		'width'  => 387,
		'height' => 509,
	),
);
?>
<div class="leaf-parallax" aria-hidden="true">
	<?php foreach ( $paperia_leaves as $paperia_leaf ) : ?>
		<img
			class="leaf-parallax__item <?php echo esc_attr( $paperia_leaf['class'] ); ?>"
			src="<?php echo esc_url( $paperia_leaf_uri . $paperia_leaf['file'] ); ?>"
			alt=""
			width="<?php echo esc_attr( (string) $paperia_leaf['width'] ); ?>"
			height="<?php echo esc_attr( (string) $paperia_leaf['height'] ); ?>"
			decoding="async"
			fetchpriority="low"
			draggable="false"
		>
	<?php endforeach; ?>
</div>
