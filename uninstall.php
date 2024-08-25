<?php
/**
 * File used to uninstall the plugin.
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove the plugin option from the database.
delete_option('dev_logs_plugin_logs');
