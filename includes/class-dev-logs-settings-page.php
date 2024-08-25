<?php
/**
 * File that contains the Dev_Logs_Settings_Page class.
 */

/**
 * The settings page class.
 */
class Dev_Logs_Settings_Page {

    /**
     * Register the settings page.
     */
    public static function register_menu() {
        // Add the settings page.
        add_options_page(
            esc_html__('Developer Logs', 'developer-logs-plugin'),
            esc_html__('Developer Logs', 'developer-logs-plugin'),
            'manage_options',
            'dev-logs-plugin',
            array(__CLASS__, 'render_page')
        );
    }

    /**
     * Render the settings page.
     */
    public static function render_page() {
        // Check if the current user can manage options.
        if (!current_user_can('manage_options')) {
            return;
        }

        // Output the settings page.
        wp_nonce_field('dev_logs_nonce', 'dev_logs_nonce_field');
        include plugin_dir_path(__FILE__) . '../templates/admin-page.php';
    }
}
