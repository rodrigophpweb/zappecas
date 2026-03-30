<?php

/* 
    * Add a custom options page for ACF
    * 
    * This code adds a custom options page to the WordPress admin area using the Advanced Custom Fields (ACF) plugin.
    * The options page is titled "Configurações Globais" and can be accessed from the admin menu.
    * 
    * @package WordPress
*/

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Configurações Globais',
        'menu_title'    => 'Configurações Globais',
        'menu_slug'     => 'configuracoes-globais',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}