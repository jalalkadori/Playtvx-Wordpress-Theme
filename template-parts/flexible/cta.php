<?php
/** Standalone call-to-action Flexible Content layout. */
$theme = get_sub_field( 'theme' ) ?: 'navy';
$theme_classes = array(
	'navy' => 'bg-ptvx-navy text-white [&_h2]:text-white [&_p]:text-white',
	'gold' => 'bg-ptvx-gold text-ptvx-navy [&_.ptvx-button]:border-ptvx-navy [&_.ptvx-button]:bg-ptvx-navy',
	'light' => 'border border-ptvx-line bg-ptvx-surface text-ptvx-ink',
);
?>
<section class="ptvx-cta-section bg-white py-12.5"><div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>"><div class="ptvx-cta flex items-center justify-between gap-7 rounded-2xl p-[clamp(1.875rem,5vw,3.25rem)] max-sm:flex-col max-sm:items-start <?php echo esc_attr( $theme_classes[ $theme ] ?? $theme_classes['navy'] ); ?>"><div><h2 class="mb-2"><?php the_sub_field( 'heading' ); ?></h2><?php if ( get_sub_field( 'text' ) ) : ?><p class="mb-2"><?php the_sub_field( 'text' ); ?></p><?php endif; ?></div><?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'offer' ), array( 'title' => get_sub_field( 'cta_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div></div></section>
