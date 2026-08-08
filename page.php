<?php
/** Native page template with ACF Flexible Content support. */
get_header();

while ( have_posts() ) :
	the_post();
	$is_legal_page = ! ptvx_is_french_site() && is_page( array( 'refund_returns', 'terms-and-conditions', 'privacy-policy' ) );

	if ( $is_legal_page ) {
		$legal_image_id = (int) ptvx_option( 'legal_hero_background', 193 );
		$legal_image    = wp_get_attachment_image_url( $legal_image_id, 'full' );
		$legal_style    = $legal_image ? '--ptvx-legal-image:url(' . esc_url_raw( $legal_image ) . ');' : '';
		?>
		<header class="ptvx-legal-hero relative isolate overflow-hidden py-[clamp(4.5rem,9vw,7.5rem)] text-white" style="<?php echo esc_attr( $legal_style ); ?>">
			<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
				<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?> text-ptvx-gold-light"><?php esc_html_e( 'PlayTVX information', 'playtvx' ); ?></p>
				<h1 class="max-w-225 text-white"><?php the_title(); ?></h1>
			</div>
		</header>
		<?php
		ptvx_render_page_sections();
		continue;
	}

	if ( function_exists( 'have_rows' ) && have_rows( 'page_sections' ) ) {
		$sections = (array) get_field( 'page_sections' );
		$has_hero = false;

		foreach ( $sections as $section ) {
			if ( 'hero' === ( $section['acf_fc_layout'] ?? '' ) ) {
				$has_hero = true;
				break;
			}
		}

		if ( ! ptvx_is_french_site() && ! $has_hero ) {
			?>
			<header class="border-b border-ptvx-line bg-ptvx-surface py-[clamp(3.75rem,8vw,6.5rem)]">
				<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
					<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'PlayTVX information', 'playtvx' ); ?></p>
					<h1 class="max-w-225"><?php the_title(); ?></h1>
				</div>
			</header>
			<?php
		}

		ptvx_render_page_sections();
	} elseif ( ptvx_is_french_site() ) {
		?>
		<article class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]">
			<header class="mb-10 max-w-[50rem]"><h1><?php the_title(); ?></h1></header>
			<div class="ptvx-rich-text max-w-[47.5rem]"><?php the_content(); ?></div>
		</article>
		<?php
	} else {
		?>
		<header class="border-b border-ptvx-line bg-ptvx-surface py-[clamp(3.75rem,8vw,6.5rem)]">
			<div class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?>">
				<p class="<?php echo esc_attr( ptvx_ui_class( 'eyebrow' ) ); ?>"><?php esc_html_e( 'PlayTVX', 'playtvx' ); ?></p>
				<h1 class="max-w-225"><?php the_title(); ?></h1>
			</div>
		</header>
		<article class="<?php echo esc_attr( ptvx_ui_class( 'container' ) ); ?> py-[clamp(3.5rem,8vw,6rem)]">
			<div class="ptvx-rich-text max-w-[50rem] text-[1.05rem]"><?php the_content(); ?></div>
		</article>
		<?php
	}
endwhile;

get_footer();
