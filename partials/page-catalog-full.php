<section class="catalogOfProducts gridMargin">
    <header class="pageHeader">
        <h2 itemprop="name">Confira agora todos os nossos produtos </h2>
        <div itemprop="description"><?php the_content()?></div>
    </header>
    <search class="catalogfilters">
        <h2>Bem vindo ao nosso catálogo de produtos</h2>
        <div class="filters">
            <label for="filter-linha">Filtrar por Linha:</label>
            <select id="filter-linha" name="linha">
                <option value="">Todas as Linhas</option>
                <?php
                    $linhas = get_terms(['taxonomy' => 'linha', 'hide_empty' => false]);
                    foreach ($linhas as $linha) {
                        echo '<option value="' . esc_attr($linha->slug) . '">' . esc_html($linha->name) . '</option>';
                    }
                ?>
            </select>

            <label for="filter-fabricante">Filtrar por Fabricante:</label>
            <select id="filter-fabricante" name="fabricante">
                <option value="">Todos os Fabricantes</option>
                <?php
                    $fabricantes = get_terms(['taxonomy' => 'fabricante', 'hide_empty' => false]);
                    foreach ($fabricantes as $fabricante) {
                        echo '<option value="' . esc_attr($fabricante->slug) . '">' . esc_html($fabricante->name) . '</option>';
                    }
                ?>
            </select>

            <label for="search-codigo">Buscar por Código:</label>
            <input type="text" id="search-codigo" name="codigo" placeholder="Digite o código do produto - 1556">
        </div>
    </search>
</section>

<?php
    $paged        = max(1, get_query_var('paged')); // Pega a página atual
    $per_page     = 20;
    $offset_total = ($paged - 1) * $per_page;

    $termos = get_terms([
        'taxonomy'   => 'linha',
        'hide_empty' => true
    ]);

    $produtos    = [];
    $ids_usados  = [];
    $termo_index = 0;
    $passos      = 0;

    // Avança o offset inicial para começar da página correta
    while ($passos < $offset_total) {
        $query = new WP_Query([
            'post_type'      => 'produto',
            'posts_per_page' => 1,
            'tax_query'      => [[
                'taxonomy' => 'linha',
                'field'    => 'slug',
                'terms'    => $termos[$termo_index % count($termos)]->slug,
            ]],
            'post__not_in' => $ids_usados,
            'orderby'      => 'date',
            'order'        => 'DESC',
        ]);

        if ($query->have_posts()) {
            $post = $query->posts[0];
            $ids_usados[] = $post->ID;
            $passos++;
        }

        $termo_index++;
        wp_reset_postdata();

        if ($termo_index >= count($termos) * 5) break; // trava de segurança
    }

    // Agora busca os produtos da página atual
    $produtos = [];
    $passos   = 0;
    while (count($produtos) < $per_page) {
        $query = new WP_Query([
            'post_type'      => 'produto',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'tax_query'      => [[
                'taxonomy' => 'linha',
                'field'    => 'slug',
                'terms'    => $termos[$termo_index % count($termos)]->slug,
            ]],
            'post__not_in' => $ids_usados,
            'orderby'      => 'date',
            'order'        => 'DESC',
        ]);

        if ($query->have_posts()) {
            $post = $query->posts[0];
            $produtos[]   = $post;
            $ids_usados[] = $post->ID;
        }

        $termo_index++;
        wp_reset_postdata();

        if ($termo_index >= count($termos) * 10) break; // trava de segurança
    }

    // Total de produtos para a paginação
    $total_produtos = wp_count_posts('produto')->publish;
    $total_pages    = ceil($total_produtos / $per_page);
?>

<section id="listProducts" class="product-grid-fallback gridMargin">
    <?php foreach ($produtos as $post) : setup_postdata($post); ?>
        <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', ['alt' => get_the_title(), 'loading' => 'lazy', 'itemprop' => 'url']); ?>                            
                <?php endif; ?>
                <figcaption>
                    <meta itemprop="url" content="<?php the_permalink(); ?>">
                    <h3 itemprop="name"><?php the_field('codeProduct'); ?></h3>
                    <div class="descriptionProducts" itemprop="description"><?= get_the_content(); ?></div>
                    <a href="<?= esc_url(get_the_permalink()) ?>" title="Mais informações sobre <?= esc_html(get_field('codeProduct')) ?>">Mais informações</a>
                </figcaption>
            </figure>
        </article>
    <?php endforeach; wp_reset_postdata(); ?>
</section>

<nav id="pagination" class="pagination">
    <?php
        echo paginate_links([
            'total'     => $total_pages,
            'current'   => $paged,
            'format'    => '?paged=%#%',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
        ]);
    ?>
</nav>

<?=get_template_part('partials/carouselNextProducts');?>
