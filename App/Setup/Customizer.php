<?php
/**
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition\App\Setup;

use Inc2734\WP_Customizer_Framework\Framework;

class Customizer {

	function __construct() {
		add_action( 'snow_monkey_post_load_customizer', [ __CLASS__, '_load_customizer' ] );
	}

	static function _load_customizer() {
		Framework::control(
			'select',
			'toggle-button-position',
			[
				'label' => __( 'Toggle Button Position', 'kl-toggle-position' ),
				'description' => __( 'Only the actual screen will be reflected.', 'kl-toggle-position' ),
				'default' => 'right',
				'choices' => [
					'right' => __( 'Right (Default)', 'kl-toggle-position' ),
					'left' => __( 'Left', 'kl-toggle-position' ),
				],
			]
		);

		$_active_check = ActiveCheck::instance();
		if ( ! $_active_check->is_plugins_active() ) {
			Framework::control(
				'select',
				'toggle-menu-position',
				[
					'label' => __( 'Toggle Menu Position', 'kl-toggle-position' ),
					'description' => __( 'Only the actual screen will be reflected.', 'kl-toggle-position' ),
					'default' => 'left',
					'choices' => [
						'left' => __( 'Left (Default)', 'kl-toggle-position' ),
						'right' => __( 'Right', 'kl-toggle-position' ),
					],
				]
			);
		}

		if ( ! is_customize_preview() ) {
			return;
		}

		$_panel = Framework::get_panel( 'design' );
		$_section = Framework::get_section( 'header' );

		$_control = Framework::get_control( 'toggle-button-position' );
		$_control->join( $_section )->join( $_panel );

		if ( ! $_active_check->is_plugins_active() ) {
			$_control = Framework::get_control( 'toggle-menu-position' );
			$_control->join( $_section )->join( $_panel );
		}
	}

}
