<?php
/**
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition\App\Setup;

use Inc2734\WP_GitHub_Plugin_Updater;

class Updater {

	function __construct() {
		add_action( 'init', [ __CLASS__, '_activate_autoupdate' ] );
	}

	static function _activate_autoupdate() {
		new WP_GitHub_Plugin_Updater\Bootstrap(
			KL_TOGGLE_POSITION_FILE,
			'kmix-39',
			'kl-toggle-position',
			[]
		);
	}

}
