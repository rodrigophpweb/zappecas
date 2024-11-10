<section class="subHeaderPages gridMargin">
    <?php if(!is_page()):?>
        <h1 itemprop="name">Blog</h1>
    <?php else:?>
        <?php the_title('<h1 itemprop="name">','</h1>')?>
    <?php endif;?>
    <?php custom_breadcrumb(); ?>
</section>