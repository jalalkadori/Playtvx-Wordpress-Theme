<?php
/**
 * Template helpers.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether the current multisite blog is the French PlayTVX site.
 *
 * @return bool
 */
function ptvx_is_french_site() {
	return 2 === (int) get_current_blog_id() || 0 === strpos( (string) get_locale(), 'fr_' );
}

/**
 * Return a shared interface label in the active site's language.
 *
 * @param string $key Label key.
 * @return string
 */
function ptvx_label( $key ) {
	$labels = array(
		'quick_links'   => array( 'en' => 'Quick links', 'fr' => 'Liens rapides' ),
		'contact'       => array( 'en' => 'Contact', 'fr' => 'Contact' ),
		'toggle_menu'   => array( 'en' => 'Toggle navigation', 'fr' => 'Ouvrir la navigation' ),
		'skip_content'  => array( 'en' => 'Skip to content', 'fr' => 'Aller au contenu' ),
		'primary_nav'   => array( 'en' => 'Primary navigation', 'fr' => 'Navigation principale' ),
		'english_site'  => array( 'en' => 'English site', 'fr' => 'Site en anglais' ),
		'french_site'   => array( 'en' => 'French site', 'fr' => 'Site en français' ),
		'whatsapp_contact' => array( 'en' => 'Contact us on WhatsApp', 'fr' => 'Contactez-nous sur WhatsApp' ),
		'article_summary'  => array( 'en' => 'Article summary', 'fr' => 'Sommaire de l’article' ),
		'view_plans'       => array( 'en' => 'View plans', 'fr' => 'Voir les abonnements' ),
		'most_popular'     => array( 'en' => 'Most popular', 'fr' => 'Le plus populaire' ),
	);

	$language = ptvx_is_french_site() ? 'fr' : 'en';
	return $labels[ $key ][ $language ] ?? $key;
}

/**
 * Return a statically declared Tailwind class list for a shared UI primitive.
 *
 * Keeping every utility complete in this map lets Tailwind discover the
 * classes during its build while templates stay readable.
 *
 * @param string $component Component identifier.
 * @return string
 */
function ptvx_ui_class( $component ) {
	$classes = array(
		'container'      => 'ptvx-container mx-auto w-[calc(100%-2.5rem)] max-w-ptvx max-sm:w-[calc(100%-2rem)]',
		'section'        => 'ptvx-section py-[clamp(3.875rem,8vw,6.875rem)]',
		'section_header' => 'ptvx-section__header mx-auto mb-10 max-w-[51.25rem] text-center',
		'eyebrow'        => 'ptvx-eyebrow mb-3 text-xs font-extrabold tracking-[0.15em] text-ptvx-red uppercase',
		'card'           => 'rounded-ptvx border border-ptvx-line bg-white shadow-[0_8px_24px_rgb(8_23_44/5%)]',
		'button'         => 'inline-flex min-h-11.5 items-center justify-center rounded-[0.4375rem] border border-ptvx-red bg-ptvx-red px-5.5 py-3 text-center text-sm font-bold leading-[1.2] text-white no-underline shadow-[0_9px_22px_rgb(238_38_52/18%)] transition duration-200 hover:-translate-y-0.5 hover:bg-ptvx-red-dark hover:text-white hover:shadow-[0_12px_28px_rgb(238_38_52/30%)] focus-visible:outline-3 focus-visible:outline-offset-3 focus-visible:outline-ptvx-gold',
		'button_ghost'   => 'border-white/70 bg-transparent shadow-none hover:bg-white hover:text-ptvx-navy',
		'button_dark'    => 'border-ptvx-navy bg-ptvx-navy shadow-[0_10px_24px_rgb(8_23_44/18%)] hover:bg-[#112e54]',
	);

	return $classes[ $component ] ?? '';
}

/**
 * Get an ACF option without producing an error before ACF loads.
 *
 * @param string $field Field name.
 * @param mixed  $default Fallback value.
 * @return mixed
 */
function ptvx_option( $field, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $field, 'option' );
	return false !== $value && null !== $value && '' !== $value ? $value : $default;
}

