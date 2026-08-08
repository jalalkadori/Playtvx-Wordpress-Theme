<?php
/**
 * Shared English blog listing loop.
 *
 * @package PlayTVX
 */
?>
<?php if ( have_posts() ) : ?>
	<div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/post-card-blog' );
		endwhile;
		?>
	</div>
	<div class="ptvx-pagination mt-12">
		<?php ptvx_posts_pagination(); ?>
	</div>
<?php else : ?>
	<div class="rounded-ptvx border border-ptvx-line bg-white p-8 text-center shadow-[0_10px_30px_rgb(8_23_44/6%)]">
		<h2 class="text-2xl"><?php esc_html_e( 'No articles found', 'playtvx' ); ?></h2>
		<p class="mx-auto max-w-140 text-ptvx-muted"><?php esc_html_e( 'Try another search or browse all IPTV setup guides and streaming tips.', 'playtvx' ); ?></p>
		<a class="<?php echo esc_attr( ptvx_ui_class( 'button' ) . ' ' . ptvx_ui_class( 'button_dark' ) ); ?>" href="<?php echo esc_url( ptvx_blog_url() ); ?>"><?php esc_html_e( 'Browse all guides', 'playtvx' ); ?></a>
	</div>
<?php endif; ?>
