<?php
/** Image-backed call to action layout. */
$background_id  = (int) get_sub_field( 'background_image' );
$background_url = $background_id ? wp_get_attachment_image_url( $background_id, 'full' ) : '';
?>
<section class="ptvx-image-cta relative isolate bg-ptvx-navy py-[clamp(4.6875rem,10vw,7.8125rem)] text-center text-white"<?php if ( $background_url ) : ?> style="--ptvx-image-cta-image: url('<?php echo esc_url( $background_url ); ?>');"<?php endif; ?>>
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>"><div class="mx-auto max-w-[49.375rem]"><h2 class="text-white"><?php the_sub_field( 'heading' ); ?></h2><?php if ( get_sub_field( 'text' ) ) : ?><p class="mb-6.5 text-white/85"><?php the_sub_field( 'text' ); ?></p><?php endif; ?><?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'offer' ), array( 'title' => get_sub_field( 'cta_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div></div>
</section>
