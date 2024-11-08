<section class="companyYourNumbers gridMargin">
    <h2><?=esc_html(get_field('titlleYourNumbers'))?></h2>
    <span class="subtitle"><?=esc_html(get_field('subtitlleYourNumbers'))?></span>
    <?=get_field('contentYourNumbers')?>
    
    <div class="numbers">
        <?php if( have_rows('numbers') ): ?>
            <?php while( have_rows('numbers') ): the_row(); 
                $image = get_sub_field('numberImage');
                $numberTitle = get_sub_field('numberTitle');
                $infoTitle = get_sub_field('infoTitle');
            ?>
            <figure>
                <?php if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif;?>
                <figcaption>
                <h3 class="count" data-target="<?=esc_attr($numberTitle);?>"><?= esc_html($numberTitle); ?></h3>
                    <p><?=esc_html($infoTitle)?></p>
                </figcaption>
            </figure>                
            <?php endwhile; ?>
        <?php endif;?>        
    </div>
</section>