<?php
/**
 * Single post template.
 *
 * @package PlayTVX
 */

get_header();

if ( ptvx_is_french_site() ) {
	while ( have_posts() ) :
		the_post();
		?>
		<article class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]">
			<header class="mb-10 max-w-[50rem]"><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php echo esc_html( wp_strip_all_tags( get_the_category_list( ', ' ) ) ); ?></p><h1><?php the_title(); ?></h1><p class="text-sm text-ptvx-muted"><?php echo esc_html( get_the_date() ); ?></p></header>
			<?php if ( has_post_thumbnail() ) : ?><div class="mb-9 overflow-hidden rounded-ptvx"><?php the_post_thumbnail( 'large', array( 'class' => 'h-auto w-full' ) ); ?></div><?php endif; ?>
			<div class="ptvx-rich-text max-w-[47.5rem] text-[1.05rem]"><?php the_content(); ?></div>
		</article>
		<?php
	endwhile;
	get_footer();
	return;
}

while ( have_posts() ) :
	the_post();

	$post_id      = get_the_ID();
	$category     = ptvx_primary_category();
	$category_ids = wp_get_post_categories( $post_id );
	$yearly_link  = ptvx_offer_link(
		'yearly',
		array(
			'url'   => home_url( '/iptv-subscription/' ),
			'title' => __( 'View the 12-month plan', 'playtvx' ),
		)
	);
	?>
	<article <?php post_class( 'ptvx-single-post bg-white' ); ?>>
		<header class="relative isolate overflow-hidden bg-ptvx-navy py-[clamp(3.75rem,8vw,6.75rem)] text-white">
			<div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_82%_12%,rgb(232_195_91/19%),transparent_30%),radial-gradient(circle_at_8%_92%,rgb(238_38_52/18%),transparent_32%)]" aria-hidden="true"></div>
			<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
				<nav class="mb-6 flex flex-wrap items-center gap-2 text-sm font-semibold text-white/65" aria-label="<?php esc_attr_e( 'Breadcrumb', 'playtvx' ); ?>">
					<a class="no-underline hover:text-ptvx-gold-light" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'Blog', 'playtvx' ); ?></a>
					<?php if ( $category ) : ?><span aria-hidden="true">/</span><a class="no-underline hover:text-ptvx-gold-light" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a><?php endif; ?>
			</nav>
			<?php if ( $category ) : ?><a class="mb-4 inline-flex rounded-full bg-white/10 px-3.5 py-1.5 text-xs font-extrabold tracking-[0.08em] text-ptvx-gold-light uppercase no-underline hover:bg-white/15" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a><?php endif; ?>
			<h1 class="max-w-250 text-[clamp(2.25rem,5vw,4.25rem)] text-white"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?><p class="mt-5 max-w-210 text-lg text-white/75"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			<div class="mt-7 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm font-semibold text-white/65">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<span><?php echo esc_html( sprintf( __( '%d minute read', 'playtvx' ), ptvx_reading_time() ) ); ?></span>
				<span><?php echo esc_html( sprintf( __( 'Updated %s', 'playtvx' ), get_the_modified_date() ) ); ?></span>
			</div>
		</div>
		</header>

		<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3rem,7vw,5.75rem)]">
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="mb-12 overflow-hidden rounded-ptvx bg-ptvx-surface shadow-ptvx">
					<?php the_post_thumbnail( 'full', array( 'class' => 'block h-auto w-full', 'loading' => 'eager' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="grid grid-cols-[minmax(0,1fr)_17.5rem] items-start gap-[clamp(2.5rem,6vw,5.5rem)] max-lg:grid-cols-1">
				<div>
					<div class="ptvx-article-content ptvx-rich-text text-[1.0625rem] leading-[1.8]">
						<?php echo ptvx_single_post_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
					wp_link_pages(
						array(
							'before' => '<nav class="ptvx-page-links mt-8" aria-label="' . esc_attr__( 'Article pages', 'playtvx' ) . '">',
							'after'  => '</nav>',
						)
					);
					?>
					<?php $tags = get_the_tags(); ?>
					<?php if ( $tags ) : ?>
						<div class="mt-10 flex flex-wrap items-center gap-2 border-t border-ptvx-line pt-7" aria-label="<?php esc_attr_e( 'Article tags', 'playtvx' ); ?>">
							<span class="mr-1 text-sm font-extrabold text-ptvx-navy"><?php esc_html_e( 'Topics:', 'playtvx' ); ?></span>
							<?php foreach ( $tags as $tag ) : ?><a class="rounded-full bg-ptvx-surface px-3.5 py-1.5 text-xs font-bold text-ptvx-muted no-underline hover:bg-ptvx-navy hover:text-white" href="<?php echo esc_url( get_tag_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a><?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<aside class="sticky top-28 grid gap-5 max-lg:static" aria-label="<?php esc_attr_e( 'Article resources', 'playtvx' ); ?>">
					<div class="rounded-ptvx border border-ptvx-line bg-ptvx-surface p-6">
						<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Keep learning', 'playtvx' ); ?></p>
						<h2 class="text-xl"><?php esc_html_e( 'Explore IPTV guides', 'playtvx' ); ?></h2>
						<p class="text-sm text-ptvx-muted"><?php esc_html_e( 'Browse setup tutorials, player comparisons and streaming advice.', 'playtvx' ); ?></p>
						<a class="text-sm font-extrabold text-ptvx-red no-underline" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'View all articles', 'playtvx' ); ?> &rarr;</a>
					</div>
					<div class="rounded-ptvx bg-ptvx-navy p-6 text-white shadow-[0_16px_38px_rgb(8_23_44/18%)]">
						<p class="mb-2 text-xs font-extrabold tracking-[0.13em] text-ptvx-gold-light uppercase"><?php esc_html_e( 'Ready to stream?', 'playtvx' ); ?></p>
						<h2 class="text-xl text-white"><?php esc_html_e( 'Get the 12-month plan', 'playtvx' ); ?></h2>
						<p class="text-sm text-white/70"><?php esc_html_e( 'Access live channels, sports, movies and setup support on your devices.', 'playtvx' ); ?></p>
						<?php echo ptvx_link_html( $yearly_link, 'w-full' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</aside>
			</div>

			<nav class="mt-14 grid grid-cols-2 gap-5 border-t border-ptvx-line pt-9 max-sm:grid-cols-1" aria-label="<?php esc_attr_e( 'Previous and next articles', 'playtvx' ); ?>">
				<div class="ptvx-post-navigation ptvx-post-navigation--previous"><?php previous_post_link( '%link', '<span class="block text-xs font-bold tracking-[0.08em] text-ptvx-muted uppercase">' . esc_html__( 'Previous article', 'playtvx' ) . '</span><span class="mt-1 block font-bold text-ptvx-navy">%title</span>' ); ?></div>
				<div class="ptvx-post-navigation ptvx-post-navigation--next text-right max-sm:text-left"><?php next_post_link( '%link', '<span class="block text-xs font-bold tracking-[0.08em] text-ptvx-muted uppercase">' . esc_html__( 'Next article', 'playtvx' ) . '</span><span class="mt-1 block font-bold text-ptvx-navy">%title</span>' ); ?></div>
			</nav>
		</div>
	</article>

	<?php
	$related_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'post__not_in'        => array( $post_id ),
			'category__in'        => $category_ids,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	?>
	<?php if ( $related_query->have_posts() ) : ?>
		<section class="border-t border-ptvx-line bg-ptvx-surface py-[clamp(3.875rem,7vw,6rem)]">
			<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
				<header class="mb-9 flex items-end justify-between gap-6 max-sm:block">
					<div><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Continue reading', 'playtvx' ); ?></p><h2 class="mb-0 text-[clamp(1.8rem,3vw,2.6rem)]"><?php esc_html_e( 'Related IPTV guides', 'playtvx' ); ?></h2></div>
					<a class="text-sm font-extrabold text-ptvx-red no-underline max-sm:mt-3 max-sm:inline-flex" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'View all articles', 'playtvx' ); ?> &rarr;</a>
				</header>
				<div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); get_template_part( 'template-parts/post-card-blog' ); endwhile; ?>
				</div>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
