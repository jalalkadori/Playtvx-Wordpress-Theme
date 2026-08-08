<?php
/**
 * Theme header.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

$logo_id              = (int) ptvx_option( 'logo', get_theme_mod( 'custom_logo' ) );
$announcement_messages = ptvx_lines( ptvx_option( 'announcement_messages', "25,000+ Live Channels\n90,000+ Movies & Shows\n24-Hour Trial Available" ) );
$header_cta           = ptvx_offer_link(
	ptvx_option( 'header_cta_offer', 'yearly' ),
	array( 'title' => ptvx_option( 'header_cta_label', __( 'Subscribe Now', 'playtvx' ) ) )
);
$is_french            = ptvx_is_french_site();
$language_url         = get_site_url( $is_french ? 1 : 2, '/' );
$language_code        = $is_french ? 'en' : 'fr';
$language_flag        = $is_french ? '&#127468;&#127463;' : '&#127467;&#127479;';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'ptvx-site' ); ?>>
<?php wp_body_open(); ?>
<a class="ptvx-skip-link fixed top-3 left-3 z-100 -translate-y-[150%] bg-ptvx-gold px-3.5 py-2.5 text-ptvx-navy focus:translate-y-0" href="#main-content"><?php echo esc_html( ptvx_label( 'skip_content' ) ); ?></a>
<?php if ( $announcement_messages ) : ?>
	<div class="ptvx-announcement relative z-40 overflow-hidden bg-ptvx-red text-[0.77rem] leading-8.5 font-semibold tracking-[0.01em] whitespace-nowrap text-white max-sm:text-[0.71rem] max-sm:leading-7.75" aria-label="<?php esc_attr_e( 'Service highlights', 'playtvx' ); ?>">
		<div class="ptvx-announcement__track flex w-max">
			<?php for ( $set = 0; $set < 2; $set++ ) : ?>
				<div class="ptvx-announcement__group"<?php echo 1 === $set ? ' aria-hidden="true"' : ''; ?>>
					<?php foreach ( $announcement_messages as $message ) : ?><span class="mr-11 inline-flex items-center gap-1.75"><i class="text-ptvx-gold-light not-italic" aria-hidden="true">&#10003;</i><?php echo esc_html( $message ); ?></span><?php endforeach; ?>
				</div>
			<?php endfor; ?>
		</div>
	</div>
<?php endif; ?>
<header class="ptvx-header sticky top-0 z-30 border-b border-white/10 bg-ptvx-navy text-white shadow-[0_5px_16px_rgb(3_10_24/16%)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-header__inner flex min-h-19 items-center gap-6.5 max-sm:min-h-16.5 max-sm:gap-3.25">
		<a class="ptvx-brand inline-flex shrink-0 items-center font-bold text-white no-underline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( $logo_id ) {
				echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'ptvx-brand__logo block object-contain', 'alt' => get_bloginfo( 'name' ), 'loading' => 'eager', 'decoding' => 'async' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				bloginfo( 'name' );
			}
			?>
		</a>
		<button class="ptvx-menu-toggle order-3 ml-0 flex h-10.5 w-10.5 flex-col items-center justify-center rounded-lg border border-white/40 bg-transparent text-white lg:hidden" type="button" aria-expanded="false" aria-controls="ptvx-primary-navigation"><span class="screen-reader-text"><?php echo esc_html( ptvx_label( 'toggle_menu' ) ); ?></span><span class="mx-auto my-1 block h-0.5 w-4.75 bg-current"></span><span class="mx-auto my-1 block h-0.5 w-4.75 bg-current"></span><span class="mx-auto my-1 block h-0.5 w-4.75 bg-current"></span></button>
		<nav id="ptvx-primary-navigation" class="ptvx-navigation absolute top-[calc(100%+1px)] right-0 left-0 border-b border-white/15 bg-ptvx-navy p-5 lg:static lg:ml-auto lg:block lg:border-0 lg:p-0" aria-label="<?php echo esc_attr( ptvx_label( 'primary_nav' ) ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'ptvx-navigation__list m-0 mx-auto flex w-[calc(100%-2.5rem)] max-w-ptvx list-none flex-col items-start gap-4 p-0 lg:w-auto lg:flex-row lg:items-center lg:gap-7',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
		<a class="ptvx-language order-2 ml-auto inline-flex h-7 w-7 items-center justify-center text-base no-underline lg:order-none lg:ml-0" href="<?php echo esc_url( $language_url ); ?>" lang="<?php echo esc_attr( $language_code ); ?>"><span aria-hidden="true"><?php echo $language_flag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span class="screen-reader-text"><?php echo esc_html( ptvx_label( $is_french ? 'english_site' : 'french_site' ) ); ?></span></a>
		<?php echo ptvx_link_html( $header_cta, 'ptvx-header__cta max-sm:hidden' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</header>
<main id="main-content" class="ptvx-main">