/**
 * Build a safe link from an ACF Link field.
 *
 * @param array<string, mixed>|string $link Link array or URL.
 * @param string                      $class CSS classes.
 * @return string
 */
function ptvx_link_html( $link, $class = 'ptvx-button' ) {
	if ( empty( $link ) ) {
		return '';
	}

	if ( is_string( $link ) ) {
		$link = array(
			'url'    => $link,
			'title'  => __( 'Learn more', 'playtvx' ),
			'target' => '',
		);
	}

	if ( empty( $link['url'] ) ) {
		return '';
	}

	$target = ! empty( $link['target'] ) ? $link['target'] : '_self';
	$class .= ' ' . ptvx_ui_class( 'button' );

	if ( false !== strpos( $class, 'ptvx-button--ghost' ) ) {
		$class .= ' ' . ptvx_ui_class( 'button_ghost' );
	}

	if ( false !== strpos( $class, 'ptvx-button--dark' ) ) {
		$class .= ' ' . ptvx_ui_class( 'button_dark' );
	}

	return sprintf(
		'<a class="%1$s" href="%2$s" target="%3$s"%4$s>%5$s</a>',
		esc_attr( $class ),
		esc_url( $link['url'] ),
		esc_attr( $target ),
		'_blank' === $target ? ' rel="noopener noreferrer"' : '',
		esc_html( ! empty( $link['title'] ) ? $link['title'] : __( 'Learn more', 'playtvx' ) )
	);
}

/**
 * Return a sales offer link from the central Options page.
 *
 * @param string                      $offer Offer key.
 * @param array<string, mixed>|string $fallback Custom fallback link.
 * @return array<string, mixed>|string
 */
function ptvx_offer_link( $offer, $fallback = '' ) {
	$allowed_offers = array( 'trial', 'monthly', 'six_month', 'yearly', 'twenty_four_month' );

	if ( in_array( $offer, $allowed_offers, true ) ) {
		$url = ptvx_option( $offer . '_link' );

		if ( $url ) {
			return array(
				'url'    => $url,
				'title'  => is_array( $fallback ) && ! empty( $fallback['title'] ) ? $fallback['title'] : ptvx_label( 'view_plans' ),
				'target' => '_blank',
			);
		}
	}

	return $fallback;
}

/**
 * Render Flexible Content rows for the current page.
 *
 * @return void
 */
function ptvx_render_page_sections() {
	if ( ! function_exists( 'have_rows' ) || ! have_rows( 'page_sections' ) ) {
		return;
	}

	while ( have_rows( 'page_sections' ) ) {
		the_row();
		$layout = get_row_layout();

		if ( $layout ) {
			get_template_part( 'template-parts/flexible/' . $layout );
		}
	}
}

/**
 * Convert newline-delimited values to a trimmed array.
 *
 * @param string $value Newline-delimited value.
 * @return array<int, string>
 */
function ptvx_lines( $value ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	return array_values( array_filter( array_map( 'trim', $lines ) ) );
}

/**
 * Convert a pipe-delimited ACF value into trimmed table cells.
 *
 * @param string $value Pipe-delimited value.
 * @return array<int, string>
 */
function ptvx_pipe_cells( $value ) {
	$cells = preg_split( '/\s*\|\s*/', trim( (string) $value ) );

	return array_values( array_map( 'trim', (array) $cells ) );
}

/**
 * Return the configured posts-page URL with a safe archive fallback.
 *
 * @return string
 */
function ptvx_blog_url() {
	$posts_page = (int) get_option( 'page_for_posts' );
	$url        = $posts_page ? get_permalink( $posts_page ) : get_post_type_archive_link( 'post' );

	return $url ?: home_url( '/blog/' );
}

/**
 * Estimate the reading time for an article.
 *
 * @param int $post_id Optional post ID.
 * @return int
 */
function ptvx_reading_time( $post_id = 0 ) {
	$content    = get_post_field( 'post_content', $post_id ?: get_the_ID() );
	$word_count = str_word_count( wp_strip_all_tags( strip_shortcodes( (string) $content ) ) );

	return max( 1, (int) ceil( $word_count / 220 ) );
}

