<?php get_header(); ?>

<main>
    <?php get_template_part('partials/page', 'sub-header'); ?>
    
    <section class="infoFilter gridMargin">
        <h2 id="totalProdutosLinha">
            <?php
                $term = get_queried_object();
                global $wp_query;
                echo 'O total de "' . esc_html($term->name) . '" é: ' . $wp_query->found_posts;
            ?>
        </h2>

        <search class="filtro-fabricante">
            <?php
                $fabricantes = get_terms([
                    'taxonomy' => 'fabricante',
                    'hide_empty' => false,
                ]);
            ?>
            <label for="filtroFabricante">Filtrar por fabricante:</label>
            <select id="filtroFabricante">
                <option value="">Todos</option>
                <?php foreach ($fabricantes as $fabricante) : ?>
                    <option value="<?= esc_attr($fabricante->slug); ?>">
                        <?= esc_html($fabricante->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </search>
    </section>

    <?php if (have_posts()) : ?>
        <section id="resultadoProdutos" class="product-grid-fallback gridMargin">
            <?php while (have_posts()) : the_post(); ?>
                <article class="product-card" itemscope itemtype="https://schema.org/Product">
                    <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', ['alt' => get_the_title(), 'loading' => 'lazy', 'itemprop' => 'url']); ?>                            
                        <?php endif; ?>
                        <figcaption>
                            <meta itemprop="url" content="<?php the_permalink(); ?>">
                            <h3 itemprop="name"><?php the_field('codeProduct'); ?></h3>
                            <div class="descriptionProducts" itemprop="description"><?=get_the_content()?></div>
                            <a href="<?=esc_url(get_the_permalink())?>" title="Mais informações sobre <?=esc_html(get_field('codeProduct'))?>">Mais informações</a>
                        </figcaption>
                    </figure>
                </article>
            <?php endwhile; ?>
        </section>
    <?php else : ?>
        <p>Nenhum produto encontrado para essa linha.</p>
    <?php endif; ?>

    <nav id="pagination" class="pagination">
        <?php
            echo paginate_links([
                'total' => $wp_query->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ]);
        ?>
    </nav>

    <?php 
        get_template_part('partials/catalogFull');
        get_template_part('partials/page', 'catalog-products'); 
    ?>
</main>

<?php get_footer(); ?>
