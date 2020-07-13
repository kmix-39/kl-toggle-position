<?php
/**
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition\App\Setup;

class Assets {

	function __construct() {
		add_action( 'wp_enqueue_scripts', [ __CLASS__, '_enqueue_assets' ] );
	}

	static function _enqueue_assets() {
		wp_enqueue_style(
			'kl-toggle-position-app',
			KL_TOGGLE_POSITION_URL . '/assets/css/app.min.css',
			[
				\Framework\Helper::get_main_style_handle(),
			],
			filemtime( KL_TOGGLE_POSITION_PATH . '/assets/css/app.min.css' )
		);

		$_active_check = ActiveCheck::instance();
		if ( $_active_check->is_plugins_active() ) {
			return;
		}

		$_toggle_menu_position = get_theme_mod( 'toggle-menu-position', 'left' );
		if ( 'right' === $_toggle_menu_position ) {
			wp_enqueue_style(
				'kl-toggle-position-right',
				KL_TOGGLE_POSITION_URL . '/assets/css/right.min.css',
				[
					\Framework\Helper::get_main_style_handle(),
				],
				filemtime( KL_TOGGLE_POSITION_PATH . '/assets/css/right.min.css' )
			);
		}
	}

}
