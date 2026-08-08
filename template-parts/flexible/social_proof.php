<?php
/** Screenshot-based social proof layout. */
$reviews = array_filter( array_map( 'intval', (array) get_sub_field( 'reviews' ) ) );
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> ptvx-social-proof border-t border-ptvx-line bg-ptvx-surface">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( have_rows( 'stats' ) ) : ?><div class="ptvx-stat-row mx-auto grid max-w-[56.25rem] grid-cols-3 border-y border-ptvx-line"><?php while ( have_rows( 'stats' ) ) : the_row(); ?><div class="grid gap-0.25 px-3 py-5.5 text-center max-sm:px-1 max-sm:py-4"><strong class="text-[clamp(1.65rem,3vw,2.25rem)] leading-[1.1] text-ptvx-red max-sm:text-[1.35rem]"><?php the_sub_field( 'value' ); ?></strong><span class="text-[0.8rem] font-semibold text-ptvx-muted uppercase max-sm:text-[0.65rem]"><?php the_sub_field( 'label' ); ?></span></div><?php endwhile; ?></div><?php endif; ?>
		<?php if ( $reviews ) : ?><div class="ptvx-review-gallery mt-10.5 grid grid-cols-1 gap-5.75 sm:grid-cols-3"><?php foreach ( $reviews as $review ) : ?><figure class="m-0 overflow-hidden rounded-[0.8125rem] border border-ptvx-line bg-white shadow-ptvx"><?php echo wp_get_attachment_image( $review, 'large', false, array( 'class' => 'block h-auto w-full object-contain', 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></figure><?php endforeach; ?></div><?php endif; ?>
		<div class="ptvx-section__cta mt-9 flex justify-center"><?php echo ptvx_link_html( ptvx_offer_link( get_sub_field( 'offer' ), array( 'title' => get_sub_field( 'cta_label' ) ?: ptvx_label( 'view_plans' ) ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>
</section>
