<?php
/**
 * Category navigation circles for the front page.
 *
 * Placeholder links for now; swap to product category archives via ACF later.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_categories = array(
	array(
		'label' => __( 'دفترهای فانتزی', 'paperia' ),
		'icon'  => 'icon-Notebook',
		'mod'   => 'pink',
		'url'   => home_url( '/' ),
	),
	array(
		'label' => __( 'کاغذ A4 اداری', 'paperia' ),
		'icon'  => 'icon-Files',
		'mod'   => 'blue',
		'url'   => home_url( '/' ),
	),
	array(
		'label' => __( 'کارتن و بسته بندی', 'paperia' ),
		'icon'  => 'icon-Package',
		'mod'   => 'peach',
		'url'   => home_url( '/' ),
	),
	array(
		'label' => __( 'زینک و ملزومات چاپ', 'paperia' ),
		'icon'  => 'icon-Printer',
		'mod'   => 'purple',
		'url'   => home_url( '/' ),
	),
);
?>
<section class="home-categories" aria-label="<?php esc_attr_e( 'Product categories', 'paperia' ); ?>">
	<ul class="home-categories__list">
		<?php foreach ( $paperia_categories as $paperia_category ) : ?>
			<li class="home-categories__item">
				<a class="home-categories__link" href="<?php echo esc_url( $paperia_category['url'] ); ?>">
					<span class="home-categories__circle home-categories__circle--<?php echo esc_attr( $paperia_category['mod'] ); ?>">
						<span class="<?php echo esc_attr( $paperia_category['icon'] ); ?>" aria-hidden="true"></span>
					</span>
					<span class="home-categories__label">
						<?php echo esc_html( $paperia_category['label'] ); ?>
						<span class="icon-CaretDown" aria-hidden="true"></span>
					</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
