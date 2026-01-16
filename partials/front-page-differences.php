<section class="frontPageDifferences gridMargin" itemscope itemtype="https://schema.org/Organization">
    <?php
        $titleDifferences = get_field('titleDifferences');
        $subtitleDifferences = get_field('subtitleDifferences');   
        
        // Field repeater
        $itemsDifferences = get_field('itemsDifferences');
        $itemsDifferencesIcon = get_field('itemsDifferencesIcon');
        $itemsDifferencesTitle = get_field('itemsDifferencesTitle');
        $itemsDifferencesDescription = get_field('itemsDifferencesDescription');
    ?>

    <header>
        <h2 itemprop="slogan"><?php echo esc_html($titleDifferences); ?></h2>
        <span class="subtitle" itemprop="description"><?php echo esc_html($subtitleDifferences); ?></span>
    </header>

    <div class="itens" itemprop="hasOfferCatalog" itemscope itemtype="https://schema.org/ItemList">
        <?php if( have_rows('itemsDifferences') ): ?>
            <?php 
            $position = 1;
            while( have_rows('itemsDifferences') ): the_row(); 
                $itemsDifferencesIcon = get_sub_field('itemsDifferencesIcon');
                $itemsDifferencesTitle = get_sub_field('itemsDifferencesTitle');
                $itemsDifferencesDescription = get_sub_field('itemsDifferencesDescription');
            ?>
                <article itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <meta itemprop="position" content="<?php echo $position; ?>" />
                    <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <?php if( $itemsDifferencesIcon ): ?>
                            <img src="<?php echo esc_url($itemsDifferencesIcon['url']); ?>" 
                                 alt="<?php echo esc_attr($itemsDifferencesIcon['alt']); ?>"
                                 itemprop="url contentUrl">
                        <?php endif; ?>
                    </figure>
                    <h3 itemprop="name"><?php echo esc_html($itemsDifferencesTitle); ?></h3>
                    <p itemprop="description"><?php echo esc_html($itemsDifferencesDescription); ?></p>
                </article>
            <?php 
            $position++;
            endwhile; ?>
        <?php endif; ?>
    </div>
</section>