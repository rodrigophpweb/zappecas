<section class="companyTechnology gridMargin">
    <h2><?=esc_html(get_field('titleCompanyTechnology'))?></h2>
    <span class="subtitle"><?=esc_html(get_field('subtitleCompanyTechnology'))?></span>
    <?=get_field('contentCompanyTechnology')?>

    <?php if( have_rows('techsUsed') ): ?>
        <div class="additionalInformation">
        <?php while( have_rows('techsUsed') ): the_row(); 
            $image = get_sub_field('imageTechUsed');
            $title = get_sub_field('tituloTechUsed');
            $content = get_sub_field('contentTechUsed');
        ?>
            <article>
                <figure>
                    <?php if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                    <figcaption>
                        <h3><?=esc_html($title)?></h3>
                        <p><?=esc_html($content)?></p>
                    </figcaption>
                </figure>                
            </article>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>    
</section>