<?php

<?php

/**
 * Proteção do .htaccess
 * - Força permissão 444 (somente leitura)
 * - Impede alteração via WordPress e plugins
 * - Corrige automaticamente se alguém tentar mudar a permissão
 */

// 1. Força permissão 444 no .htaccess
add_action('init', function() {
    $htaccess = ABSPATH . '.htaccess';
    
    if (file_exists($htaccess)) {
        $perms = fileperms($htaccess) & 0777;
        
        if ($perms !== 0444) {
            chmod($htaccess, 0444);
        }
    }
});

// 2. Impede alteração do .htaccess pelo WordPress e plugins
add_filter('mod_rewrite_rules', function($rules) {
    $allowed_admins = ['rodrigo', 'Z@Padmin'];
    $current_user = wp_get_current_user();
    
    if (!in_array($current_user->user_login, $allowed_admins)) {
        return false;
    }
    return $rules;
});

// 3. Impede que plugins escrevam no .htaccess
add_filter('flush_rewrite_rules_hard', function($hard) {
    $allowed_admins = ['rodrigo', 'Z@Padmin'];
    $current_user = wp_get_current_user();
    
    if (!in_array($current_user->user_login, $allowed_admins)) {
        return false;
    }
    return $hard;
});