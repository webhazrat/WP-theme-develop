<?php
/**
 * Plugin Name:      Elementor Test Addon
 * Description:      Custom Elementor addon.
 * Plugin URI:       https://elementor.com/
 * Version:          1.0.0
 * Author:           Elementor Developer
 * Author URI:       https://developers.elementor.com/
 * Text Domain:      elementor-test-addon
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.0
 * Elementor Pro tested up to: 3.24.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 function elementor_test_addon(){
    // Load plugin file
	\Plugin::instance();
 }
 add_action('plugins_loaded', 'elementor_test_addon');


 final class Plugin {

    const MINIMUM_ELEMENTOR_VERSION = '3.20.0';
    const MINIMUM_PHP_VERSION = '7.4';

	private static $_instance = null;
	public static function instance() {
        if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
    }

	public function __construct() {
        if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
    }
	public function is_compatible() {
        if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;
    }

    public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-addon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function init() {
        // add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_styles' ] );
		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'frontend_scripts' ] );

        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        // add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
    }

    public function frontend_styles() {
		// wp_register_style( 'frontend-style-1', plugins_url( 'assets/css/frontend-style-1.css', __FILE__ ) );
		// wp_register_style( 'frontend-style-2', plugins_url( 'assets/css/frontend-style-2.css', __FILE__ ), [ 'external-framework' ] );
		// wp_register_style( 'external-framework', plugins_url( 'assets/css/libs/external-framework.css', __FILE__ ) );

		// wp_enqueue_style( 'frontend-style-1' );
		// wp_enqueue_style( 'frontend-style-2' );
	}

	public function frontend_scripts() {
		// wp_register_script( 'frontend-script-1', plugins_url( 'assets/js/frontend-script-1.js', __FILE__ ) );
		// wp_register_script( 'frontend-script-2', plugins_url( 'assets/js/frontend-script-2.js', __FILE__ ), [ 'external-library' ] );
		// wp_register_script( 'external-library', plugins_url( 'assets/js/libs/external-library.js', __FILE__ ) );

		// wp_enqueue_script( 'frontend-script-1' );
		// wp_enqueue_script( 'frontend-script-2' );
	}

    public function register_widgets( $widgets_manager ) {
		require_once( __DIR__ . '/includes/widgets/widget-1.php' );
		// require_once( __DIR__ . '/includes/widgets/widget-2.php' );
		$widgets_manager->register( new \Widget_1() );
		// $widgets_manager->register( new \Widget_2() );
	}

    // public function register_controls( $controls_manager ) {
	// 	require_once( __DIR__ . '/includes/controls/control-1.php' );
	// 	require_once( __DIR__ . '/includes/controls/control-2.php' );
	// 	$controls_manager->register( new \Control_1() );
	// 	$controls_manager->register( new \Control_2() );
	// }

	

}

