<section class="blogContent gridMargin">
    <h2>Nosso Blog</h2>
    <div class="posts">
    <?php
        $args = [
            'post_type' => 'post',
        ];
        // the query.
        $the_query = new WP_Query( $args ); ?>

        <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <article>
                    <figure>
                        <?php the_post_thumbnail('medium')?>
                    </figure>
                    <?php the_title( '<h3>', '</h3>' ); ?>
                    <?php the_excerpt()?>
                    <a href="<?php the_permalink()?>" title="<?php the_title()?>">Saiba mais</a>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>

    </div>
</section>