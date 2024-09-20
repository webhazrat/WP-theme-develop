<?php 

/**
 * Plugin Name: My Plugin
 * Description: This is just demo plugin
 * Version: 1.0
 * Author: Hazrat Ali
 * Author URI: https://itwindow.dev
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mp
 */

 if(!defined('ABSPATH')) : exit(); endif;

/**
 * Define plugin constants
 */
define('MYPLUGIN_PATH', trailingslashit( plugin_dir_path(__FILE__)));
define('MYPLUGIN_URL', trailingslashit( plugins_url('/', __FILE__)));

/**
 * Include admin.php
 */
if(is_admin()){
    require_once MYPLUGIN_PATH . '/admin/admin.php';
}

/**
 * Include public.php
 */
if(!is_admin()){
    require_once MYPLUGIN_PATH . '/public/public.php';
}

/**
 * Inclue post types
 */
require_once MYPLUGIN_PATH . '/inc/post-types/movie.php';

/**
 * Include post type category
 */
require_once MYPLUGIN_PATH . '/inc/taxonomies/movie-taxonomy.php';

/**
 * Inluce metaboxes
 */
require_once MYPLUGIN_PATH . '/inc/metaboxes/movie-metaboxes.php';

/**
 * Include movie datatable columns
 */
require_once MYPLUGIN_PATH . '/inc/data-tables/movie-data-table.php';

/**
 * Include admin menus
 */
require_once MYPLUGIN_PATH . '/inc/menus/menus.php';

/**
 * Include settings
 */
require_once MYPLUGIN_PATH . '/inc/settings/settings.php';

/**
 * Include shortcode
 */
require_once MYPLUGIN_PATH . '/inc/shortcodes/shortcodes.php';

/**
 * Include dashboard widgets
 */
require_once MYPLUGIN_PATH . '/inc/dashboard/widgets.php';

/**
 * Include widgets
 */
require_once MYPLUGIN_PATH . '/inc/widgets/movie-widget.php';