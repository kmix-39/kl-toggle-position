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
			];
			$_header_layout = get_theme_mod( 'header-layout' );
			if ( is_array( $_header_layout, $_header_layout_data, true ) ) {
				add_filter(
					'snow_monkey_template_part_render_template-parts/header/' . $_header_layout,
					[ __CLASS__, '_sm_render_toggle_button_' . $_header_layout ],
					10,
					3
				);
			}
			if ( $_active_check->is_plugins_active() ) {
				add_filter( 'snow_monkey_template_part_render_template-parts/nav/drawer', [ __CLASS__, '_sm_render_toggle_menu' ], 10, 3 );
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
		foreach ( $_xPath->query( '//div[@class="l-1row-header"]/div/div[@class="c-row c-row--margin c-row--middle c-row--between c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( $_childNode->nodeType !== 1 ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-pull-right u-hidden-lg-up' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_drawer_nav->setAttribute( 'class', 'c-row__col c-row__col--fit u-pull-left u-hidden-lg-up' );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		$_html = $_domDocument->saveHTML();
		return $_html;
	}

	static function _sm_render_toggle_button_2row( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-2row-header"]/div/div[@class="l-2row-header__row"]/div[@class="c-row c-row--margin c-row--middle c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( $_childNode->nodeType !== 1 ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit u-hidden-lg-up' === $_classes ) {
					$_drawer_nav = $childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		$_html = $_domDocument->saveHTML();
		return $_html;
	}

	static function _sm_render_toggle_button_center( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-center-header"]/div/div[@class="l-center-header__row"]/div[@class="c-row c-row--margin-s c-row--middle c-row--between c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( $_childNode->nodeType !== 1 ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--1-6 u-hidden-lg-up' === $_classes ) {
					if ( empty( $_childNode->nodeValue ) ) {
						continue;
					}
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->replaceChild( $_drawer_nav, $_nodes->firstChild );
					$_childNode->nodeValue = null;
					break 2;
				}
			}
		}
		$_html = $_domDocument->saveHTML();
		$_html = str_replace(
			'<div class="u-pull-right">',
			'<div class="u-pull-left">',
			$_html
		);
		return $_html;
	}

	static function _sm_render_toggle_button_simple( $_html, $_name, $_vars ) {
		$_domDocument = new \DOMDocument();
		$_pre_use = libxml_use_internal_errors( true );
		$_html = $_domDocument->loadHTML( '<?xml encoding="UTF-8">' . $_html );
		libxml_clear_errors();
		libxml_use_internal_errors( $_pre_use );
		$_xPath = new \DOMXPath( $_domDocument );
		foreach ( $_xPath->query( '//div[@class="l-simple-header__row"]/div[@class="c-row c-row--margin c-row--middle c-row--nowrap"]' ) as $_nodes ) {
			foreach ( $_nodes->childNodes as $_childNode ) {
				if ( $_childNode->nodeType !== 1 ) {
					continue;
				}
				$_classes = $_childNode->getAttribute( 'class' );
				if ( 'c-row__col c-row__col--fit' === $_classes ) {
					$_drawer_nav = $_childNode->cloneNode( true );
					$_nodes->insertBefore( $_drawer_nav, $_nodes->firstChild );
					$_nodes->removeChild( $_childNode );
					break 2;
				}
			}
		}
		$_html = $_domDocument->saveHTML();
		return $_html;
	}

	static function _sm_render_toggle_menu( $_html, $_name, $_vars ) {
		$_html = str_replace(
			'<li class="c-dropdown__item u-text-right">',
			'<li class="c-dropdown__item u-text-left">',
			$_html
		);
		return $_html;
	}

}
