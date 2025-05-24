<section class="pageProduct" itemscope itemtype="http://schema.org/Product">
    <aside class="productList">
        <h2>Lista de Produtos</h2>
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

<section class="nextLaunches gridMargin" aria-labelledby="breves-lancamentos">
    <h2 id="breves-lancamentos">Breves Lançamentos</h2>
    <p class="subtitle">Compromisso em oferecer a mais completa linha de produtos automotivos do mercado.</p>

    <section class="carouselNextProducts" aria-label="Carrossel de breves lançamentos">
        <button class="btnPrevious" aria-label="Produto anterior" type="button">&lt;</button>

        <article class="carouselWrapper">
            <?php
            $args = [
                'post_type' => 'produto',
                'posts_per_page' => -1,
                'tax_query' => [
                    [
                        'taxonomy' => 'fabricante',
                        'field' => 'slug',
                        'terms' => 'breve-lancamentos',
                    ],
                ],
            ];
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                echo '<header class="carouselContent">';

                while ($query->have_posts()) : $query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url();
                    ?>
                    <figure class="carouselItem" itemscope itemtype="https://schema.org/Product">
                        <?php if ($thumbnail_url) : ?>
                            <img src="<?= esc_url($thumbnail_url) ?>" alt="<?= esc_attr(get_the_title()) ?>" itemprop="image">
                        <?php endif; ?>
                        <figcaption>
                            <h3 itemprop="name"><?= get_the_title(); ?></h3>
                            <span itemprop="sku"><strong>Código do produto: </strong><?= esc_html(get_field('codeProduct')) ?></span>
                            <div class="productDescription" itemprop="description"><?= get_the_content() ?></div>

                            <meta itemprop="brand" content="<?= esc_attr(get_the_terms(get_the_ID(), 'fabricante')[0]->name ?? ''); ?>" />
                            
                            <a href="<?= esc_url(get_the_permalink()) ?>" class="saiba-mais-btn" title="Mais informações sobre <?= esc_attr(get_the_title()) ?>" itemprop="url">Mais informações</a>
                        </figcaption>
                    </figure>
                    <?php
                endwhile;

                echo '</header>'; // .carouselContent
                wp_reset_postdata();
            else :
                echo '<p>Nenhum produto encontrado.</p>';
            endif;
            ?>
        </article>

        <button class="btnNext" aria-label="Próximo produto" type="button">&gt;</button>

        <nav class="carouselNavigation" aria-label="Navegação do carrossel">
            <ul class="bullets" role="tablist">
                <!-- Bullets serão preenchidos pelo JS -->
            </ul>
        </nav>
    </section>
</section>

