<section class="blogContent gridMargin">
    <h2>Nosso Blog</h2>
    <div class="posts">
    <?php
        $args = ['post_type' => 'post'];
        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <article itemscope itemtype="https://schema.org/BlogPosting">
                    <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <img width="300" src="<?php the_post_thumbnail_url('medium')?>" alt="<?php the_title()?>" itemprop="url">
                    </figure>
                    <?php the_title( '<h3 itemprop="headline">', '</h3>' ); ?>
                    <div itemprop="articleBody"><?php the_excerpt()?></div>
                    <a href="<?php the_permalink()?>" title="<?php the_title()?>" itemprop="url">Saiba mais</a>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <h1>Não existe Posts Cadastrados cadastrados</h1>
        <?php endif; ?>
    </div>
</section>