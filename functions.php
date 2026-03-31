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
    register_nav_menu( 'main_menu', 'Menu do cabeçalho.' );
    register_nav_menu( 'footer', 'Menu do rodape' );
}

add_action('init', 'zappecas_nav_menus');

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

// Arquivos de segurança — carregam cedo
$security_files = [
    '.inc/admin-restrictions.php',
    '.inc/block-wp-performance-analytics.php',
    '.inc/protect-htaccess.php',
];

foreach ($security_files as $file) {
    $file_path = get_template_directory() . '/' . $file;
    if (file_exists($file_path)) {
        include_once $file_path;
    }
}

// Arquivos do tema — carregam no momento certo
add_action('after_setup_theme', function() {
    $inc_files = [
        '.inc/display-banner.php',
        '.inc/breadcrumb.php',
        '.inc/format-phones.php',
        '.inc/details-content-product.php',
        '.inc/get-representants.php',
        '.inc/style-scripts.php',
        '.inc/custom-scripts.php',
        '.inc/custom-colors.php',
        '.inc/filter-product-page.php',
        '.inc/filter-product.php',
        '.inc/filter-catalog.php',
        '.inc/show-text-description-product.php',
        '.inc/filter-order-from-ctp-representants.php',
        '.inc/user-editor-remove-yoast-seo.php',
        '.inc/page-custom.php',
        '.inc/ctp/representatives.php',
        '.inc/fields/page-front.php',
        '.inc/fields/the-company.php',
        '.inc/fields/banners.php',
        '.inc/fields/page-products.php',
        '.inc/fields/products.php',
        '.inc/fields/representatives.php',
        '.inc/fields/work-with-us.php',
    ];

    foreach ($inc_files as $file) {
        $file_path = get_template_directory() . '/' . $file;
        if (file_exists($file_path)) {
            include_once $file_path;
        }
    }
});