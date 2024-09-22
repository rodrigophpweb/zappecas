<?php
//Show Image feature in post_types
add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array(
    'height' => 137,
    'width' => 225,
    'flex-height' => true,
    'flex-width' => true,
));

function zappecas_nav_menus(){
	/**
	 * Adiciona ao tema áreas de menu que podem ser configuradas via administração
	 * 
	 * @since Essential
	 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
	 */
	register_nav_menu( 'main_menu', 'Menu do cabeçalho.' );
	register_nav_menu( 'footer', 'Menu do rodape' );
}



// Show menu panel in admin
add_action('init', 'zappecas_nav_menus');

// Function load styles and scripts
function load_styles_and_scripts() {
    // Preconnect to Google Fonts
    wp_enqueue_style('google-fonts-preconnect1', 'https://fonts.googleapis.com', [], null);
    wp_enqueue_style('google-fonts-preconnect2', 'https://fonts.gstatic.com', [], null, 'crossorigin');
    
    // Load Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [], null);

    // Conditionally load styles for specific pages
    $pages = [
        'home'              => 'front-page.css',
        'a-empresa'         => 'a-empresa.css',
        'blog'              => 'blog.css',
        'representantes'    => 'representantes.css',
        'contato'           => 'contato.css',
        'trabalhe-conosco'  => 'trabalhe-conosco.css'
    ];

    foreach ($pages as $page => $css) {
        if (is_page($page)) {
            wp_enqueue_style($page, get_template_directory_uri() . '/assets/css/pages/' . $css);
        }
    }
}
add_action('wp_enqueue_scripts', 'load_styles_and_scripts');

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/app.js', array(), null, true);
    wp_localize_script('custom-js', 'custom_script_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_jobs')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Função para permitir o upload de arquivos SVG
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');