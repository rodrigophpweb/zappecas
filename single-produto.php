<?php
get_header(); 
get_template_part('partials/page', 'sub-header');
?>


<section class="singleProduct gridMargin" itemscope itemtype="http://schema.org/Product">
    <?php the_title('<h2 itemprop="name">', '</h2>')?>
    <article>
        <figure>            
            <?php the_post_thumbnail('full')?>
        </figure>
        <header class="productData">
            <?php $detalhes = zappecas_get_detalhes_do_conteudo(); ?>
            <ul>
                <li><strong>N. Original: </strong><span itemprop="productID"><?php the_field('codeProduct')?></span></li>
                <li><strong>Descrição: </strong><span itemprop="description"><?=esc_html($detalhes['descricao'])?></span></li>
                <li><strong>Aplicação: </strong><span itemprop="model"><?=esc_html($detalhes['aplicacao'])?></span></li>
                <li><strong>Montadora: </strong><span itemprop="category"><?= ($terms = get_the_terms(get_the_ID(), 'fabricante')) && !is_wp_error($terms) ? implode(', ', wp_list_pluck($terms, 'name')) : '' ?></span></li>
            </ul>
        </header>
    </article>  
</section>

<section class="detailedProductInformation gridMargin">
    <article id="tab1" role="tabpanel" aria-labelledby="tab1-tab" class="tab" aria-hidden="false" itemscope itemtype="http://schema.org/Product">
        <h3>Descrição do produto</h3>

        <div itemprop="description">
            <?php exibir_texto_por_linha_produto(); ?>
        </div>
    </article>
</section>

<?php get_footer(); ?>
