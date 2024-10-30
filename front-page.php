<?php get_header();?>

    <main>
        <?php
            get_template_part('partials/front','page-hero');
            get_template_part('partials/front','page-about');
            get_template_part('partials/front','page-catalog-products');
            //get_template_part('partials/front','page-releases');
            get_template_part('partials/front','page-blog');
        ?>
    </main>
<?php get_footer();

