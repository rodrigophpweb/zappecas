<section class="nextLaunches gridMargin" aria-labelledby="breves-lancamentos">
    <h2 id="breves-lancamentos">Breves Lançamentos</h2>
    <p class="subtitle">Compromisso em oferecer a mais completa linha de produtos automotivos do mercado.</p>

    <section class="carouselNextProducts" aria-label="Carrossel de breves lançamentos">
        <button class="btnPrevious" aria-label="Produto anterior" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M201.4 297.4C188.9 309.9 188.9 330.2 201.4 342.7L361.4 502.7C373.9 515.2 394.2 515.2 406.7 502.7C419.2 490.2 419.2 469.9 406.7 457.4L269.3 320L406.6 182.6C419.1 170.1 419.1 149.8 406.6 137.3C394.1 124.8 373.8 124.8 361.3 137.3L201.3 297.3z"/></svg>
        </button>

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

        <button class="btnNext" aria-label="Próximo produto" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M439.1 297.4C451.6 309.9 451.6 330.2 439.1 342.7L279.1 502.7C266.6 515.2 246.3 515.2 233.8 502.7C221.3 490.2 221.3 469.9 233.8 457.4L371.2 320L233.9 182.6C221.4 170.1 221.4 149.8 233.9 137.3C246.4 124.8 266.7 124.8 279.2 137.3L439.2 297.3z"/></svg>
        </button>

        <nav class="carouselNavigation" aria-label="Navegação do carrossel">
            <ul class="bullets" role="tablist">
                <!-- Bullets serão preenchidos pelo JS -->
            </ul>
        </nav>
    </section>
</section>
<?=get_template_part('partials/catalogFull')?>