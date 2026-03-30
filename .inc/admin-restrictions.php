<?php
// Usuários administradores permitidos
$allowed_admins = ['rodrigo', 'Z@Padmin'];

// Esconde menus de Plugins e Aparência para usuários não autorizados
add_action('admin_menu', function() {
    $allowed_admins = ['rodrigo', 'Z@Padmin'];
    $current_user = wp_get_current_user();
    
    if (!in_array($current_user->user_login, $allowed_admins)) {
        remove_menu_page('plugins.php');
        remove_menu_page('themes.php');
        remove_submenu_page('themes.php', 'themes.php');
        remove_submenu_page('themes.php', 'widgets.php');
        remove_submenu_page('themes.php', 'customize.php');
        remove_submenu_page('themes.php', 'nav-menus.php');
    }
});

// Bloqueia acesso direto às páginas mesmo digitando a URL
add_action('current_screen', function($screen) {
    $allowed_admins = ['rodrigo', 'Z@Padmin'];
    $current_user = wp_get_current_user();
    
    if (!in_array($current_user->user_login, $allowed_admins)) {
        $blocked_screens = ['plugins', 'plugin-install', 'plugin-editor', 'themes', 'theme-editor', 'widgets', 'nav-menus', 'customize'];
        
        if (in_array($screen->id, $blocked_screens)) {
            wp_die('Acesso negado.', 403);
        }
    }
});