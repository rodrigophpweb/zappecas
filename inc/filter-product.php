<?php
    function filtrar_produtos_callback() {
        $fabricante = sanitize_text_field($_GET['fabricante'] ?? '');
        $linha = sanitize_text_field($_GET['linha'] ?? '');
        $paged = intval($_GET['page'] ?? 1);

        $args = [
            'post_type' => 'produto', // ajuste conforme seu CPT
            'posts_per_page' => 20,
            'paged' => $paged,
            'tax_query' => [
                [
                    'taxonomy' => 'linha',
                    'field' => 'slug',
                    'terms' => $linha,
                ]
            ],
        ];

        if (!empty($fabricante)) {
            $args['tax_query'][] = [
                'taxonomy' => 'fabricante',
                'field' => 'slug',
                'terms' => $fabricante,
            ];
        }

        $query = new WP_Query($args);

        ob_start();
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
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
            <?php endwhile;
        else :
            echo '<h3>Nenhum produto encontrado para esse fabricante.</h3>';
        endif;
        $html = ob_get_clean();

        // Paginação
        $pagination = paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
            'format' => '',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type' => 'plain'
        ]);

        wp_reset_postdata();

        wp_send_json([
            'html' => $html,
            'pagination' => $pagination,
            'total' => $query->found_posts
        ]);
    }

    add_action('wp_ajax_filtrar_produtos', 'filtrar_produtos_callback');
    add_action('wp_ajax_nopriv_filtrar_produtos', 'filtrar_produtos_callback');
