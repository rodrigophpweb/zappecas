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

// Bloqueia acesso direto pela URL (screen ID)
add_action('current_screen', function($screen) {
    $current_user = wp_get_current_user();
    $login = $current_user->user_login;

    // Rodrigo acessa tudo
    if ($login === 'rodrigo') return;

    // Screens bloqueadas para outros usuários
    $blocked_screens_others = [
        'plugins', 'plugin-install', 'plugin-editor',
        'themes', 'theme-editor', 'widgets', 'nav-menus', 'customize',
        'sucuriscan', 'acf-field-group', 'wps-limit-login', 'wps-hide-login',
        'whl_settings',
    ];

    // Screens bloqueadas para Z@Padmin
    $blocked_screens_zadmin = [
        'sucuriscan', 'acf-field-group', 'wps-limit-login', 'wps-hide-login',
        'whl_settings',
    ];

    $screens_to_check = ($login === 'Z@Padmin') ? $blocked_screens_zadmin : $blocked_screens_others;

    foreach ($screens_to_check as $blocked) {
        if (strpos($screen->id, $blocked) !== false) {
            wp_die('Acesso negado.', 'Acesso Negado', ['response' => 403]);
        }
    }
});

// Bloqueio extra por parâmetro GET na URL (garante bloqueio mesmo que screen_id falhe)
add_action('admin_init', function() {
    $current_user = wp_get_current_user();
    $login = $current_user->user_login;

    // Rodrigo acessa tudo
    if ($login === 'rodrigo') return;

    // Páginas bloqueadas por parâmetro ?page=
    $blocked_pages_zadmin = [
        'sucuriscan',
        'whl_settings',
        'wps-limit-login',
        'acf-field-group',
    ];

    $blocked_pages_others = array_merge($blocked_pages_zadmin, [
        'plugins',
        'theme-editor',
        'plugin-editor',
    ]);

    $current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
    $current_file = basename($_SERVER['PHP_SELF']);

    $pages_to_check = ($login === 'Z@Padmin') ? $blocked_pages_zadmin : $blocked_pages_others;

    // Bloqueia por ?page=
    foreach ($pages_to_check as $blocked) {
        if (strpos($current_page, $blocked) !== false) {
            wp_die('Acesso negado.', 'Acesso Negado', ['response' => 403]);
        }
    }

    // Bloqueia arquivos diretos para outros usuários
    if ($login !== 'Z@Padmin') {
        $blocked_files = ['plugins.php', 'themes.php', 'plugin-editor.php', 'theme-editor.php'];
        if (in_array($current_file, $blocked_files)) {
            wp_die('Acesso negado.', 'Acesso Negado', ['response' => 403]);
        }
    }
});
