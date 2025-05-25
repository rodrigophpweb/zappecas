<section class="pageProduct" itemscope itemtype="http://schema.org/Product">
    <aside class="productList">
        <h2>Linha de Produtos</h2>
        <ul>
            <?php
            $produtos = [];
            if( have_rows('produtos_product') ):
                while( have_rows('produtos_product') ) : the_row();
                    $linha = get_sub_field('line_produt');
                    $slug = is_array($linha) ? $linha['value'] : null;
                    $label = is_array($linha) ? $linha['label'] : null;            
                    $term_link = $slug ? get_term_link($slug, 'linha') : null;

                    $produtos[] = [
                        'name' => get_sub_field('name_product'),
                        'description' => get_sub_field('description_product'),
                        'image' => get_sub_field('image_product'),
                        'linha' => [
                            'slug' => $slug,
                            'label' => $label,
                            'url' => !is_wp_error($term_link) ? $term_link : null,
                        ]
                    ];

                endwhile;

                foreach($produtos as $produto):
            ?>
                <li>
                    <a href="#<?= esc_attr($produto['name']); ?>">
                        <?= esc_html($produto['name']); ?>
                    </a>
                </li>
            <?php endforeach; endif; ?>
        </ul>
    </aside>

    <article class="productDetails">
        <?php foreach($produtos as $produto): ?>
            <figure id="<?= esc_attr($produto['name']) ?>" class="productDetail" itemscope itemtype="http://schema.org/Product">
                <meta itemprop="name" content="<?= esc_attr($produto['name']) ?>">
                <img itemprop="image"
                    src="<?= esc_url($produto['image']['url']) ?>"
                    alt="<?= esc_attr($produto['image']['alt']) ?>"
                    title="<?= esc_attr($produto['image']['alt']) ?>">

                <figcaption itemprop="description">
                    <?= $produto['description'] ?>

                    <?php if (!empty($produto['linha']['url'])): ?>
                        <span class="saibaMais">
                            <a href="<?= esc_url($produto['linha']['url']) ?>" class="saiba-mais-btn" itemprop="url">
                                Saiba mais sobre <?= esc_html($produto['linha']['label']) ?>
                            </a>
                        </span>
                    <?php endif; ?>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </article>
</section>

<?php
    get_template_part('partials/carouselNextProducts');
    get_template_part('partials/catalogFull');
?>

