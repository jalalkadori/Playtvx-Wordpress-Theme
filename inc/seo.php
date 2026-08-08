<?php
/**
 * Technical SEO and lightweight performance helpers.
 *
 * Rank Math remains responsible for titles, descriptions, canonicals and its
 * standard schema graph. This file only supplies site relationships and schema
 * that are specific to the bilingual PlayTVX network.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the translated counterpart of the current public URL when one exists.
 *
 * Hreflang is deliberately limited to genuinely equivalent pages. Pointing
 * unrelated articles at one another would send misleading language signals.
 *
 * @return array<string,string>
 */
function ptvx_language_alternates() {
	$english_home = get_site_url( 1, '/' );
	$french_home  = get_site_url( 2, '/' );
	$pairs        = array(
		trailingslashit( $english_home )                          => trailingslashit( $french_home ),
		trailingslashit( get_site_url( 1, '/iptv-subscription/' ) ) => trailingslashit( get_site_url( 2, '/abonnements/' ) ),
	);
	$current      = is_front_page() ? trailingslashit( home_url( '/' ) ) : ( is_singular() ? trailingslashit( get_permalink() ) : '' );

	if ( isset( $pairs[ $current ] ) ) {
		return array(
			'en'        => $current,
			'fr'        => $pairs[ $current ],
			'x-default' => $current,
		);
	}

	$reverse = array_flip( $pairs );
	if ( isset( $reverse[ $current ] ) ) {
		return array(
			'en'        => $reverse[ $current ],
			'fr'        => $current,
			'x-default' => $reverse[ $current ],
		);
	}

	return array();
}

add_action(
	'wp_head',
	function () {
		foreach ( ptvx_language_alternates() as $language => $url ) {
			printf(
				"\n<link rel=\"alternate\" hreflang=\"%s\" href=\"%s\">",
				esc_attr( $language ),
				esc_url( $url )
			);
		}
	},
	2
);

/**
 * Add a compact Service graph to the two subscription pages.
 */
add_action(
	'wp_head',
	function () {
		if ( ! is_page( array( 1857, 203 ) ) ) {
			return;
		}

		$is_french = ptvx_is_french_site();
		$schema    = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'@id'         => trailingslashit( get_permalink() ) . '#iptv-service',
			'name'        => $is_french ? 'Abonnement IPTV PlayTVX' : 'PlayTVX IPTV Subscription',
			'description' => $is_french
				? 'Abonnement IPTV compatible avec les principaux appareils de streaming, avec assistance à l’installation.'
				: 'IPTV subscription compatible with popular streaming devices and supported by setup assistance.',
			'url'         => get_permalink(),
			'provider'    => array(
				'@type' => 'Organization',
				'name'  => 'PlayTVX',
				'url'   => home_url( '/' ),
			),
			'areaServed'  => 'Worldwide',
		);

		echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	},
	30
);

/**
 * Preload the ACF hero background because it is the front page LCP candidate.
 */
add_action(
	'wp_head',
	function () {
		if ( ! is_front_page() || ! function_exists( 'get_field' ) ) {
			return;
		}

		$sections = get_field( 'page_sections', get_queried_object_id() );
		if ( ! is_array( $sections ) ) {
			return;
		}

		foreach ( $sections as $section ) {
			if ( 'hero' !== ( $section['acf_fc_layout'] ?? '' ) || empty( $section['background_image'] ) ) {
				continue;
			}

			$image_id  = is_array( $section['background_image'] ) ? (int) ( $section['background_image']['ID'] ?? 0 ) : (int) $section['background_image'];
			$image_url = wp_get_attachment_image_url( $image_id, 'full' );
			if ( $image_url ) {
				printf( "\n<link rel=\"preload\" as=\"image\" href=\"%s\" fetchpriority=\"high\">", esc_url( $image_url ) );
			}
			break;
		}
	},
	3
);

/**
 * Establish early connections to the stylesheet and font hosts.
 *
 * @param array<int|string,mixed> $urls Existing resource hints.
 * @param string                  $relation_type Hint relation.
 * @return array<int|string,mixed>
 */
add_filter(
	'wp_resource_hints',
	function ( $urls, $relation_type ) {
		if ( 'preconnect' !== $relation_type ) {
			return $urls;
		}

		$urls[] = 'https://fonts.googleapis.com';
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);

		return $urls;
	},
	10,
	2
);
