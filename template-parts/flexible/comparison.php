<?php
/** Comparison table Flexible Content layout. */
$columns = ptvx_pipe_cells( get_sub_field( 'columns' ) );
$rows    = array_map( 'ptvx_pipe_cells', ptvx_lines( get_sub_field( 'rows' ) ) );
$column_count = count( $columns );
$offer   = get_sub_field( 'offer' );
$label   = get_sub_field( 'cta_label' ) ?: __( '12 Months Subscription', 'playtvx' );
?>
<section class="<?php echo esc_attr( ptvx_ui_class( 'section' ) ); ?> bg-ptvx-surface">
	<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
		<header class="<?php echo esc_attr( ptvx_ui_class( 'section_header' ) ); ?>"><?php if ( get_sub_field( 'heading' ) ) : ?><h2><?php the_sub_field( 'heading' ); ?></h2><?php endif; ?><?php if ( get_sub_field( 'intro' ) ) : ?><p class="m-0 text-base text-ptvx-muted"><?php the_sub_field( 'intro' ); ?></p><?php endif; ?></header>
		<?php if ( $columns && $rows ) : ?><div class="ptvx-table-wrap overflow-x-auto rounded-[0.875rem] border border-ptvx-line bg-white shadow-[0_10px_30px_rgb(8_23_44/5%)]"><table class="ptvx-comparison w-full min-w-[43.125rem] border-collapse text-sm"><thead><tr><?php foreach ( $columns as $index => $column ) : ?><th scope="col"<?php echo 0 === $index ? ' class="ptvx-comparison__feature"' : ''; ?>><?php echo esc_html( $column ); ?></th><?php endforeach; ?></tr></thead><tbody><?php foreach ( $rows as $row ) : $row = array_slice( array_pad( $row, $column_count, '' ), 0, $column_count ); ?><tr><?php foreach ( $row as $index => $cell ) : ?><td<?php echo 0 === $index ? ' class="ptvx-comparison__feature"' : ''; ?>><?php echo esc_html( $cell ); ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody></table></div><?php endif; ?>
		<div class="ptvx-section__cta mt-9 flex justify-center"><?php echo ptvx_link_html( ptvx_offer_link( $offer, array( 'title' => $label ) ), 'ptvx-button' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	</div>
</section>
