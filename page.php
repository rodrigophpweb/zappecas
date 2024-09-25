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
            if (is_page('contato')) {
                get_template_part('partials/page','contact-header');
                get_template_part('partials/page','contact-info');
            }
            if (is_page('representantes')) {
                get_template_part('partials/page','representant-map-brazil');
            }
        ?>
    </main>

    <?php get_footer();