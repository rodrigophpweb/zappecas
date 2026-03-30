<?php
    function filtrar_catalogo_callback() {
        check_ajax_referer('load_more_jobs', 'nonce');

        $linha      = sanitize_text_field($_POST['linha'] ?? '');
        $fabricante = sanitize_text_field($_POST['fabricante'] ?? '');
        $codigo     = sanitize_text_field($_POST['codigo'] ?? '');
        $paged      = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;
        $per_page   = 20;

        $meta_query = [];
        if (!empty($codigo)) {
            $meta_query[] = [
                'key'     => 'codeProduct',
                'value'   => $codigo,
                'compare' => 'LIKE'
            ];
        }

        $tax_query = ['relation' => 'AND'];

        if (!empty($linha)) {
            $tax_query[] = [
                'taxonomy' => 'linha',
                'field'    => 'slug',
                'terms'    => $linha,
            ];
        }

        if (!empty($fabricante)) {
            $tax_query[] = [
                'taxonomy' => 'fabricante',
                'field'    => 'slug',
                'terms'    => $fabricante,
            ];
        }

        $query_args = [
            'post_type'      => 'produto',
            'post_status'    => 'publish',
            'posts_per_page' => $per_page,
            'paged'          => $paged,
            'meta_query'     => $meta_query,
            'tax_query'      => $tax_query,
        ];

        $query = new WP_Query($query_args);

        ob_start();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
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
                <?php
            }
        } else {
            echo '<p>Nenhum produto encontrado.</p>';
        }

        $output = ob_get_clean();
        // Paginação
        $pagination = paginate_links([
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'format'    => '?paged=%#%',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type'      => 'plain'
        ]);

        wp_send_json_success([
            'html'        => $output,
            'max_num'     => $query->max_num_pages,
            'pagination' => $pagination
        ]);
    }

    // AJAX para buscar produtos com filtro
    add_action('wp_ajax_filtrar_catalogo', 'filtrar_catalogo_callback');
    add_action('wp_ajax_nopriv_filtrar_catalogo', 'filtrar_catalogo_callback');