<?php
/**
 * File used to define the Dev Logs Plugin class.
 */

/**
 * Plugin class - used to initialize the plugin.
 */
class Dev_Logs_Plugin {

    /**
     * Initialize the plugin.
     */
    public function init() {
        // Register hooks.
        $this->register_hooks();
    }

    /**
     * Register hooks.
     */
    private function register_hooks() {
        // Register activation & deactivation hooks.
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Initialize settings page.
        add_action('admin_menu', array('Dev_Logs_Settings_Page', 'register_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_dev_logs_plugin_get_logs', array('Dev_Logs_Logger', 'get_logs'));
        add_action('wp_ajax_dev_logs_plugin_clear_logs', array('Dev_Logs_Logger', 'clear_logs'));
    }

    /**
     * Enqueue scripts.
     */
    public static function enqueue_scripts($hook) {
        // Only enqueue the script on the settings page.
        if ($hook !== 'settings_page_dev-logs-plugin') {
            return;
        }

        // Enqueue the script.
        wp_enqueue_script('dev-logs-plugin-js', plugin_dir_url(__FILE__) . '../assets/js/dev-logs-plugin.js', array('jquery'), '1.0', true);

        // Localize the script.
        wp_localize_script('dev-logs-plugin-js', 'devLogsAjax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('dev_logs_nonce'),
            'no_logs' => esc_html__('No logs found.', 'developer-logs-plugin')
        ));
    }

    /**
     * Activate the plugin.
     */
    public function activate() {
        // Create the option in the database on activation.
        if (!get_option('dev_logs_plugin_logs')) {
            add_option('dev_logs_plugin_logs', array());
        }
    }

    /**
     * Deactivate the plugin.
     */
    public function deactivate() {
        // Cleanup if needed.
    }
}
