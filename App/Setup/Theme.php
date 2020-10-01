<?php
/**
 * @package kl-toggle-position
 * @author Kmical Lights
 * @license GPL-2.0+
 */
namespace KmicalLights\TogglePosition\App\Setup;

class Theme {

	function __construct() {
		$_active_check = ActiveCheck::instance();

		$_toggle_button_position = get_theme_mod( 'toggle-button-position', 'right' );
		$_toggle_menu_position = get_theme_mod( 'toggle-menu-position', 'left' );

		if ( ! $_active_check->is_plugins_active() && $_toggle_button_position === $_toggle_menu_position ) {
			$_header_layout = get_theme_mod( 'header-layout' );
			add_action( 'snow_monkey_prepend_drawer_nav', [ __CLASS__, '_sm_prepend_drawer_nav' ], 1, 1 );
		}

		if ( 'left' === $_toggle_button_position ) {
			$_header_layout_data = [
				'1row',
				'2row',
				'center',
				'simple',
				'left',
			];
			$_header_layout = get_theme_mod( 'header-layout' );
			if ( in_array( $_header_layout, $_header_layout_data, true ) ) {
				add_filter(
					'snow_monkey_template_part_render_template-parts/header/' . $_header_layout,
					[ __CLASS__, '_sm_render_toggle_button_' . $_header_layout ],
					10,
					3
				);
			}
			if ( $_active_check->is_plugins_active() ) {
				add_filter(
					'snow_monkey_template_part_render_template-parts/nav/drawer',
					[ __CLASS__, '_sm_render_toggle_menu' ],
					10,
					3
				);
			}
		}
	}

	static function _sm_prepend_drawer_nav() {
		$_toggle_menu_position = get_theme_mod( 'toggle-menu-position', 'left' );
?>
		<ul class="c-drawer__menu">
			<li class="c-drawer__item u-text-<?php echo esc_attr( $_toggle_menu_position ); ?>">
				<?php \Framework\Helper::get_template_part( 'template-parts/header/hamburger-btn' ); ?>
			</li>
		</ul>
<?php
	}

	static function _sm_render_toggle_button_1row( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-1row-header"]/div[@class="c-container"]/div[@class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--between c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( 1 !== $_childNode->nodeType ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-invisible-lg-up' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		return $_domDocument->saveHTML();
	}

	static function _sm_render_toggle_button_2row( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-2row-header"]/div[@class="c-container"]/div[@class="l-2row-header__row"]/div[@class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--between c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( $_childNode->nodeType !== 1 ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-pull-right u-invisible-lg-up' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		return $_domDocument->saveHTML();
	}

	static function _sm_render_toggle_button_center( $_html, $_name, $_vars ) {
		$_html = preg_replace(
			'/<div class="c-row__col c-row__col--fit u-pull-right u-invisible-lg-up">/',
			'<div class="c-row__col c-row__col--fit u-invisible-lg-up u-invisible-wall" aria-hidden="true">',
			$_html,
			1
		);
		$_html = preg_replace(
			'/<div class="c-row__col c-row__col--fit u-invisible-lg-up u-invisible-wall" aria-hidden="true">/',
			'<div class="c-row__col c-row__col--fit u-pull-right u-invisible-lg-up">',
			$_html,
			1
		);
		return $_html;
	}

	static function _sm_render_toggle_button_left( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-left-header"]/div[@class="c-container"]/div[@class="c-row c-row--middle c-row--margin-s c-row--between"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( 1 !== $_childNode->nodeType ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-pull-right u-invisible-lg-up' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		return $_domDocument->saveHTML();
	}

	static function _sm_render_toggle_button_simple( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-simple-header__row"]/div[@class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--between c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( 1 !== $_childNode->nodeType ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-pull-right' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		return $_domDocument->saveHTML();
	}

	static function _sm_render_toggle_menu( $_html, $_name, $_vars ) {
		return str_replace(
			'<li class="c-dropdown__item u-text-right">',
			'<li class="c-dropdown__item u-text-left">',
			$_html
		);
	}

}
