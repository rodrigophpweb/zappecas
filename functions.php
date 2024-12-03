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
    wp_enqueue_style('google-fonts-alt', 'https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', [], null);

    // Conditionally load styles for specific pages
    $pages = [
        'home'              => 'front-page.css',
        'a-empresa'         => 'a-empresa.css',
        'blog'              => 'blog.css',
        'representantes'    => 'representantes.css',
        'contato'           => 'contato.css',
        'trabalhe-conosco'  => 'trabalhe-conosco.css',
    ];

    foreach ($pages as $page => $css) {
        if (is_page($page)) {
            wp_enqueue_style($page, get_template_directory_uri() . '/assets/css/pages/' . $css);
        }
    }

    // Load styles for single post
    if (is_single()) {
        wp_enqueue_style('single-post', get_template_directory_uri() . '/assets/css/pages/single.css');
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

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Configurações Globais',
        'menu_title'    => 'Configurações Globais',
        'menu_slug'     => 'configuracoes-globais',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/representante', array(
        'methods' => 'GET',
        'callback' => 'get_representantes',
    ));
});

function get_representantes($data) {
    // Recebendo o estado enviado
    $state = $data['state'];
    
    // Ajuste do meta_query para usar LIKE se for necessário corresponder parcialmente
    $args = array(
        'post_type' => 'representante',
        'meta_query' => array(
            array(
                'key' => 'stateRepresentant', // A chave do campo ACF que armazena o estado
                'value' => $state,
                'compare' => 'LIKE'  // Usando LIKE para buscar parcialmente
            )
        )
    );
    
    // Realizando a consulta no banco
    $representantes = new WP_Query($args);
    
    // Preparando o array de resultados
    $result = array();
    
    // Verificando se há resultados e os adicionando ao array
    if($representantes->have_posts()) {
        while ($representantes->have_posts()) {
            $representantes->the_post();
            $result[] = array(
                'title' => get_the_title(), // Título da postagem
                'acf' => array(
                    'nameRepresentant' => get_field('nameRepresentant'), // Campo ACF
                    'contactRepresentant' => get_field('contactRepresentant'), // Campo ACF
                    'mailRepresentant' => get_field('mailRepresentant'), // Campo ACF
                ),
            );
        }
    }
    
    // Retornando os resultados
    return $result;
}

function estimated_reading_time() {
    $content = get_the_content();
    $word_count = str_word_count(strip_tags($content));
    $words_per_minute = 200;
    $reading_time = ceil($word_count / $words_per_minute);
    return $reading_time . ' minutos de leitura';
}

add_filter('rest_representante_query', 'filter_representants_by_state', 10, 2);

function linkPhone(){
    $phone = esc_html(get_field('phoneWebsite', 'option'));
    $phonelink = preg_replace('/[^0-9+]/', '', $phone);
    echo $phonelink;
}

// Cores para o sistema
function dynamic_colors_css() {
    $primary_color = get_field('primary', 'option'); // Usa o ACF para obter a cor primaria
    $secondary_color = get_field('secondary', 'option'); // Usa o ACF para obter a cor secundaria
    $light_color = get_field('light', 'option'); // Usa o ACF para obter a cor secundaria
    $dark_color = get_field('dark', 'option'); // Usa o ACF para obter a cor secundaria
    $text_color = get_field('textColor', 'option'); // Usa o ACF para obter a cor secundaria

    if ($primary_color && $secondary_color) {
        echo "<style>
            :root {
                --primary: $primary_color;
                --secondary: $secondary_color;
                --light: $light_color;
                --dark: $dark_color;
                --text-color: $text_color;

            }
        </style>";
    }
}
add_action('wp_head', 'dynamic_colors_css');

function display_post_blog($post) {
    // Extrai atributos para legibilidade
    $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'medium');
    $title = get_the_title($post);
    $permalink = get_permalink($post->ID);
    $excerpt = get_the_excerpt($post->ID);
?>
    <article itemscope itemtype="https://schema.org/BlogPosting">
        <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <img width="300" src="<?=esc_url($thumbnail_url)?>" alt="<?=esc_attr($title)?>" itemprop="url" />
        </figure>
        <h3 itemprop="headline"><?=esc_html($title)?></h3>
        <div itemprop="articleBody"><p><?=esc_html($excerpt)?></p></div>
        <a href="<?=esc_url($permalink)?>" title="<?=esc_attr($title)?>" itemprop="url">Saiba mais</a>
    </article>
<?php
}

function display_banner($banner, $index) {
    // Extrai atributos para legibilidade
    $thumbnail_url = get_the_post_thumbnail_url($banner->ID, 'full');
    $title = get_the_title($banner);
?>
    <figure data-index="<?= esc_attr($index) ?>">
        <img width="1920" src="<?= esc_url($thumbnail_url) ?>" alt="<?= esc_attr($title) ?>" loading="lazy">
    </figure>
<?php
}






