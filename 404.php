<?php
/**
 * 404 template.
 *
 * @package PlayTVX
 */

get_header();

if ( ptvx_is_french_site() ) {
	?>
	<section class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]"><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>">404</p><h1><?php esc_html_e( 'Page not found', 'playtvx' ); ?></h1><p><?php esc_html_e( 'The page you requested is unavailable. Try the blog or return home.', 'playtvx' ); ?></p><a class="<?php echo esc_attr( ptvx_ui_class( 'button' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'playtvx' ); ?></a></section>
	<?php
} else {
	?>
	<section class="relative isolate overflow-hidden bg-ptvx-navy py-[clamp(5rem,12vw,9rem)] text-center text-white">
		<div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_50%_25%,rgb(232_195_91/22%),transparent_28%),radial-gradient(circle_at_15%_90%,rgb(238_38_52/20%),transparent_28%)]" aria-hidden="true"></div>
		<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
			<p class="mb-3 text-sm font-extrabold tracking-[0.2em] text-ptvx-gold-light uppercase">404</p>
			<h1 class="text-white"><?php esc_html_e( 'This page is off the air', 'playtvx' ); ?></h1>
			<p class="mx-auto mt-4 max-w-150 text-lg text-white/70"><?php esc_html_e( 'The address may have changed, but the latest IPTV setup guides and subscription options are still available.', 'playtvx' ); ?></p>
			<div class="mt-8 flex flex-wrap justify-center gap-3">
				<a class="<?php echo esc_attr( ptvx_ui_class( 'button' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'playtvx' ); ?></a>
				<a class="<?php echo esc_attr( ptvx_ui_class( 'button' ) . ' ' . ptvx_ui_class( 'button_ghost' ) ); ?>" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'Browse the blog', 'playtvx' ); ?></a>
			</div>
		</div>
	</section>
	<?php
}

get_footer();
