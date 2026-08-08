<?php
/** Native post card. */
?>
<article <?php post_class( ptvx_ui_class( 'card' ) . ' flex h-full flex-col overflow-hidden' ); ?>>
	<a class="block h-55 bg-ptvx-surface" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large', array( 'class' => 'ptvx-post-card__image block h-full w-full object-cover' ) ); } ?></a>
	<div class="flex flex-1 flex-col p-6"><p class="mb-2 text-sm text-ptvx-muted"><?php echo esc_html( get_the_date() ); ?></p><h2 class="text-[1.35rem]"><a class="text-inherit no-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p><a class="mt-auto font-extrabold text-ptvx-red" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'playtvx' ); ?></a></div>
</article>
