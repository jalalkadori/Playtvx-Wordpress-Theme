<?php
/** Split features Flexible Content layout. */
$image = (int) get_sub_field( 'image' );
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> ptvx-split-section">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-split grid grid-cols-1 items-center gap-[clamp(2.125rem,6vw,5.25rem)] lg:grid-cols-[minmax(0,1fr)_minmax(20rem,0.78fr)]">
		<div class="ptvx-split__copy"><?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php the_sub_field( 'eyebrow' ); ?></p><?php endif; ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php if ( get_sub_field( 'intro' ) ) : ?><p class="text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?><?php if ( have_rows( 'items' ) ) : ?><div class="ptvx-split__features mt-7.5 grid gap-5"><?php while ( have_rows( 'items' ) ) : the_row(); ?><article class="relative pl-6.5"><h3 class="mb-1.25 text-base"><?php the_sub_field( 'title' ); ?></h3><p class="m-0 text-sm text-ptvx-muted"><?php the_sub_field( 'text' ); ?></p></article><?php endwhile; ?></div><?php endif; ?></div>
		<?php if ( $image ) : ?><div class="ptvx-split__image mx-auto max-w-[34.375rem] bg-transparent lg:max-w-none"><?php echo wp_get_attachment_image( $image, 'large', false, array( 'class' => 'block h-auto w-full', 'loading' => 'lazy', 'decoding' => 'async' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?>
	</div>
</section>
