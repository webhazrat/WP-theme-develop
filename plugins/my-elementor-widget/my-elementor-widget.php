<?php 

/**
 * Plugin Name: My Elementor Widget
 * Description: This is a elementor widgets plugin
 * Version: 1.0
 * Author: Hazrat Ali
 * Author URI: https://itwindow.dev
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: myew
 */

 if(!defined('ABSPATH')) exit();
 


 /**
  * Elementor Extension main class
  */

  final class My_Elementor_Widget{

    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '3.20.0';

    // Minumum PHP version
    const MINIMUM_PHP_VERSION = '7.4';

    // Instance
    private static $_instance = null;

    // Singletone instance method
    public static function instance(){
      if(is_null(self::$_instance)){
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    // Construct method
    public function __construct(){
      // $this->define_constants();
      // add_action('wp_enqueue_scripts', [$this, 'scripts_styles']);
      // add_action('init', [$this, 'i18n']);

      if ( $this->is_compatible() ) {

        // Run init process here...
  
      }
    }

    // Compatibility checks
    public function is_compatible(){
      // Check if Elementor is installed and activated
      if( !did_action('elementor\loaded') ){
        add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
        return false;
      }

      // Check for required Elementor version
      if(!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')){
        add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
        return false;
      }

      // Check for required PHP version
      if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
        add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
        return false;
      }

      return true;
    }

    // Warning when the site doesn't have Elementor installed or activated.
    public function admin_notice_missing_main_plugin() {
      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
      $message = sprintf(
        esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'myew' ),
        '<strong>' . esc_html__( 'My Elementor Widget', 'myew' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'myew' ) . '</strong>'
      );
      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    // Warning when the site doesn't have a minimum required Elementor version.
    public function admin_notice_minimum_elementor_version() {
      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
      $message = sprintf(
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'myew' ),
        '<strong>' . esc_html__( 'My Elementor Widget', 'myew' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'myew' ) . '</strong>',
         self::MINIMUM_ELEMENTOR_VERSION
      );
      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    // Warning when the site doesn't have a minimum required PHP version
    public function admin_notice_minimum_php_version() {
      if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
      $message = sprintf(
        esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),
        '<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
        '<strong>' . esc_html__( 'PHP', 'elementor-test-addon' ) . '</strong>',
         self::MINIMUM_PHP_VERSION
      );
      printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    

    // Define plugin constants
    public function define_constants(){
      define('MYEW_PLUGIN_URL', trailingslashit(plugins_url('/', __FILE__)));
      define('MYEW_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
    }

    // Load scripts and styles
    public function scripts_styles(){
      wp_register_style('myew-style', MYEW_PLUGIN_URL . 'assets/dist/css/public.min.css', [], rand(), 'all');
      wp_register_script('myew-script', MYEW_PLUGIN_URL . 'assets/dist/js/public.min.js', ['jquery'], rand(), true);

      wp_enqueue_style('myew-style');
      wp_enqueue_script('myew-script');
    }

    // Load text-domain
    public function i18n(){
      load_plugin_textdomain('myew', false, dirname( plugin_basename(__FILE__)) . '/languages');
    }

    // Initialize the plugin
    public function init(){
      add_action('elementor/init', [$this, 'init_category']);
      add_action('elementor/widgets/widgets_register', [$this, 'init_widgets']);
    }

    // Widgets initialization
    public function init_widgets(){
     require_once MYEW_PLUGIN_PATH . '/widgets/example.php';
    }

    // Init category section
    public function init_category(){
      Elementor\Plugin::instance()->elements_manager->add_category(
        'myew-for-elementor',
        array(
          'title' => 'My Elementor Widgets'
        ), 
        1
      );
    }
    
  }

  \My_Elementor_Widget::instance();