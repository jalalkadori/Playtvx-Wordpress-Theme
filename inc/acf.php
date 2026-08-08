<?php
/**
 * ACF configuration owned by the child theme.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'acf/settings/save_json',
	function ( $path ) {
		return PTVX_THEME_PATH . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = PTVX_THEME_PATH . '/acf-json';
		return $paths;
	}
);

require_once PTVX_THEME_PATH . '/inc/acf-fields.php';
