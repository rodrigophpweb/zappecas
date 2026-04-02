<?php
    get_header();

    $pages_templates = [        
        'a-empresa'         => [
            'company-about',
            'company-principles',
            'company-collaborators',
            'company-your-numbers',
            'company-market-served',
            'company-policy-of-quality',
            'company-quality-certification',
            'company-technology',            
        ],
        'produtos'                      => ['product'],
        'catalogo'                      => ['catalog-full'],
        'blog'                          => ['blog'],
        'representantes'                => ['representant-map-brazil'],
        'contato'                       => ['contact-info'],
        'trabalhe-conosco'              => ['work-with-us'],
        'solicitar-catalogo-impresso'   => ['printed-catalog'],
        'politica-de-privacidade'       => ['privacy-policy'],
    ];
?>

<main>
    <?php
        get_template_part('partials/page', 'sub-header');
        $current_page = basename(get_permalink());
        if (array_key_exists($current_page, $pages_templates)) {
            foreach ($pages_templates[$current_page] as $template) {
                get_template_part('partials/page', $template);
            }
        }
        get_template_part('partials/page', 'catalog-products');
    ?>
</main>
<?php get_footer(); ?>
