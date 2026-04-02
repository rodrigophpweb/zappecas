<?php

$allowed_admins = ['rodrigo', 'Z@Padmin'];

// Menus bloqueados para usuários não autorizados
$blocked_for_others = [
    'plugins.php',
    'themes.php',
    'sucuriscan', 
    'wps-limit-login',
    'wps-hide-login',
    'edit.php?post_type=acf-field-group',
];

// Menus bloqueados também para Z@Padmin
$blocked_for_zadmin = [
    'sucuriscan',
    'wps-limit-login',
    'wps-hide-login',
    'edit.php?post_type=acf-field-group',
];

// Esconde menus no painel
add_action('admin_menu', function() use ($blocked_for_others, $blocked_for_zadmin) {
    $current_user = wp_get_current_user();
    $login = $current_user->user_login;

    // Rodrigo vê tudo
    if ($login === 'rodrigo') return;

    // Z@Padmin — bloqueia ACF, Sucuri, WPS Limit e WPS Hide Login
    if ($login === 'Z@Padmin') {
        foreach ($blocked_for_zadmin as $menu) {
            remove_menu_page($menu);
        }
        return;
    }

    // Outros usuários — bloqueia tudo
    foreach ($blocked_for_others as $menu) {
        remove_menu_page($menu);
    }

    // Remove submenus de temas
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'widgets.php');
    remove_submenu_page('themes.php', 'customize.php');
    remove_submenu_page('themes.php', 'nav-menus.php');
});

// Bloqueia acesso direto pela URL
add_action('current_screen', function($screen) use ($blocked_for_zadmin) {
    $current_user = wp_get_current_user();
    $login = $current_user->user_login;

    // Rodrigo acessa tudo
    if ($login === 'rodrigo') return;

    // Screens bloqueadas para outros usuários
    $blocked_screens_others = [
        'plugins', 'plugin-install', 'plugin-editor',
        'themes', 'theme-editor', 'widgets', 'nav-menus', 'customize',
        'sucuriscan', 'acf-field-group', 'wps-limit-login', 'wps-hide-login',
    ];

    // Screens bloqueadas para Z@Padmin
    $blocked_screens_zadmin = [
        'sucuriscan', 'acf-field-group', 'wps-limit-login', 'wps-hide-login',
    ];

    // Z@Padmin — bloqueia ACF, Sucuri, WPS Limit e WPS Hide Login
    if ($login === 'Z@Padmin') {
        foreach ($blocked_screens_zadmin as $blocked) {
            if (strpos($screen->id, $blocked) !== false) {
                wp_die('Acesso negado.', 'Acesso Negado', ['response' => 403]);
            }
        }
        return;
    }

    // Outros usuários — bloqueia tudo
    foreach ($blocked_screens_others as $blocked) {
        if (strpos($screen->id, $blocked) !== false) {
            wp_die('Acesso negado.', 'Acesso Negado', ['response' => 403]);
        }
    }
});
