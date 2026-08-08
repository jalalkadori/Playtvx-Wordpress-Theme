<?php
/**
 * English blog search results.
 *
 * @package PlayTVX
 */

if ( ptvx_is_french_site() ) {
	require get_template_directory() . '/search.php';
	return;
}

get_header();

$result_count = (int) $GLOBALS['wp_query']->found_posts;
?>
<header class="border-b border-ptvx-line bg-ptvx-surface py-[clamp(3.75rem,8vw,6.5rem)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<nav class="mb-5 flex flex-wrap items-center gap-2 text-sm font-semibold text-ptvx-muted" aria-label="<?php esc_attr_e( 'Breadcrumb', 'playtvx' ); ?>">
			<a class="no-underline hover:text-ptvx-red" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'Blog', 'playtvx' ); ?></a><span aria-hidden="true">/</span><span aria-current="page"><?php esc_html_e( 'Search', 'playtvx' ); ?></span>
		</nav>
		<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Search results', 'playtvx' ); ?></p>
		<h1 class="max-w-225 text-[clamp(2rem,4vw,3.5rem)]"><?php echo esc_html( sprintf( __( 'Results for “%s”', 'playtvx' ), get_search_query() ) ); ?></h1>
		<p class="mt-4 text-sm font-semibold text-ptvx-muted"><?php echo esc_html( sprintf( _n( '%d guide found', '%d guides found', $result_count, 'playtvx' ), $result_count ) ); ?></p>
		<form class="mt-7 flex max-w-170 gap-3 rounded-xl border border-ptvx-line bg-white p-2 shadow-[0_8px_24px_rgb(8_23_44/5%)] max-sm:flex-col" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="ptvx-results-search"><?php esc_html_e( 'Search the blog', 'playtvx' ); ?></label>
			<input id="ptvx-results-search" class="min-h-12 flex-1 rounded-lg border-0 bg-transparent px-4 text-base text-ptvx-ink outline-none placeholder:text-ptvx-muted" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search setup guides and IPTV tips…', 'playtvx' ); ?>">
			<input type="hidden" name="post_type" value="post">
			<button class="<?php echo esc_attr( ptvx_ui_class( 'button' ) ); ?> shrink-0" type="submit"><?php esc_html_e( 'Search again', 'playtvx' ); ?></button>
		</form>
	</div>
</header>

<section class="py-[clamp(3.875rem,7vw,6rem)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<?php get_template_part( 'template-parts/blog-loop' ); ?>
	</div>
</section>
<?php get_footer(); ?>
