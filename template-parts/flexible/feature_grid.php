<?php
/** Feature cards Flexible Content layout. */
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> bg-ptvx-surface">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( have_rows( 'items' ) ) : ?><div class="ptvx-feature-grid grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"><?php while ( have_rows( 'items' ) ) : the_row(); $icon = get_sub_field( 'icon' ); ?><article class="<?php echo esc_attr( ptvx_ui_class( 'card' ) ); ?> p-7"><?php if ( $icon ) : ?><?php echo wp_get_attachment_image( $icon, 'thumbnail', false, array( 'class' => 'mb-4.5 h-12 w-12 object-contain' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php endif; ?><h3><?php the_sub_field( 'title' ); ?></h3><p class="m-0 text-ptvx-muted"><?php the_sub_field( 'text' ); ?></p></article><?php endwhile; ?></div><?php endif; ?>
	</div>
</section>
