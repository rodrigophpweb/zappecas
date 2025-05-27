<?php

/*
 * Função carregar estilos e scripts
 * @return void
 */

function load_styles_and_scripts() {
    // Versão randômica para evitar cache durante testes (troque por `filemtime()` no ambiente de produção)
    $version = rand(100000, 999999);

    // Preconnect to Google Fonts
    wp_enqueue_style('google-fonts-preconnect1', 'https://fonts.googleapis.com', [], null);
    wp_enqueue_style('google-fonts-preconnect2', 'https://fonts.gstatic.com', [], null, 'crossorigin');
    
    // Load Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [], null);
    wp_enqueue_style('google-fonts-alt', 'https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [], null);

    // Conditionally load styles for specific pages
    $pages = [
        'home'                          => 'front-page.css',
        'a-empresa'                     => 'a-empresa.css',
        'produtos'                      => 'produtos.css',
        'catalogo'                      => 'catalogo.css',
        'representantes'                => 'representantes.css',
        'blog'                          => 'blog.css',
        'contato'                       => 'contato.css',
        'trabalhe-conosco'              => 'trabalhe-conosco.css',
        'solicitar-catalogo-impresso'   => 'catalogo-impresso.css',
        'politica-de-privacidade'       => 'politica-privacidade.css',
    ];

    foreach ($pages as $page => $css) {
        if (is_page($page)) {
            wp_enqueue_style($page, get_template_directory_uri() . '/assets/css/pages/' . $css, [], $version);
        }
    }

    // Load styles for single post
    if (is_single()) {
        wp_enqueue_style('single-post', get_template_directory_uri() . '/assets/css/pages/single.css', [], $version);
    }

    // Load styles for single custom post type 'produto'
    if (is_singular('produto')) {
        wp_enqueue_style('single-produto', get_template_directory_uri() . '/assets/css/pages/single-produto.css', [], $version);
    }

    // Load style for taxonomy 'linhas'
    if (is_tax('linha')) {
        wp_enqueue_style('taxonomy-linhas', get_template_directory_uri() . '/assets/css/pages/taxonomy-lines.css', [], $version);
    }
}
add_action('wp_enqueue_scripts', 'load_styles_and_scripts');