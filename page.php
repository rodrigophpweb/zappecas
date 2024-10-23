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

            if(is_page('a-empresa')) {
                get_template_part('partials/page','company-about');
                get_template_part('partials/page','company-principles');
                get_template_part('partials/page','company-collaborators');
                //get_template_part('partials/page','company-manifest');
                get_template_part('partials/page','company-your-numbers');
                get_template_part('partials/page','company-social-responsability');
                get_template_part('partials/page','company-market-served');
                get_template_part('partials/page','company-policy-of-quality');
                get_template_part('partials/page','company-quality-certification');
                get_template_part('partials/page','company-technology');
            }
        ?>
    </main>

    <?php get_footer();