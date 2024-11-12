<section class="frontPageBlog" itemscope itemtype="https://schema.org/Blog">
    <h2 itemprop="headline">Posts da Semana</h2>
    <span class="subtitle" itemprop="description">Informações e dicas relevantes sobre o mercado automotivo.</span>
    <div class="posts">

        <?php
            $args = ['post_type' => 'post'];
            $the_query = new WP_Query( $args ); 
            if ( $the_query->have_posts() ) : 
                while ( $the_query->have_posts() ) :
                $the_query->the_post();
        ?>
            <article itemscope itemtype="https://schema.org/BlogPosting">
                <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <img width="300" src="<?php the_post_thumbnail_url('medium')?>" alt="<?php the_title()?>" itemprop="url">
                </figure>
                <?php the_title('<h3 itemprop="headline">','</h3>')?>
                <div itemprop="articleBody"><?php the_excerpt();?></div>
                <a href="<?php the_permalink();?>" title="Sabia mais - <?php the_title()?>" itemprop="url">Saiba mais</a>            
            </article>
        <?php 
            endwhile;
            wp_reset_postdata();
        ?>
        <?php else : ?>
            <h1>Não existe Posts Cadastrados cadastrados</h1>
        <?php endif; ?>
    </div>
    <a href="<?=site_url()?>/blog" title="Veja todos os Posts" itemprop="url" class="allPosts">Veja todos os Posts</a>
</section>
