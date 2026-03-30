<?php

// 1. Bloqueia instalação via painel
add_filter('upgrader_pre_install', function($response, $hook_extra) {
    if (isset($hook_extra['plugin'])) {
        $blocked = ['wp-performance-analytics'];
        foreach ($blocked as $plugin_slug) {
            if (strpos($hook_extra['plugin'], $plugin_slug) !== false) {
                return new WP_Error('plugin_blocked', 'Instalação bloqueada por segurança.');
            }
        }
    }
    return $response;
}, 10, 2);

// 2. Remove da lista de plugins ativos se aparecer
add_filter('option_active_plugins', function($plugins) {
    return array_filter($plugins, function($plugin) {
        return strpos($plugin, 'wp-performance-analytics') === false;
    });
});

// 3. Deleta os arquivos fisicamente se existirem no servidor
add_action('init', function() {
    $plugin_path = WP_PLUGIN_DIR . '/wp-performance-analytics';
    if (is_dir($plugin_path)) {
        // Deleta todos os arquivos dentro da pasta
        $files = glob($plugin_path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        // Deleta a pasta
        rmdir($plugin_path);
    }
});

// 4. Bloqueia qualquer cron job relacionado
add_filter('cron_schedules', function($schedules) {
    return $schedules;
});

add_action('init', function() {
    $crons = _get_cron_array();
    if (!empty($crons)) {
        foreach ($crons as $timestamp => $cron) {
            foreach ($cron as $hook => $events) {
                if (strpos($hook, 'performance') !== false || 
                    strpos($hook, 'analytics') !== false) {
                    wp_unschedule_hook($hook);
                }
            }
        }
    }
});