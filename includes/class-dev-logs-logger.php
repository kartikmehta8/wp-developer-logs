<?php
/**
 * File used to define the Dev Logs Logger class.
 */

/**
 * Logger class - used to log messages.
 */
class Dev_Logs_Logger {

    /**
     * Log a message.
     */
    public static function log() {
        // Sanitize the arguments.
        $args = func_get_args();
        $sanitized_args = array_map('sanitize_text_field', $args);
        
        $log_entry = implode(' | ', $sanitized_args);

        // Get the existing logs and add the new log entry.
        $existing_logs = get_option('dev_logs_plugin_logs', array());
        $existing_logs[] = $log_entry;
        update_option('dev_logs_plugin_logs', $existing_logs);
    }

    /**
     * Get the logs.
     */
    public static function get_logs() {
        // Check the nonce.
        check_ajax_referer('dev_logs_nonce', 'security');

        // Get the logs and send them as a JSON response.
        $logs = get_option('dev_logs_plugin_logs', array());
        $escaped_logs = array_map('esc_html', $logs);
        wp_send_json_success($escaped_logs);
    }

    /**
     * Clear the logs.
     */
    public static function clear_logs() {
        // Check the nonce.
        check_ajax_referer('dev_logs_nonce', 'security');

        // Clear the logs.
        update_option('dev_logs_plugin_logs', array());
        wp_send_json_success();
    }
}
