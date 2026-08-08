<?php
/** Setup steps Flexible Content layout. */
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> ptvx-steps-section bg-white">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( have_rows( 'items' ) ) : ?><ol class="ptvx-steps grid list-none grid-cols-1 gap-6 p-0 sm:grid-cols-2 lg:grid-cols-3"><?php while ( have_rows( 'items' ) ) : the_row(); ?><li class="relative min-h-47.5 rounded-[0.875rem] border border-ptvx-line bg-white px-6.25 pt-19.75 pb-6.5 shadow-[0_10px_25px_rgb(8_23_44/5%)]"><h3><?php the_sub_field( 'title' ); ?></h3><p class="m-0 text-sm text-ptvx-muted"><?php the_sub_field( 'text' ); ?></p></li><?php endwhile; ?></ol><?php endif; ?>
		<div class="ptvx-section__cta mt-9 flex justify-center"><?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'offer' ), array( 'title' => get_sub_field( 'cta_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button ptvx-button--dark' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>
</section>
