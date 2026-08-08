<?php
/** Compatible devices Flexible Content layout. */
$devices         = ptvx_lines( get_sub_field( 'items' ) );
$background_id   = (int) get_sub_field( 'background_image' );
$background_url  = $background_id ? wp_get_attachment_image_url( $background_id, 'full' ) : '';
$showcase_image  = (int) get_sub_field( 'showcase_image' );
$platform_logos  = array_filter( array_map( 'intval', (array) get_sub_field( 'platform_logos' ) ) );
?>
<section class="ptvx-devices relative isolate bg-ptvx-navy py-[clamp(4.0625rem,8vw,6.875rem)] text-white"<?php if ( $background_url ) : ?> style="--ptvx-devices-image: url('<?php echo esc_url( $background_url ); ?>');"<?php endif; ?>>
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-devices__content">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="text-white"><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-white/80"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( $showcase_image ) : ?><div class="ptvx-devices__image mx-auto mb-8.5 max-w-[41.25rem]"><?php echo wp_get_attachment_image( $showcase_image, 'large', false, array( 'class' => 'block h-auto w-full drop-shadow-[0_18px_33px_rgb(0_0_0/35%)]', 'loading' => 'lazy', 'decoding' => 'async' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?>
		<?php if ( $platform_logos ) : ?><ul class="ptvx-device-grid ptvx-device-grid--logos mx-auto grid max-w-[61.25rem] list-none grid-cols-1 gap-2.75 p-0 sm:grid-cols-2 lg:grid-cols-4"><?php foreach ( $platform_logos as $logo_id ) : $logo_url = wp_get_attachment_url( $logo_id ); if ( ! $logo_url ) { continue; } $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $logo_id ); ?><li class="flex min-h-19 items-center justify-center rounded-lg border border-white/25 bg-ptvx-navy/60 px-4.5 py-3.25 text-center text-sm font-bold text-white"><img class="block h-13 w-37.5 object-contain" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" width="150" height="52" loading="lazy"></li><?php endforeach; ?></ul><?php elseif ( $devices ) : ?><ul class="ptvx-device-grid mx-auto grid max-w-[61.25rem] list-none grid-cols-1 gap-2.75 p-0 sm:grid-cols-2 lg:grid-cols-4"><?php foreach ( $devices as $device ) : ?><li class="flex min-h-19 items-center justify-center rounded-lg border border-white/25 bg-ptvx-navy/60 px-4.5 py-3.25 text-center text-sm font-bold text-white"><?php echo esc_html( $device ); ?></li><?php endforeach; ?></ul><?php endif; ?>
		<div class="ptvx-section__cta mt-9 flex justify-center"><?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'offer' ), array( 'title' => get_sub_field( 'cta_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>
</section>
