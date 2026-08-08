<?php
/**
 * Category, tag, author and date archives.
 *
 * @package PlayTVX
 */

get_header();

if ( ptvx_is_french_site() ) {
	?>
	<section class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]">
		<header class="mb-10 max-w-[50rem]"><p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Guides and tips', 'playtvx' ); ?></p><?php the_archive_title( '<h1>', '</h1>' ); ?><?php the_archive_description( '<div class="ptvx-rich-text">', '</div>' ); ?></header>
		<?php if ( have_posts() ) : ?><div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"><?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post-card' ); endwhile; ?></div><div class="mt-10"><?php the_posts_pagination(); ?></div><?php else : ?><p><?php esc_html_e( 'No articles found.', 'playtvx' ); ?></p><?php endif; ?>
	</section>
	<?php
	get_footer();
	return;
}

$archive_description = get_the_archive_description();
$result_count        = (int) $GLOBALS['wp_query']->found_posts;
?>
<header class="border-b border-ptvx-line bg-ptvx-surface py-[clamp(3.75rem,8vw,6.5rem)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<nav class="mb-5 flex flex-wrap items-center gap-2 text-sm font-semibold text-ptvx-muted" aria-label="<?php esc_attr_e( 'Breadcrumb', 'playtvx' ); ?>">
			<a class="no-underline hover:text-ptvx-red" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'Blog', 'playtvx' ); ?></a><span aria-hidden="true">/</span><span aria-current="page"><?php esc_html_e( 'Archive', 'playtvx' ); ?></span>
		</nav>
		<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'Browse the knowledge base', 'playtvx' ); ?></p>
		<h1 class="max-w-225"><?php echo esc_html( ptvx_archive_title() ); ?></h1>
		<?php if ( $archive_description ) : ?><div class="ptvx-rich-text mt-4 max-w-185 text-lg text-ptvx-muted"><?php echo wp_kses_post( $archive_description ); ?></div><?php endif; ?>
		<p class="mt-5 text-sm font-semibold text-ptvx-muted"><?php echo esc_html( sprintf( _n( '%d published guide', '%d published guides', $result_count, 'playtvx' ), $result_count ) ); ?></p>
	</div>
</header>

<section class="py-[clamp(3.875rem,7vw,6rem)]">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<?php get_template_part( 'template-parts/blog-loop' ); ?>
	</div>
</section>
<?php get_footer(); ?>
