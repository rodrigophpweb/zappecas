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
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [], null);

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

// Adiciona a coluna 'Cidade' à listagem do post type 'representante'
add_filter('manage_representante_posts_columns', 'add_city_column');
function add_city_column($columns) {
    $columns['city_representant'] = __('Cidade', 'text_domain');
    return $columns;
}

// Preenche a coluna 'Cidade' com os valores do campo ACF
add_action('manage_representante_posts_custom_column', 'fill_city_column', 10, 2);
function fill_city_column($column, $post_id) {
    if ($column === 'city_representant') {
        $city = get_field('cityRepresentant', $post_id);
        echo esc_html($city);
    }
}

// Permite a ordenação pela coluna 'Cidade'
add_filter('manage_edit-representante_sortable_columns', 'sortable_city_column');
function sortable_city_column($columns) {
    $columns['city_representant'] = 'city_representant';
    return $columns;
}

// Adiciona a cláusula de ordenação para a consulta
add_action('pre_get_posts', 'orderby_city_column');
function orderby_city_column($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('orderby') === 'city_representant') {
        $query->set('meta_key', 'cityRepresentant');
        $query->set('orderby', 'meta_value');
    }
}

/* Custom Breadcrumb*/
function custom_breadcrumb() {
    if (!is_home()) {
        echo '<nav aria-label="breadcrumb" class="breadcrumb">';
        echo '<ul itemscope itemtype="https://schema.org/BreadcrumbList">';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a href="' . home_url() . '" itemprop="item">';
        echo '<span itemprop="name">Home</span></a>';
        echo '<meta itemprop="position" content="1" />';
        echo '</li>';

        $position = 2;

        if (is_category() || is_single()) {
            $category = get_the_category();
            if ($category) {
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . get_category_link($category[0]->term_id) . '" itemprop="item">';
                echo '<span itemprop="name">' . $category[0]->name . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }

            if (is_single()) {
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<span itemprop="name">' . get_the_title() . '</span>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                $ancestors = get_post_ancestors($post->ID);
                foreach ($ancestors as $ancestor) {
                    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                    echo '<a href="' . get_permalink($ancestor) . '" itemprop="item">';
                    echo '<span itemprop="name">' . get_the_title($ancestor) . '</span></a>';
                    echo '<meta itemprop="position" content="' . $position++ . '" />';
                    echo '</li>';
                }
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
    }
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/representante', array(
        'methods' => 'GET',
        'callback' => 'get_representantes',
    ));
});

function get_representantes($data) {
    $state = $data['state'];
    
    $args = array(
        'post_type' => 'representante',
        'meta_query' => array(
            array(
                'key' => 'stateRepresentant',
                'value' => $state,
                'compare' => '='
            )
        )
    );
    
    $representantes = new WP_Query($args);
    
    $result = array();
    
    if($representantes->have_posts()) {
        while ($representantes->have_posts()) {
            $representantes->the_post();
            $result[] = array(
                'title' => get_the_title(), // Certifique-se de que isso está aqui
                'acf' => array(
                    'nameRepresentant' => get_field('nameRepresentant'),
                    'contactRepresentant' => get_field('contactRepresentant'),
                    'mailRepresentant' => get_field('mailRepresentant'),
                ),
            );
        }
    }
    return $result;
}




