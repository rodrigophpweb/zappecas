<?php
    get_header();

    // Definindo os templates parciais para cada página
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
        'blog'              => ['blog'],
        'representantes'    => ['representant-map-brazil'],
        'contato'           => ['contact-info'],
        'trabalhe-conosco'  => ['work-with-us']
    ];
?>

<main>
    <?php
        // Sub-header para todas as páginas
        get_template_part('partials/page', 'sub-header');

        // Obtém o slug da página atual
        $current_page = basename(get_permalink());

        // Verifica se a página tem templates definidos no array
        if (array_key_exists($current_page, $pages_templates)) {
            foreach ($pages_templates[$current_page] as $template) {
                // Carrega cada template da lista
                get_template_part('partials/page', $template);
            }
        }
        // Inclui o template page-catalog-products no final de todas as páginas
        get_template_part('partials/page', 'catalog-products');
    ?>
</main>

<?php get_footer(); ?>
