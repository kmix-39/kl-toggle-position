<?php
/**
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition\App\Setup;

class ActiveCheck {

	private $_is_theme_active = false;
	private $_is_plugins_active = false;

	private function __construct() {}

	static function instance() {
		static $_instance = null;
		if ( null === $_instance ) {
			$_instance = new ActiveCheck();
			$_active_check = new \Kmix39\WP_Active_Check\Bootstrap();
			$_instance->_is_theme_active = $_active_check->is_theme_active(
				[
					'snow-monkey' => [ '11.5.0', '>=' ],
					'snow-monkey/resources' => [ '11.5.0', '>=' ],
				]
			);
			$_instance->_is_plugins_active = $_active_check->is_plugins_active( [
				'snow-monkey-dropdown-navigation/snow-monkey-dropdown-navigation.php' => [ '0.4.0', '>=' ],
			] );
		}
		return $_instance;
	}

	function is_theme_active() {
		return $this->_is_theme_active;
	}

	function is_plugins_active() {
		return $this->_is_plugins_active;
	}

}
