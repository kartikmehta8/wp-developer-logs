/**
 * This file contains the JavaScript code for the Developer Logs Plugin.
 * It is responsible for loading the logs and clearing them.
 * It uses AJAX to communicate with the server.
 */

jQuery(document).ready(function($) {

    // Load the logs from the server.
    function loadLogs() {
        $.ajax({
            url: devLogsAjax.ajax_url,
            method: 'POST',
            data: {
                action: 'dev_logs_plugin_get_logs',
                security: devLogsAjax.nonce
            },

            // If the request is successful, display the logs.
            success: function(response) {
                if (response.success) {
                    let logsContainer = $('#dev-logs-container');
                    logsContainer.empty();
                    if (response.data.length) {
                        response.data.forEach(function(log) {
                            logsContainer.append('<p>' + log + '</p>');
                        });
                    } else {
                        logsContainer.append('<p>' + devLogsAjax.no_logs + '</p>');
                    }
                }
            }
        });
    }

    // Load the logs when the page is loaded.
    loadLogs();

    // Clear the logs when the button is clicked.
    $('#dev-logs-clear-button').on('click', function() {
        $.ajax({
            url: devLogsAjax.ajax_url,
            method: 'POST',
            data: {
                action: 'dev_logs_plugin_clear_logs',
                security: devLogsAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    loadLogs();
                }
            }
        });
    });
});
