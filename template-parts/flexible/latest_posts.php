<?php
/** Latest posts Flexible Content layout. */

$posts_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
$blog_page   = (int) get_option( 'page_for_posts' );
$slider_id   = wp_unique_id( 'ptvx-post-slider-' );
$heading_id  = $slider_id . '-heading';
$post_total  = (int) $posts_query->post_count;
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> bg-ptvx-surface">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>">
			<?php if ( get_sub_field( 'heading' ) ) : ?><h2 id="<?php echo esc_attr( $heading_id ); ?>"><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?>
			<?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?>
		</header>

		<?php if ( $posts_query->have_posts() ) : ?>
			<div class="ptvx-post-slider relative" data-ptvx-post-slider>
				<div class="ptvx-post-slider__controls mb-6 flex items-center justify-end gap-3" aria-label="<?php esc_attr_e( 'Blog slider controls', 'playtvx' ); ?>">
					<button class="inline-flex h-10.5 w-10.5 items-center justify-center rounded-lg border border-ptvx-navy bg-white text-xl font-bold text-ptvx-navy transition hover:bg-ptvx-navy hover:text-white disabled:cursor-not-allowed disabled:opacity-35" type="button" data-ptvx-slider-prev aria-controls="<?php echo esc_attr( $slider_id ); ?>" aria-label="<?php esc_attr_e( 'Previous posts', 'playtvx' ); ?>">&#8592;</button>
					<button class="inline-flex h-10.5 w-10.5 items-center justify-center rounded-lg border border-ptvx-navy bg-ptvx-navy text-xl font-bold text-white transition hover:bg-[#112e54] disabled:cursor-not-allowed disabled:opacity-35" type="button" data-ptvx-slider-next aria-controls="<?php echo esc_attr( $slider_id ); ?>" aria-label="<?php esc_attr_e( 'Next posts', 'playtvx' ); ?>">&#8594;</button>
				</div>
				<div id="<?php echo esc_attr( $slider_id ); ?>" class="ptvx-post-slider__viewport flex snap-x snap-mandatory gap-6 overflow-x-auto pb-4" data-ptvx-slider-viewport role="region" aria-roledescription="carousel"<?php if ( get_sub_field( 'heading' ) ) : ?> aria-labelledby="<?php echo esc_attr( $heading_id ); ?>"<?php else : ?> aria-label="<?php esc_attr_e( 'Latest blog posts', 'playtvx' ); ?>"<?php endif; ?> tabindex="0">
					<?php $post_position = 0; ?>
					<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); $post_position++; ?>
						<div class="ptvx-post-slide w-full shrink-0 snap-start sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)]" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( __( '%1$d of %2$d', 'playtvx' ), $post_position, $post_total ) ); ?>">
							<?php get_template_part( 'template-parts/post-card' ); ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php if ( $blog_page && get_sub_field( 'cta_label' ) ) : ?><div class="mt-9 flex justify-center"><a class="<?php echo esc_attr( ptvx_ui_class( 'button' ) . ' ' . ptvx_ui_class( 'button_dark' ) ); ?>" href="<?php echo esc_url( get_permalink( $blog_page ) ); ?>"><?php the_sub_field( 'cta_label' ); ?></a></div><?php endif; ?>
	</div>
</section>
