<?php
function ocultar_usuario_rodrigo_para_zapadmin($user_search) {
    $usuario_logado = wp_get_current_user();

    if ($usuario_logado->user_login === 'Z@Padmin') {
        global $wpdb;
        $user_search->query_where .= " AND {$wpdb->users}.user_login != 'rodrigo'";
    }
}
add_action('pre_user_query','ocultar_usuario_rodrigo_para_zapadmin');

/**
 * Remove menu items for the user "Z@Padmin"
 * This function hides specific admin menu items for the user with the username "Z@Padmin".
 * It is hooked to the 'admin_menu' action with a priority of 110 to ensure it runs after other menu items are added.
 * @since 1.0.0
 * @return void
 * @link https://developer.wordpress.org/reference/hooks/admin_menu/
 * @see https://developer.wordpress.org/reference/functions/remove_menu_page/
 */
function ocultar_itens_para_zapadmin() {
    $usuario = wp_get_current_user();

    if ($usuario->user_login === 'Z@Padmin') {

        // Oculta o Editor de Tema
        remove_submenu_page('themes.php', 'theme-editor.php');

        // Oculta o Editor de Plugin
        remove_submenu_page('plugins.php', 'plugin-editor.php');

        // Remove "Site Kit" do menu
        remove_menu_page('googlesitekit-dashboard');

        // Remove "All-in-One WP Migration"
        remove_menu_page('ai1wm_export');

        // Remove "Bing Webmaster Tools"
        remove_menu_page('bing-webmaster-tools');
    }
}
add_action('admin_menu', 'ocultar_itens_para_zapadmin', 110);

