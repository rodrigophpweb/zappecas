<section class="subHeaderPages gridMargin">
    <?php if (is_tax('linha')): ?>
        <?php
            $term = get_queried_object();
            $term_name = $term->name;
        ?>
        <h1 itemprop="name">Produtos (<?php echo esc_html($term_name); ?>)</h1>
    
    <?php elseif (!is_page()): ?>
        <h1 itemprop="name">Blog</h1>

    <?php else: ?>
        <?php the_title('<h1 itemprop="name">', '</h1>'); ?>
    <?php endif; ?>

    <?php custom_breadcrumb(); ?>
</section>
