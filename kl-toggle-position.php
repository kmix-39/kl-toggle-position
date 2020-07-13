<?php
/**
 * Plugin Name: Toggle Position by Kmical Lights
 * Plugin URI: https://github.com/kmix-39
 * Description: Customize Plugin for Snow Monkey
 * Version: 0.1.0
 * Requires at least: 5.4
 * Requires PHP: 7.3
 * Author: Kmical Lights
 * Author URI: https://github.com/kmix-39
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: kl-toggle-position
 * Domain Path: /languages
 *
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition;

defined( 'ABSPATH' ) || exit;

define( 'KL_TOGGLE_POSITION_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'KL_TOGGLE_POSITION_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class Bootstrap {

	function __construct() {
		register_activation_hook( __FILE__, [ __CLASS__, '_activation' ] );
		register_deactivation_hook( __FILE__, [ __CLASS__, '_deactivation' ] );
		add_action( 'plugins_loaded', [ __CLASS__, '_plugins_loaded' ] );
	}

	static function _activation() {
		register_uninstall_hook( __FILE__, [ __CLASS__, '_uninstall' ] );

		$_template_cache = new \Framework\Model\Template_Cache();
		$_template_cache->remove();
	}

	static function _deactivation() {
		$_template_cache = new \Framework\Model\Template_Cache();
		$_template_cache->remove();
	}

	static function _uninstall() {
		remove_theme_mod( 'toggle-button-position' );
		remove_theme_mod( 'toggle-menu-position' );

		$_template_cache = new \Framework\Model\Template_Cache();
		$_template_cache->remove();
	}

	static function _plugins_loaded() {
		load_plugin_textdomain( 'kl-toggle-position', false, basename( __DIR__ ) . '/languages' );

		$_active_check = App\Setup\ActiveCheck::instance();
		$_notices = \Kmix39\WP_Group_Admin_Notices\Bootstrap::instance();


		if ( ! $_active_check->is_theme_active() ) {
			$_notices->add_notice(
				'kl-toggle-position',
				'active_theme_error',
				__( '"Toggle Position by Kmical Lights" is not available for your current theme.', 'kl-toggle-position' )
			);
		}
		if ( 0 < $_notices->get_notices_count( 'kl-toggle-position' ) ) {
			$_notices->display_notices( 'kl-toggle-position', 'notice-info' );
			return;
		}

		add_action( 'init', [ __CLASS__, '_init' ] );
	}

	static function _init() {
		new App\Setup\Customizer();
		$_toggle_button_position = get_theme_mod( 'toggle-button-position', 'right' );
		$_toggle_menu_position = get_theme_mod( 'toggle-menu-position', 'left' );
		if ( 'right' !== $_toggle_button_position || 'left' !== $_toggle_menu_position ) {
			new App\Setup\Theme();
			new App\Setup\Assets();
		}
	}

}

require_once( KL_TOGGLE_POSITION_PATH . '/vendor/autoload.php' );

new Bootstrap();
