<section class="frontPageDifferences">
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
        <h2><?php echo esc_html($titleDifferences); ?></h2>
        <span class="subtitle"><?php echo esc_html($subtitleDifferences); ?></span>
    </header>

    <div class="itens">
        <?php if( have_rows('itemsDifferences') ): ?>
            <?php while( have_rows('itemsDifferences') ): the_row(); 
                $itemsDifferencesIcon = get_sub_field('itemsDifferencesIcon');
                $itemsDifferencesTitle = get_sub_field('itemsDifferencesTitle');
                $itemsDifferencesDescription = get_sub_field('itemsDifferencesDescription');
            ?>
                <article>
                    <figure>
                        <?php if( $itemsDifferencesIcon ): ?>
                            <img src="<?php echo esc_url($itemsDifferencesIcon['url']); ?>" alt="<?php echo esc_attr($itemsDifferencesIcon['alt']); ?>">
                        <?php endif; ?>
                    </figure>
                    <h3><?php echo esc_html($itemsDifferencesTitle); ?></h3>
                    <p><?php echo esc_html($itemsDifferencesDescription); ?></p>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>