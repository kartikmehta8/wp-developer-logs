<?php
/*
 * Plugin Name: Developer Logs Plugin
 * Description: A plugin to log and display custom developer logs.
 * Plugin URI: https://mrmehta.in
 * Version: 1.0
 * Author: Kartik Mehta
 * Author URI: https://mrmehta.in
 * License: MIT
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: developer-logs-plugin
 * Requires at least: 6.0
 * Requires PHP: 8.1.29
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit; 
}

// Use SPL autoloader.
spl_autoload_register(function ($class_name) {
    // If the class does not start with 'Dev_Logs_', return.
    if (false !== strpos($class_name, 'Dev_Logs_')) {

        // Convert the class name to lowercase and replace '_' with '-'.
        $class_name = strtolower(str_replace('_', '-', $class_name));

        // Require the class file.
        require_once plugin_dir_path(__FILE__) . 'includes/class-' . $class_name . '.php';
    }
});

// Initialize the plugin.
function dev_logs_plugin_init() {
    $plugin = new Dev_Logs_Plugin();
    $plugin->init();
}

// Initialize the plugin.
add_action('plugins_loaded', 'dev_logs_plugin_init');
