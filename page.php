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
        ?>
    </main>

    <?php get_footer();