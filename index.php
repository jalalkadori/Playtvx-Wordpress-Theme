<?php
/**
 * Required fallback template.
 *
 * @package PlayTVX
 */

get_header();
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?>">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/post-card-blog' ); endwhile; ?>
			</div>
			<?php ptvx_posts_pagination(); ?>
		<?php else : ?>
			<h1><?php esc_html_e( 'Nothing found', 'playtvx' ); ?></h1>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
