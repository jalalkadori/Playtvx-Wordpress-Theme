<?php
/** Rich text Flexible Content layout. */
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?>"><div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-prose max-w-[50rem]"><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><div class="ptvx-rich-text"><?php the_sub_field( 'content' ); ?></div><?php echo ptvx_link_html( get_sub_field( 'cta' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div></section>
