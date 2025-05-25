<?php

/*
* Função para remover o Yoast SEO do admin para editores
* @return void
*/

function remover_yoast_para_editores() {
    if (current_user_can('editor')) {
        // Remove o menu do Yoast do admin
        remove_menu_page('wpseo_dashboard');

        // Remove a barra do Yoast da tela de edição de posts/páginas
        add_filter('wpseo_accessible_post_types', function ($post_types) {
            return [];
        });

        // Remove a metabox do Yoast nas edições
        add_action('add_meta_boxes', function () {
            remove_meta_box('wpseo_meta', 'post', 'normal');
            remove_meta_box('wpseo_meta', 'page', 'normal');
            remove_meta_box('wpseo_meta', 'produto', 'normal'); // caso use CPT "produto"
        }, 99);
    }
}
add_action('admin_menu', 'remover_yoast_para_editores', 999);
