<?php get_header();?>

    <main>
    <?php
        foreach (['page-hero', 'page-differences', 'page-distributorandsi', 'page-catalog-products', 'page-about', 'page-carouselNextProducts' , 'page-blog'] as $part) {
            get_template_part('partials/front', $part);
        }
    ?>
    </main>
<?php get_footer();
