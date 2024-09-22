<section class="frontPageBlog" itemscope itemtype="https://schema.org/Blog">
    <h2 itemprop="headline">Posts da Semana</h2>
    <span class="subtitle" itemprop="description">Informações e dicas relevantes sobre o mercado automotivo.</span>
    <div class="posts">

        <article itemscope itemtype="https://schema.org/BlogPosting">
            <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <img src="images/coxim-do-cambio" alt="Coxim do Câmbio" itemprop="url">
            </figure>
            <?php the_title('<h3 itemprop="headline">','</h3>')?>
            <p itemprop="articleBody"><?php the_permalink();?></p>
            <a href="<?php the_permalink();?>" title="Sabia mais - <?php the_title()?>" itemprop="url">Saiba mais</a>            
        </article>

    </div>
    <a href="<?=site_url()?>/blog" title="Veja todos os Posts" itemprop="url">Veja todos os Posts</a>
</section>
