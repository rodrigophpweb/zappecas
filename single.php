<?php get_header()?>

<main>
    <?php get_template_part('partials/page', 'sub-header')?>
    <section id="<?php the_ID() ?>" class="singleContent gridMargin">
        <?php if (have_posts()) : the_post(); ?>
            <header>
                <h2><?php the_title(); ?></h2>
                <p>
                    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('j M, Y'); ?></time>
                    <span class="separador">|</span>
                    <span property="articleSection" typeof="Duration">Tempo estimado de leitura: <?php echo estimated_reading_time()?></span>
                </p>
            </header>
            <article>
                <figure><?php the_post_thumbnail(); ?></figure>
                <?php the_content(); ?>
            </article>
        <?php endif; ?>
    </section>

    <?php get_template_part('partials/page', 'catalog-products');?>

    <!-- <section class="relatedPosts">
        <h2>Posts Relacionado</h2>

        <article>
            <div class="cards">
                <figure>
                    <?php the_post_thumbnail();?>
                </figure>
                <h3><?php the_title()?></h3>
                <p><?php the_excerpt()?></p>
                <div class="actions">
                    <p>Publicado em: <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('j M, Y'); ?></time>
                    <a href="<?php the_permalink()?>" title="<?php the_title()?>">Saiba mais</a>
                </div>
            </div>
            <ul class="bullets">
                <li></li>
            </ul>
        </article>
    </section> -->    
</main>

<?php get_footer(); ?>
