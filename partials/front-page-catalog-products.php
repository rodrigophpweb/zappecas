<section class="frontPageCatalogProducts" itemscope itemtype="https://schema.org/CreativeWork">
    <h2 itemprop="headline"><?php the_field('titleProducts')?></h2>
    <span itemprop="about" class="subtitle"><?php the_field('subTitleProduct')?></span>
    <div class="content">
        <figure id="frameCatalog" class="figure-animate" itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageObject">
            <?php 
                $image = get_field('imageCatalog');
                if( !empty( $image ) ): 
            ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" itemprop="contentUrl" />
            <?php endif; ?>
        </figure>
        <article id="contentCatalog" class="article-animate" itemprop="mainEntity" itemscope itemtype="https://schema.org/CreativeWork">
            <h3 itemprop="name">Cátalogo <span>de produtos</span></h3>
            <p itemprop="description"><?php the_field('descriptionCatalogProducts')?></p>
            <div class="buttons" itemprop="offers" itemscope itemtype="https://schema.org/OfferCatalog">
                <?php 
                    if( have_rows('buttonActions') ): 
                        while( have_rows('buttonActions') ): the_row();                 
                ?>
                        <a href="<?php the_sub_field('urlButton')?>" title="<?php the_sub_field('nameButton')?>" target="_blank" itemprop="url">
                        <?php 
                            $image = get_sub_field('iconbutton');
                            if( !empty( $image ) ): 
                        ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?> 
                            <?php the_sub_field('nameButton')?>
                        </a>
                <?php endwhile; endif;?>
            </div>
        </article>
    </div>
</section>