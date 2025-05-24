<?php get_header(); ?>

<main>
    <?php get_template_part('partials/page', 'sub-header'); ?>

    <search class="filters gridMargin">
        <select id="filter-line">
            <option value="">Todos os Tipos</option>
            <?php
            $terms = get_terms(['taxonomy' => 'line', 'hide_empty' => false]);
            foreach ($terms as $term) {
                echo "<option value='{$term->slug}'>{$term->name}</option>";
            }
            ?>
        </select>

        <select id="filter-fabricante">
            <option value="">Todos os Fabricantes</option>
            <?php
            $fabricantes = get_terms(['taxonomy' => 'fabricante', 'hide_empty' => false]);
            foreach ($fabricantes as $term) {
                echo "<option value='{$term->slug}'>{$term->name}</option>";
            }
            ?>
        </select>

        <input type="text" id="search-term" placeholder="Buscar produto...">
    </search>

    <?php if (have_posts()) : ?>
        <section class="product-grid-fallback gridMargin">
            <?php while (have_posts()) : the_post(); ?>
                <article class="product-card" itemscope itemtype="https://schema.org/Product">
                    <figure>
                        <?php if (has_post_thumbnail()) : ?>
                            <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <?php the_post_thumbnail('medium', ['alt' => get_the_title(), 'itemprop' => 'url']); ?>
                            </div>
                        <?php endif; ?>
                        <figcaption>
                            <meta itemprop="url" content="<?php the_permalink(); ?>">
                            <span><strong>Nome do produto: </strong><?php the_title('<h3 itemprop="name">','</h3>'); ?></span><br>
                            <span itemprop="sku"><strong>Código do produto: </strong><?php the_field('codeProduct'); ?></span>
                            <div itemprop="description"><?=get_the_content()?></div>
                        </figcaption>
                    </figure>
                </article>
            <?php endwhile; ?>
        </section>
    <?php else : ?>
        <p>Nenhum produto encontrado para essa linha.</p>
    <?php endif; ?>

    <nav id="pagination" class="pagination"></nav>

    <?php get_template_part('partials/page', 'catalog-products'); ?>
</main>

<?php get_footer(); ?>
