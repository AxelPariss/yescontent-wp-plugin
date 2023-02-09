<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://yescontent.rocks
 * @since             1.0.0
 * @package           Yescontent
 *
 * @wordpress-plugin
 * Plugin Name:       YesContent
 * Plugin URI:        https://yescontent.rocks
 * Description:       Plateforme de gestion et publication de contenu
 * Version:           1.0.1
 * Author:            Axel Paris
 * Author URI:        https://yescontent.rocks
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       yescontent
 * Domain Path:       /languages
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/AxelPariss/yescontent-wp-plugin',
    __FILE__,
    'yescontent'
);

$myUpdateChecker->setBranch('main');

define('YESCONTENT_DIR', plugin_dir_path(__FILE__));

load_theme_textdomain(
    'yescontent',
    dirname(plugin_basename(__FILE__)) . '/languages'
);

require 'inc/api.php';
require 'inc/settings-page.php';
require 'inc/auth.php';
