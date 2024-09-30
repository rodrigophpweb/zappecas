<?php
    get_header();

    $pages = [
        'a-empresa',
        'blog',
        'representantes',
        'contato',
        'trabalhe-conosco'
    ];
    ?>

    <main>
        <?php
            // All pages
            get_template_part('partials/page','sub-header');

            if (is_page('contato')) {
                get_template_part('partials/page','contact-info');
            }
            if (is_page('representantes')) {
                get_template_part('partials/page','representant-map-brazil');
            }

            if (is_page('trabalhe-conosco')){
                get_template_part('partials/page','work-with-us');
            }
        ?>
    </main>

    <?php get_footer();