<?php
    $imageDistributorAndSI = get_field('imageDistributorAndSI');
    $titleDistributorAndSI = get_field('titleDistributorAndSI');
    $descriptionDistributorAndSI = get_field('descriptionDistributorAndSI');
    $ctaDistributorAndSI = get_field('ctaDistributorAndSI');   
?>

<section class="frontPageDistributorAndSI" itemscope itemtype="https://schema.org/Service">
    <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php if( $imageDistributorAndSI ): ?>
            <img src="<?php echo esc_url($imageDistributorAndSI['url']); ?>" 
                 alt="<?php echo esc_attr($imageDistributorAndSI['alt']); ?>"
                 itemprop="url contentUrl">
        <?php endif; ?>
    </figure>
    <header>
        <h2 itemprop="name"><?php echo esc_html($titleDistributorAndSI); ?></h2>
        <div class="content">
            <p itemprop="description"><?php echo esc_html($descriptionDistributorAndSI); ?></p>
            <?php if( $ctaDistributorAndSI ): ?>
                <a href="<?php echo esc_url($ctaDistributorAndSI['url']); ?>" 
                   class="btn" 
                   itemprop="url">
                    <?php echo esc_html($ctaDistributorAndSI['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </header>
</section>