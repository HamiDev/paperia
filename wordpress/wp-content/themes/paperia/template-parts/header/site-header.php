<?php
/**
 * Site header chrome (logo, nav, theme toggle).
 *
 * Loaded via: get_template_part( 'template-parts/header/site', 'header' );
 * which resolves to this file: site-header.php
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="site-header" role="banner">
	<div class="site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'paperia' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<button
			type="button"
			class="theme-toggle"
			data-theme-toggle
			aria-label="<?php esc_attr_e( 'Toggle color theme', 'paperia' ); ?>"
		>
			<span class="theme-toggle__label"><?php esc_html_e( 'Theme', 'paperia' ); ?></span>
		</button>
	</div>
</header>