/**
 * Return the first assigned category, prioritizing a non-default category.
 *
 * @param int $post_id Optional post ID.
 * @return WP_Term|null
 */
function ptvx_primary_category( $post_id = 0 ) {
	$categories = get_the_category( $post_id ?: get_the_ID() );

	if ( ! $categories ) {
		return null;
	}

	foreach ( $categories as $category ) {
		if ( 'uncategorized' !== $category->slug ) {
			return $category;
		}
	}

	return $categories[0];
}

/**
 * Return an archive heading without WordPress's "Category:" style prefix.
 *
 * @return string
 */
function ptvx_archive_title() {
	if ( is_category() ) {
		return single_cat_title( '', false );
	}

	if ( is_tag() ) {
		return single_tag_title( '', false );
	}

	if ( is_author() ) {
		return get_the_author();
	}

	if ( is_year() ) {
		return get_the_date( 'Y' );
	}

	if ( is_month() ) {
		return get_the_date( 'F Y' );
	}

	if ( is_day() ) {
		return get_the_date();
	}

	return wp_strip_all_tags( get_the_archive_title() );
}

/**
 * Render consistent accessible pagination for post listings.
 *
 * @return void
 */
function ptvx_posts_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => sprintf( '<span aria-hidden="true">&larr;</span> %s', esc_html__( 'Previous', 'playtvx' ) ),
			'next_text'          => sprintf( '%s <span aria-hidden="true">&rarr;</span>', esc_html__( 'Next', 'playtvx' ) ),
			'screen_reader_text' => esc_html__( 'Posts navigation', 'playtvx' ),
		)
	);
}

/**
 * Return filtered single-post content while enforcing one document H1.
 *
 * Some migrated articles contain a second H1 inside their saved content.
 * Demote those headings at render time without mutating the post database.
 *
 * @return string
 */
function ptvx_single_post_content() {
	$content = apply_filters( 'the_content', get_the_content() );
	$content = preg_replace( '/<h1(?=\s|>)/i', '<h2', $content );
	$content = preg_replace( '/<\/h1>/i', '</h2>', $content );
	$headings = array();
	$used_ids = array();

	$content = preg_replace_callback(
		'/<h([23])([^>]*)>(.*?)<\/h\1>/is',
		function ( $matches ) use ( &$headings, &$used_ids ) {
			$level      = (int) $matches[1];
			$attributes = (string) $matches[2];
			$label      = trim( wp_strip_all_tags( $matches[3] ) );
			$id         = '';

			if ( preg_match( '/\sid=["\']([^"\']+)["\']/i', $attributes, $id_match ) ) {
				$id = sanitize_title( $id_match[1] );
			}

			if ( ! $id ) {
				$id = sanitize_title( $label ) ?: 'article-section';
			}

			$base_id = $id;
			$suffix  = 2;
			while ( isset( $used_ids[ $id ] ) ) {
				$id = $base_id . '-' . $suffix++;
			}
			$used_ids[ $id ] = true;
			$headings[]      = array( 'level' => $level, 'label' => $label, 'id' => $id );

			$attributes = preg_replace( '/\sid=["\'][^"\']+["\']/i', '', $attributes );
			return sprintf( '<h%d id="%s"%s>%s</h%d>', $level, esc_attr( $id ), $attributes, $matches[3], $level );
		},
		(string) $content
	);

	if ( $headings ) {
		$toc = '<details class="ptvx-article-toc"><summary>' . esc_html( ptvx_label( 'article_summary' ) ) . '</summary><ol>';
		foreach ( $headings as $heading ) {
			$toc .= sprintf(
				'<li%s><a href="#%s">%s</a></li>',
				3 === $heading['level'] ? ' class="pl-4"' : '',
				esc_attr( $heading['id'] ),
				esc_html( $heading['label'] )
			);
		}
		$toc .= '</ol></details>';

		if ( preg_match( '/<\/p>/i', $content ) ) {
			$content = preg_replace( '/<\/p>/i', '</p>' . $toc, $content, 1 );
		} else {
			$content = $toc . $content;
		}
	}

	return (string) $content;
}
