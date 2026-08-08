<?php
/** Hero Flexible Content layout. */
$background_id  = (int) get_sub_field( 'background_image' );
$background_url = $background_id ? wp_get_attachment_image_url( $background_id, 'full' ) : '';
$payment_badges = array_filter( array_map( 'intval', (array) get_sub_field( 'payment_badges' ) ) );
$trust_points   = ptvx_lines( get_sub_field( 'trust_points' ) );
?>
<section class="ptvx-hero relative isolate grid min-h-[42rem] place-items-center overflow-hidden bg-ptvx-navy-deep text-white max-sm:min-h-162.5"<?php if ( $background_url ) : ?> style="--ptvx-hero-image: url('<?php echo esc_url( $background_url ); ?>');"<?php endif; ?>>
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-hero__content max-w-[59.375rem] py-[clamp(4rem,10vw,7.5rem)] text-center">
		<?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?> text-ptvx-gold-light"><?php the_sub_field( 'eyebrow' ); ?></p><?php endif; ?>
		<?php if ( $payment_badges ) : ?><div class="ptvx-payment-badges mx-auto mb-5 flex flex-wrap items-center justify-center gap-2" aria-label="<?php esc_attr_e( 'Accepted payment methods', 'playtvx' ); ?>"><?php foreach ( $payment_badges as $badge ) : echo wp_get_attachment_image( $badge, 'thumbnail', false, array( 'class' => 'block h-7 w-auto max-w-16.5 rounded-sm object-contain', 'loading' => 'eager' ) ); endforeach; ?></div><?php endif; ?>
		<?php if ( $trust_points ) : ?><ul class="ptvx-hero__trust mx-auto mb-5.5 flex list-none flex-wrap justify-center gap-x-5.5 gap-y-2 p-0 text-sm font-semibold text-white/90 max-sm:w-fit max-sm:flex-col max-sm:items-start"><?php foreach ( $trust_points as $point ) : ?><li><?php echo esc_html( $point ); ?></li><?php endforeach; ?></ul><?php endif; ?>
		<h1 class="mx-auto max-w-[59.375rem] text-white [text-shadow:0_3px_26px_rgb(0_0_0/22%)]"><?php the_sub_field( 'heading' ); ?></h1>
		<?php if ( get_sub_field( 'text' ) ) : ?><p class="ptvx-hero__text mx-auto mt-5.5 max-w-[44.375rem] text-[clamp(1rem,1.7vw,1.15rem)] text-white/85"><?php the_sub_field( 'text' ); ?></p><?php endif; ?>
		<div class="ptvx-actions mt-7 flex flex-wrap justify-center gap-3">
			<?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'primary_offer' ), array( 'title' => get_sub_field( 'primary_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'secondary_offer' ), array( 'title' => get_sub_field( 'secondary_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button ptvx-button--ghost' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<?php if ( have_rows( 'stats' ) ) : ?><div class="ptvx-stat-row ptvx-stat-row--hero mx-auto mt-9.5 grid max-w-[56.25rem] grid-cols-3 border-y border-white/25"><?php while ( have_rows( 'stats' ) ) : the_row(); ?><div class="grid gap-0.25 px-3 py-5.5 text-center max-sm:px-1 max-sm:py-4"><strong class="text-[clamp(1.65rem,3vw,2.25rem)] leading-[1.1] text-ptvx-gold-light max-sm:text-[1.35rem]"><?php the_sub_field( 'value' ); ?></strong><span class="text-[0.8rem] font-semibold text-white/70 uppercase max-sm:text-[0.65rem]"><?php the_sub_field( 'label' ); ?></span></div><?php endwhile; ?></div><?php endif; ?>
	</div>
</section>
