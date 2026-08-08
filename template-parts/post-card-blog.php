<?php
/**
 * English blog/archive post card.
 *
 * @package PlayTVX
 */

$category = ptvx_primary_category();
$excerpt  = get_the_excerpt();
?>
<article <?php post_class( 'ptvx-blog-card group flex h-full flex-col overflow-hidden rounded-ptvx border border-ptvx-line bg-white shadow-[0_10px_30px_rgb(8_23_44/6%)] transition duration-200 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgb(8_23_44/12%)]' ); ?>>
	<a class="relative block aspect-[16/9] overflow-hidden bg-linear-to-br from-ptvx-navy to-ptvx-blue no-underline" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'playtvx' ), get_the_title() ) ); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'ptvx-blog-card__image h-full w-full object-cover transition duration-300 group-hover:scale-[1.035]', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-[radial-gradient(circle_at_75%_20%,rgb(232_195_91/35%),transparent_32%)] px-6 text-center text-white">
				<span class="text-xs font-extrabold tracking-[0.2em] text-ptvx-gold uppercase"><?php esc_html_e( 'PlayTVX guide', 'playtvx' ); ?></span>
				<span class="max-w-65 text-lg font-bold leading-tight"><?php the_title(); ?></span>
			</span>
		<?php endif; ?>
	</a>
	<div class="flex flex-1 flex-col p-6">
		<div class="mb-3 flex flex-wrap items-center gap-x-3 gap-y-2 text-xs font-semibold text-ptvx-muted">
			<?php if ( $category ) : ?><a class="rounded-full bg-ptvx-surface px-3 py-1 text-ptvx-red no-underline hover:bg-ptvx-red hover:text-white" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a><?php endif; ?>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-label="<?php echo esc_attr( sprintf( __( '%d minute read', 'playtvx' ), ptvx_reading_time() ) ); ?>"><?php echo esc_html( sprintf( __( '%d min read', 'playtvx' ), ptvx_reading_time() ) ); ?></span>
		</div>
		<h2 class="mb-3 text-[1.3rem] leading-[1.3]"><a class="text-inherit no-underline hover:text-ptvx-red" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if ( $excerpt ) : ?><p class="mb-5 text-sm text-ptvx-muted"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 24 ) ); ?></p><?php endif; ?>
		<a class="mt-auto inline-flex items-center gap-2 text-sm font-extrabold text-ptvx-red no-underline" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'playtvx' ); ?> <span aria-hidden="true">&rarr;</span></a>
	</div>
</article>
