<?php
/**
 * Template Name: Produto
 * Template Post Type: produto
 *
 * @package WordPress
 * @subpackage seu_tema
 * @since seu_tema 1.0
 */
get_header(); ?>
<section class="singleProduct" itemscope itemtype="http://schema.org/Product">
    <h1 itemprop="name">Nossos produtos</h1>
    <nav aria-label="breadcrumb">
        <ol>
            <li><a href="/" itemprop="breadcrumb">Home</a></li>
            <li><a href="/contato" itemprop="breadcrumb">Contato</a></li>
        </ol>
    </nav>
</section>

<section class="product" itemscope itemtype="http://schema.org/Product">
    <?php the_title('<h2 itemprop="name">', '</h2>')?>
    <article>
        <figure>            
            <!-- get post thumbnail full  with lazy-->
            <?php the_post_thumbnail('full')?>

        </figure>
        <header class="productData">
            <?php $detalhes = zappecas_get_detalhes_do_conteudo(); ?>
            <ul>
                <li><strong>Montadora: </strong><span itemprop="brand"><?= ($terms = get_the_terms(get_the_ID(), 'fabricante')) && !is_wp_error($terms) ? implode(', ', wp_list_pluck($terms, 'name')) : '' ?></span></li>
                <li><strong>N. Original: </strong><span itemprop="productID"><?php the_field('codeProduct')?></span></li>
                <li><strong>Descrição: </strong><span itemprop="description"><?=esc_html($detalhes['descricao'])?></span></li>
                <li><strong>Aplicação: </strong><span itemprop="model"><?=esc_html($detalhes['aplicacao'])?></span></li>
                <li><strong>Categoria: </strong><span itemprop="category"><?= ($terms = get_the_terms(get_the_ID(), 'fabricante')) && !is_wp_error($terms) ? implode(', ', wp_list_pluck($terms, 'name')) : '' ?></span></li>
            </ul>
        </header>
    </article>

    <nav class="selectLineProduct" aria-label="Selecionar Linha do Produto" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <form action="">
            <label for="product-line">Selecione a Linha do Produto:</label>
            <select name="product-line" id="product-line" itemprop="about">
                <option value="">Selecione</option>
                <option value="bieletas" itemprop="itemListElement">Bieletas</option>
                <option value="bucha-do-eixo" itemprop="itemListElement">Bucha do eixo</option>
                <option value="suporte-do-cambio" itemprop="itemListElement">Suporte do câmbio</option>
            </select>
            <button type="submit" aria-label="Pesquisar produtos">></button>
        </form>
    </nav>    
</section>

<section class="detailedProductInformation">
    <nav role="tablist" aria-label="Aba de Informações Detalhadas do Produto">
        <button role="tab" aria-selected="true" aria-controls="tab1" id="tab1-tab">Descrição</button>
        <button role="tab" aria-selected="false" aria-controls="tab2" id="tab2-tab">Informações adicionais</button>
    </nav>

    <article id="tab1" role="tabpanel" aria-labelledby="tab1-tab" class="tab" aria-hidden="false" itemscope itemtype="http://schema.org/Product">
        <h3>Descrição do produto</h3>
        <p itemprop="description">Conteúdo para a aba Descrição</p>
    </article>
    <article id="tab2" role="tabpanel" aria-labelledby="tab2-tab" class="tab" aria-hidden="true" itemscope itemtype="http://schema.org/Product">
        <h3>Informações adicionais</h3>
        <p><strong>Mês de lançamento: </strong><span itemprop="releaseDate">12/2002</span></p>
    </article>
</section>

<?php get_footer(); ?>
