<?php
$args = ['post_type' => 'banner'];
$the_query = new WP_Query($args);

if ($the_query->have_posts()): ?>
    <div class="hero">
        <div class="images">
            <?php while ($the_query->have_posts()): $the_query->the_post(); display_banner($post, $the_query->current_post); endwhile; ?>
        </div>
        <div class="buttons">
            <button class="prev" title="Anterior">&#10094;</button>
            <button class="next" title="Próximo">&#10095;</button>
        </div>
        <ul class="bullets">
            <?php for ($i = 0; $i < $the_query->found_posts; $i++): ?>
                <li data-index="<?= esc_attr($i) ?>"></li>
            <?php endfor; ?>
        </ul>
    </div>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <h1>Não existem banners cadastrados</h1>
<?php endif?>
