<?php
    function enqueue_custom_scripts() {
        wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/app.js', array(), null, true);
        wp_localize_script('custom-js', 'custom_script_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('load_more_jobs')
        ));
    }
    add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');