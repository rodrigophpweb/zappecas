<div class="loading-bar-container"><div class="loading-bar"></div></div>
<section class="frontPageCatalogProducts" itemscope itemtype="https://schema.org/CreativeWork">
    <h2 itemprop="headline"><?php the_field('titleProducts', 'option'); ?></h2>
    <span itemprop="about" class="subtitle"><?php the_field('subTitleProduct', 'option'); ?></span>
    <div class="content">
        <figure id="frameCatalog" class="figure-animate" itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageObject">
            <?php 
                $image = get_field('imageCatalog', 'option');
                if( !empty( $image ) ): 
            ?>
                <img width="547" src="<?=esc_url($image['url'])?>" alt="<?=esc_attr($image['alt'])?>" itemprop="contentUrl" loading="lazy" />
            <?php endif; ?>
        </figure>
        <article id="contentCatalog" class="article-animate" itemprop="mainEntity" itemscope itemtype="https://schema.org/CreativeWork">
            <h3 itemprop="name">Catálogo <span>de produtos</span></h3>
            <p itemprop="description"><?php the_field('descriptionCatalogProducts', 'option'); ?></p>
            <div class="buttons" itemprop="offers" itemscope itemtype="https://schema.org/OfferCatalog">
                <?php 
                    if( have_rows('buttonActions', 'option') ): 
                        while( have_rows('buttonActions', 'option') ): the_row(); // Verifique se 'buttonActions' é o nome correto do campo no ACF.
                ?>
                        <a href="<?php the_sub_field('urlButton'); ?>" title="<?php the_sub_field('nameButton'); ?>" target="_blank" itemprop="url" rel="noopener noreferrer">
                        <?php 
                            $image = get_sub_field('iconbutton');
                            if( !empty( $image ) ): 
                        ?>
                            <img src="<?=esc_url($image['url'])?>" alt="<?=esc_attr($image['alt'])?>" loading="lazy" />
                        <?php endif; ?> 
                            <?php the_sub_field('nameButton')?>
                        </a>
                <?php endwhile; else: ?>
                    <p>Nenhum botão disponível.</p>
                <?php endif; ?>
            </div>
        </article>
    </div>
</section>
