<?php
/**
 * PlayTVX standalone theme bootstrap.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

define( 'PTVX_THEME_VERSION', '1.0.0' );
define( 'PTVX_THEME_PATH', get_stylesheet_directory() );
define( 'PTVX_THEME_URL', untrailingslashit( get_stylesheet_directory_uri() ) );

require_once PTVX_THEME_PATH . '/inc/setup.php';
require_once PTVX_THEME_PATH . '/inc/acf.php';
require_once PTVX_THEME_PATH . '/inc/template-tags.php';
require_once PTVX_THEME_PATH . '/inc/seo.php';
