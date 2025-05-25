<?php get_header();?>

    <main>
    <?php
        foreach (['page-hero', 'page-about', 'page-carouselNextProducts' ,'page-catalog-products', 'page-blog'] as $part) {
            get_template_part('partials/front', $part);
        }
    ?>
    </main>
<?php get_footer();
