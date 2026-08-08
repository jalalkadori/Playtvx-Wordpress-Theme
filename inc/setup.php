<?php
/**
 * Theme setup and assets.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

/**
 * Version a public asset by its modification time so a changed file cannot be
 * masked by a browser or CDN cache.
 *
 * @param string $relative_path Path relative to this child theme directory.
 * @return string Theme version or file modification time.
 */
function ptvx_asset_version( $relative_path ) {
	$path = PTVX_THEME_PATH . '/' . ltrim( $relative_path, '/' );

	return is_readable( $path ) ? (string) filemtime( $path ) : PTVX_THEME_VERSION;
}

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'playtvx', PTVX_THEME_PATH . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

		register_nav_menus(
			array(
				'primary' => __( 'Primary navigation', 'playtvx' ),
				'footer'  => __( 'Footer navigation', 'playtvx' ),
			)
		);
	}
);

/**
 * Keep the native ACF front-page template authoritative on both network sites.
 *
 * @param string $template Resolved template path.
 * @return string
 */
add_filter(
	'template_include',
	function ( $template ) {
		$front_page_template = PTVX_THEME_PATH . '/front-page.php';

		if ( is_front_page() && is_readable( $front_page_template ) ) {
			return $front_page_template;
		}

		return $template;
	},
	PHP_INT_MAX
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'playtvx-fonts',
			'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
			array(),
			null
		);

		$tailwind_path = PTVX_THEME_PATH . '/assets/css/playtvx.css';

		if ( is_readable( $tailwind_path ) ) {
			wp_enqueue_style(
				'playtvx-tailwind',
				PTVX_THEME_URL . '/assets/css/playtvx.css',
				array( 'playtvx-fonts' ),
				ptvx_asset_version( 'assets/css/playtvx.css' )
			);
		}

		$script_path = PTVX_THEME_PATH . '/assets/js/theme.js';

		if ( is_readable( $script_path ) ) {
			wp_enqueue_script(
				'playtvx-theme',
				PTVX_THEME_URL . '/assets/js/theme.js',
				array(),
				ptvx_asset_version( 'assets/js/theme.js' ),
				true
			);
		}
	},
	20
);

/**
 * Keep the English site search focused on the editorial knowledge base.
 *
 * @param WP_Query $query Main WordPress query.
 * @return void
 */
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() || ptvx_is_french_site() ) {
			return;
		}

		$query->set( 'post_type', 'post' );
	}
);
