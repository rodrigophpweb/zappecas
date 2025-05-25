<section class="companyMarketServed gridMargin">
    <h2><?=esc_html(get_field('titleMarketServed'))?></h2> 
    <span class="subtitle"><?=esc_html(get_field('subtitleMarketServed'))?></span>
    <?=get_field('contentMarketServed');?>

    <?php if( have_rows('marketsRepeater') ): ?>
        <article>
            <?php while( have_rows('marketsRepeater') ): the_row(); 
                $image = get_sub_field('ImageMKRepeater');
                $title = get_sub_field('titleMKRepeater');
                $content = get_sub_field('contentMKRepeater');
            ?>
                <figure>
                    <?php if( !empty( $image ) ): ?>
                        <img src="<?=esc_url($image['url'])?>" alt="<?=esc_attr($image['alt'])?>" />
                    <?php endif; ?>
                    <figcaption>
                        <h3><?=$title?></h3>
                        <?=$content?>
                    </figcaption>
                </figure>                    
            <?php endwhile; ?>
        </article>
    <?php endif; ?>
</section>