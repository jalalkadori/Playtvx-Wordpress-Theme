<?php
/** FAQ Flexible Content layout. */
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> ptvx-faq-section">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> ptvx-prose max-w-[50rem]">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'eyebrow' ) ) : ?><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php the_sub_field( 'eyebrow' ); ?></p><?php endif; ?><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?></header>
		<?php if ( have_rows( 'items' ) ) : ?><div class="ptvx-faq grid gap-3"><?php while ( have_rows( 'items' ) ) : the_row(); ?><details class="rounded-lg border border-ptvx-line bg-white px-5"><summary class="relative cursor-pointer py-4.5 pr-7.5 font-bold text-ptvx-navy"><?php the_sub_field( 'question' ); ?></summary><div class="ptvx-rich-text pb-4.5 text-ptvx-muted"><?php the_sub_field( 'answer' ); ?></div></details><?php endwhile; ?></div><?php endif; ?>
	</div>
</section>
