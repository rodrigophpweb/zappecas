<section class="singleProduct" itemscope itemtype="http://schema.org/Product">
    <h1 itemprop="name"><?php the_title()?></h1>
    <nav aria-label="breadcrumb">
        <ol>
            <li><a href="/" itemprop="breadcrumb">Home</a></li>
            <li><a href="/contato" itemprop="breadcrumb">Contato</a></li>
        </ol>
    </nav>
</section>

<section class="product" itemscope itemtype="http://schema.org/Product">
    <h2 itemprop="name"><?php the_title()?></h2>
    <article>
        <figure>
            <img src="caminho/da/sua/foto.jpg" alt="Foto do Produto" itemprop="image">
        </figure>
        <header class="productData">
            <ul>
                <li><strong>Montadora: </strong><span itemprop="brand">GM</span></li>
                <li><strong>N. Original: </strong><span itemprop="productID">95032352</span></li>
                <li><strong>Descrição: </strong><span itemprop="description">Suporte Dianteiro do Motor Lado Esquerdo - Transm. Manual</span></li>
                <li><strong>Aplicação: </strong><span itemprop="model">COBALT 11/…, SONIC 13/14, ONIX/PRISMA/SPIN 13/…</span></li>
                <li><strong>Categorias: </strong><span itemprop="category">BIELETA, SUPORTE DO MOTOR</span></li>
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
