<?php
    $imageDistributorAndSI = get_field('imageDistributorAndSI');
    $titleDistributorAndSI = get_field('titleDistributorAndSI');
    $descriptionDistributorAndSI = get_field('descriptionDistributorAndSI');
    $ctaDistributorAndSI = get_field('ctaDistributorAndSI');   
?>

<section class="frontPageDistributorAndSI">
    <figure>
        <?php if( $imageDistributorAndSI ): ?>
            <img src="<?php echo esc_url($imageDistributorAndSI['url']); ?>" alt="<?php echo esc_attr($imageDistributorAndSI['alt']); ?>">
        <?php endif; ?>
    </figure>
    <header>
        <h2><?php echo esc_html($titleDistributorAndSI); ?></h2>
        <div class="content">
            <p><?php echo esc_html($descriptionDistributorAndSI); ?></p>
            <?php if( $ctaDistributorAndSI ): ?>
                <a href="<?php echo esc_url($ctaDistributorAndSI['url']); ?>" class="btn">
                    <?php echo esc_html($ctaDistributorAndSI['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </header>
</section>