<section class="frontPageReleases gridMargin">
    <h2>Lançamentos</h2>
    <span class="subtitle">Compromisso de oferecer a maior linha de produtos do Brasil</span>
    <div class="sliderCarousel">
        
        <?php
            $args = [
                'post_type'      => 'produto',      // Seu post_type
                'posts_per_page' => -1,             // Para trazer todos os produtos
                'meta_query'     => [
                    [
                        'key'     => 'lancamento',  // Nome do campo ACF
                        'value'   => '1',           // Valor para marcado como "verdadeiro"
                        'compare' => '=',           // Compara se o valor é igual a 1 (verdadeiro)
                    ],
                ],
                'orderby'         => 'date',         // Ordena pela data (data de publicação)
                'order'           => 'DESC',         // Ordem decrescente
            ];
            $the_query = new WP_Query( $args ); 

            if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
                $the_query->the_post();
        ?>
                <figure>
                    <?php the_post_thumbnail('medium')?>
                <figcaption>
                    <?=get_the_title('<h3>','</h3>')?>
                    <ul>
                        <li><strong>Montadora:</strong> <?=get_field('automakers')?></li>
                    </ul>
                    <?=get_the_content();?>
                </figcaption>
            </figure>    
        <?php 
            endwhile;
            wp_reset_postdata();
            else : 
        ?>
        <p><?php esc_html_e( 'Desculpe, nenhum produto corresponde aos seus critérios.' ); ?></p>
        <?php endif?>
        
        <div class="buttons">
            <button class="prev" title="Anterior">&#10094;</button>
            <button class="next" title="Próximo">&#10095;</button>
        </div>

        <menu class="bullets">
            <li></li>
            <li></li>
        </menu>
    </div>
</section>
