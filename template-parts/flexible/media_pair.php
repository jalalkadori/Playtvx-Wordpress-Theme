<?php
/** Paired media cards Flexible Content layout. */
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> ptvx-media-pair-section bg-ptvx-navy">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2 class="text-white"><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-white/70"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( have_rows( 'items' ) ) : ?><div class="ptvx-media-pair grid grid-cols-1 gap-6.5 sm:grid-cols-2"><?php while ( have_rows( 'items' ) ) : the_row(); $image = (int) get_sub_field( 'image' ); ?><article class="overflow-hidden rounded-ptvx bg-white/7"><?php if ( $image ) : ?><div class="ptvx-media-pair__image h-65 bg-[#112d4d] max-sm:h-57.5"><?php echo wp_get_attachment_image( $image, 'large', false, array( 'class' => 'block h-full w-full object-cover', 'loading' => 'lazy', 'decoding' => 'async' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?><div class="px-7 pt-6.75 pb-7.5"><h3 class="text-ptvx-gold-light"><?php the_sub_field( 'title' ); ?></h3><p class="m-0 text-white/75"><?php the_sub_field( 'text' ); ?></p></div></article><?php endwhile; ?></div><?php endif; ?>
	</div>
</section>
