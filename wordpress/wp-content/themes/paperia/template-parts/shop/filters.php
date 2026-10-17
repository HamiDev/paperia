<?php
/**
 * Shop filter sidebar: categories, price, and sale products.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_categories = paperia_get_shop_categories();
$paperia_bounds     = paperia_get_shop_price_bounds();
$paperia_min        = paperia_shop_request_price( 'min_price' );
$paperia_max        = paperia_shop_request_price( 'max_price' );
$paperia_on_sale    = paperia_shop_on_sale_requested();
$paperia_filtered   = paperia_shop_filters_are_active();
$paperia_count      = paperia_shop_active_filter_count();
$paperia_current_id = is_product_category() ? (int) get_queried_object_id() : 0;
$paperia_shop_url   = paperia_shop_catalog_url();
?>
<aside class="shop-filters" aria-label="<?php esc_attr_e( 'فیلتر محصولات', 'paperia' ); ?>">
	<details class="shop-filters__details"<?php echo $paperia_filtered ? ' open' : ''; ?>>
		<summary class="shop-filters__summary">
			<span class="icon-Faders" aria-hidden="true"></span>
			<?php esc_html_e( 'فیلترها', 'paperia' ); ?>
			<?php if ( $paperia_count > 0 ) : ?>
				<span class="shop-filters__count"><?php echo esc_html( (string) $paperia_count ); ?></span>
			<?php endif; ?>
		</summary>

		<div class="shop-filters__panel">
			<h2 class="shop-filters__title"><?php esc_html_e( 'فیلترها', 'paperia' ); ?></h2>

			<?php if ( ! empty( $paperia_categories ) ) : ?>
				<section class="shop-filters__section" aria-labelledby="shop-filter-categories">
					<h3 id="shop-filter-categories" class="shop-filters__heading"><?php esc_html_e( 'دسته‌بندی', 'paperia' ); ?></h3>
					<ul class="shop-filters__cats">
						<li>
							<a class="shop-filters__cat<?php echo 0 === $paperia_current_id && ! is_product_taxonomy() ? ' is-current' : ''; ?>" href="<?php echo esc_url( $paperia_shop_url ); ?>"<?php echo 0 === $paperia_current_id && ! is_product_taxonomy() ? ' aria-current="page"' : ''; ?>>
								<span><?php esc_html_e( 'همه محصولات', 'paperia' ); ?></span>
							</a>
						</li>
						<?php foreach ( $paperia_categories as $paperia_category ) : ?>
							<?php $paperia_is_current = $paperia_current_id === (int) $paperia_category->term_id; ?>
							<li>
								<a
									class="shop-filters__cat<?php echo $paperia_is_current ? ' is-current' : ''; ?>"
									href="<?php echo esc_url( paperia_shop_catalog_url( $paperia_category ) ); ?>"
									<?php echo $paperia_is_current ? 'aria-current="page"' : ''; ?>
								>
									<span><?php echo esc_html( $paperia_category->name ); ?></span>
									<span class="shop-filters__cat-count"><?php echo esc_html( (string) $paperia_category->count ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endif; ?>

			<form class="shop-filters__form" method="get" action="<?php echo esc_url( paperia_shop_filter_action_url() ); ?>">
				<section class="shop-filters__section" aria-labelledby="shop-filter-price">
					<h3 id="shop-filter-price" class="shop-filters__heading"><?php esc_html_e( 'قیمت', 'paperia' ); ?></h3>
					<div class="shop-filters__prices">
						<label class="shop-filters__field">
							<span class="shop-filters__label"><?php esc_html_e( 'از', 'paperia' ); ?></span>
							<input
								class="input-text"
								type="number"
								name="min_price"
								inputmode="numeric"
								min="0"
								step="1"
								placeholder="<?php echo esc_attr( number_format_i18n( $paperia_bounds['min'], 0 ) ); ?>"
								<?php echo '' !== $paperia_min ? 'value="' . esc_attr( $paperia_min ) . '"' : ''; ?>
							>
						</label>
						<label class="shop-filters__field">
							<span class="shop-filters__label"><?php esc_html_e( 'تا', 'paperia' ); ?></span>
							<input
								class="input-text"
								type="number"
								name="max_price"
								inputmode="numeric"
								min="0"
								step="1"
								placeholder="<?php echo esc_attr( number_format_i18n( $paperia_bounds['max'], 0 ) ); ?>"
								<?php echo '' !== $paperia_max ? 'value="' . esc_attr( $paperia_max ) . '"' : ''; ?>
							>
						</label>
					</div>
				</section>

				<section class="shop-filters__section">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox shop-filters__sale">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="onsale" value="1" <?php checked( $paperia_on_sale ); ?>>
						<span><?php esc_html_e( 'فقط کالاهای تخفیف‌دار', 'paperia' ); ?></span>
					</label>
				</section>

				<?php
				wc_query_string_form_fields(
					null,
					array( 'min_price', 'max_price', 'onsale', 'submit', 'paged', 'product-page', 'add-to-cart' )
				);
				?>

				<button class="button shop-filters__apply" type="submit"><?php esc_html_e( 'اعمال فیلتر', 'paperia' ); ?></button>

				<?php if ( $paperia_filtered ) : ?>
					<a class="shop-filters__clear" href="<?php echo esc_url( paperia_shop_clear_filters_url() ); ?>">
						<?php esc_html_e( 'پاک کردن فیلترها', 'paperia' ); ?>
					</a>
				<?php endif; ?>
			</form>
		</div>
	</details>
</aside>
