<?php
/**
 * Posts page / blog index.
 *
 * @package PlayTVX
 */

get_header();

if ( ptvx_is_french_site() ) {
	?>
	<section class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]">
		<header class="mb-10 max-w-[50rem]"><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'PlayTVX blog', 'playtvx' ); ?></p><h1><?php esc_html_e( 'IPTV setup guides and streaming tips', 'playtvx' ); ?></h1></header>
		<?php if ( have_posts() ) : ?><div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post-card' ); endwhile; ?></div><div class="mt-10"><?php the_posts_pagination(); ?></div><?php else : ?><p><?php esc_html_e( 'No articles found.', 'playtvx' ); ?></p><?php endif; ?>
	</section>
	<?php
	get_footer();
	return;
}

$categories = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
?>
<header class="relative isolate overflow-hidden bg-ptvx-navy py-[clamp(4.25rem,9vw,7.5rem)] text-white">
	<div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_78%_12%,rgb(232_195_91/20%),transparent_30%),radial-gradient(circle_at_15%_90%,rgb(238_38_52/20%),transparent_30%)]" aria-hidden="true"></div>
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?> text-ptvx-gold-light"><?php esc_html_e( 'PlayTVX blog', 'playtvx' ); ?></p>
		<h1 class="max-w-225 text-white"><?php esc_html_e( 'IPTV setup guides and streaming tips', 'playtvx' ); ?></h1>
		<p class="mt-5 max-w-185 text-lg text-white/75"><?php esc_html_e( 'Clear tutorials, device setup advice and practical IPTV answers to help you stream with confidence.', 'playtvx' ); ?></p>
		<form class="mt-8 flex max-w-170 gap-3 rounded-xl bg-white p-2 max-sm:flex-col" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="ptvx-blog-search"><?php esc_html_e( 'Search the blog', 'playtvx' ); ?></label>
			<input id="ptvx-blog-search" class="min-h-12 flex-1 rounded-lg border-0 bg-transparent px-4 text-base text-ptvx-ink outline-none placeholder:text-ptvx-muted" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search setup guides and IPTV tips…', 'playtvx' ); ?>">
			<input type="hidden" name="post_type" value="post">
			<button class="<?php echo esc_attr( ptvx_ui_class( 'button' ) ); ?> shrink-0" type="submit"><?php esc_html_e( 'Search guides', 'playtvx' ); ?></button>
		</form>
	</div>
</header>

<section class="bg-ptvx-surface py-[clamp(3.875rem,7vw,6rem)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<div class="mb-10 flex flex-wrap items-end justify-between gap-6">
			<div>
				<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Latest articles', 'playtvx' ); ?></p>
				<h2 class="mb-0 text-[clamp(1.8rem,3vw,2.6rem)]"><?php esc_html_e( 'Guides built for easier streaming', 'playtvx' ); ?></h2>
			</div>
			<?php if ( $categories ) : ?>
				<nav class="flex flex-wrap gap-2" aria-label="<?php esc_attr_e( 'Blog categories', 'playtvx' ); ?>">
					<span class="rounded-full bg-ptvx-navy px-4 py-2 text-sm font-bold text-white"><?php esc_html_e( 'All guides', 'playtvx' ); ?></span>
					<?php foreach ( $categories as $category ) : ?>
						<a class="rounded-full border border-ptvx-line bg-white px-4 py-2 text-sm font-bold text-ptvx-navy no-underline transition hover:border-ptvx-red hover:text-ptvx-red" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
					<?php endforeach; ?>
				</nav>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'template-parts/blog-loop' ); ?>
	</div>
</section>
<?php get_footer(); ?>
