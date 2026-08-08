<?php
/**
 * Theme footer.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

$logo_id        = (int) ptvx_option( 'logo', get_theme_mod( 'custom_logo' ) );
$footer_summary = ptvx_option( 'footer_summary' );
$support_email  = ptvx_option( 'support_email' );
$whatsapp_link  = ptvx_option( 'whatsapp_link', 'https://wa.me/212613406005' );
$facebook_link  = ptvx_option( 'facebook_link' );
$instagram_link = ptvx_option( 'instagram_link' );
?>
</main>
<a class="ptvx-whatsapp-float" href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ptvx_label( 'whatsapp_contact' ) ); ?>">
	<svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16.04 3a12.84 12.84 0 0 0-11.1 19.3L3 29l6.87-1.8A12.9 12.9 0 1 0 16.04 3Zm0 23.57c-1.9 0-3.75-.51-5.36-1.47l-.38-.23-4.08 1.07 1.09-3.98-.25-.4a10.64 10.64 0 1 1 8.98 5.01Zm5.84-7.96c-.32-.16-1.9-.94-2.2-1.05-.29-.11-.5-.16-.72.16-.21.32-.82 1.05-1.01 1.26-.19.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.59a9.65 9.65 0 0 1-1.78-2.21c-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.56.16-.18.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.72-1.73-.98-2.37-.26-.62-.52-.54-.72-.55h-.61c-.21 0-.56.08-.85.4-.29.32-1.11 1.08-1.11 2.64s1.14 3.07 1.3 3.28c.16.21 2.24 3.42 5.43 4.8.76.33 1.35.52 1.81.67.76.24 1.45.21 2 .13.61-.09 1.9-.78 2.17-1.53.27-.75.27-1.4.19-1.53-.08-.13-.29-.21-.61-.37Z"/></svg>
	<span class="ptvx-whatsapp-float__label"><?php echo esc_html( ptvx_label( 'whatsapp_contact' ) ); ?></span>
</a>
<footer class="ptvx-footer bg-ptvx-navy-deep pt-16.5 text-white/75">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-footer__grid grid grid-cols-[1.45fr_0.8fr_0.8fr] gap-11.5 pb-12 lg:grid-cols-[1.45fr_0.8fr_0.8fr] max-lg:grid-cols-1">
		<div>
			<a class="ptvx-brand ptvx-brand--footer inline-flex items-center font-bold text-white no-underline" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( $logo_id ) : ?>
					<?php echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'ptvx-brand__logo block h-auto max-h-10.75 max-w-43.5 object-contain', 'alt' => get_bloginfo( 'name' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
			<?php if ( $footer_summary ) : ?>
				<p class="ptvx-footer__summary max-w-106.25"><?php echo esc_html( $footer_summary ); ?></p>
			<?php endif; ?>
		</div>
		<div>
			<h2 class="ptvx-footer__heading mb-2 text-base font-bold text-white"><?php echo esc_html( ptvx_label( 'quick_links' ) ); ?></h2>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'ptvx-footer__menu grid list-none gap-1.25 p-0', 'fallback_cb' => false ) ); ?>
		</div>
		<div>
			<h2 class="ptvx-footer__heading mb-2 text-base font-bold text-white"><?php echo esc_html( ptvx_label( 'contact' ) ); ?></h2>
			<?php if ( $support_email ) : ?><a class="mb-2 inline-block text-white no-underline hover:text-ptvx-gold-light" href="mailto:<?php echo esc_attr( antispambot( $support_email ) ); ?>"><?php echo esc_html( antispambot( $support_email ) ); ?></a><?php endif; ?>
			<?php if ( $whatsapp_link ) : ?><a class="mb-2 block text-white no-underline hover:text-ptvx-gold-light" href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a><?php endif; ?>
			<div class="ptvx-footer__socials mt-3 flex gap-3.5"><?php if ( $facebook_link ) : ?><a class="text-white no-underline hover:text-ptvx-gold-light" href="<?php echo esc_url( $facebook_link ); ?>" target="_blank" rel="noopener noreferrer">Facebook</a><?php endif; ?><?php if ( $instagram_link ) : ?><a class="text-white no-underline hover:text-ptvx-gold-light" href="<?php echo esc_url( $instagram_link ); ?>" target="_blank" rel="noopener noreferrer">Instagram</a><?php endif; ?></div>
		</div>
	</div>
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-footer__bottom border-t border-white/15 py-5 text-sm text-white/55">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
